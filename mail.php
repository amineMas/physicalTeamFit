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
            preg_match('/^[a-zA-Z ]*$/', $name);
        }

        if(!empty($_POST["email"]))
        {
            $email = validation($_POST["email"]);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
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

        $to_email = "aminemastouri@gmail.com, lass.coaching@gmail.com, kurtisovitch@hotmail.com";
        $headers = array(
            'From' => $email,
            'Reply-To' => $email,
            'X-Mailer' => 'PHP/' . phpversion()
        );
        //envoi du mail après verification et traitement des données
        if (mail($to_email, $subject, $message, $headers)){
            echo "<p>Thank you for contacting us, $email. You will get a reply within 24 hours.</p>";
        } else {
            $errorMessage = error_get_last()['message'];
        }
    }
        
    ?>