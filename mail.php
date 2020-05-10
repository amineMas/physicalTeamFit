<?php
    // define variables and set to empty values
    //$err = $nameErr = $emailErr = "";
    function validation($data) {
        $data = trim($data); // supprime les espaces à la fin
        $data = stripslashes($data);
        $data = htmlspecialchars($data); //transforme les caractères spéciaux en entités html
        return $data;
    }

    if(!empty($_POST))
    {
        if(!empty($_POST["name"]))
        {
            $name = validation($_POST["name"]);
            // check if name only contains letters and whitespaces
            preg_match('/^[-a-zA-Z ]*$/', $name);
        } else {
            echo 'Le nom est requis';
        }

        if(!empty($_POST["prenom"]))
        {
            $prenom = validation($_POST["prenom"]);
            // check if name only contains letters and whitespaces
            preg_match('/^[-a-zA-Z ]*$/', $prenom);
        } else {
            echo 'Le prénom est requis';
        }

        if(!empty($_POST["num"]))
        {
            $num = filter_var($_POST["num"], FILTER_SANITIZE_NUMBER_INT);
        }

        if(!empty($_POST["email"]))
        {
            $email = validation($_POST["email"]);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        } else {
            echo 'champ mail requis';
        }

        if(!empty($_POST["subject"]))
        {
            $subject = validation($_POST["subject"]);
        }

        if(!empty($_POST["message"]))
        {
            $message = validation($_POST["message"]);
            $message = wordwrap($message, 70, PHP_EOL);
        }

        $to_email = "aminemastouri@gmail.com";
        $headers = array(
            'MIME-Version' => 1.0,
            'Content-type' => "text/html; charset=utf-8",
            'From' => $email,
            'Reply-To' => $email,
            'X-Mailer' => 'PHP/' . phpversion()
        );
        //envoi du mail après verification et traitement des données
        if (mail($to_email, $subject, $message, $headers)){
            echo "<p>Merci de nous avoir contacté, $name. Nous vous répondrons au plus vite.</p>";
        } else {
            $errorMessage = error_get_last()['message'];
        }
    }
        
    ?>