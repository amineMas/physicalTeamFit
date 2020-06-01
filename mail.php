<?php

// var_dump($_SERVER['HTTP_REFERER']);
// var_dump($_SERVER['REQUEST_URI']);
// var_dump($_SERVER['PHP_SELF']);
// die();
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
        } else {
            $num = 'non renseigné';
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
        } else {
            $subject = 'Contact - Physicalteamfit';
        }

        if(isset($_POST['date']) && isset($_POST['heure'])){
            $date = $_POST['date'];
            $heure = $_POST['heure'];
            $dateHeure = "Date: $date, Heure: $heure";
        }

        if(!empty($_POST["message"]))
        {
            $message = validation($_POST["message"]);
            nl2br($message);
            // $message = wordwrap($message, 70, PHP_EOL);
        }

        $to_email = "aminemastouri@gmail.com";
        $headers = array(
            'MIME-Version' => '1.0',
            'Content-type' => "text/html; charset=utf-8",
            'From' => $email,
            'Reply-To' => $email,
            'X-Mailer' => 'PHP/' . phpversion()
        );

        $dateRdv = $dateHeure ?? 'Non renseigné';

        $messageHtml = '
        <html>
            <body>
                <div align="center" style="font-size:21px;">
                    <p>Vous avez reçu un mail de la part de ' . $name . ' ' . $prenom .' au sujet de ' . $subject . '.</p>
                    <p> ' . $message . '</p>
                    <p> Horaire souhaitée : ' . $dateRdv .'
                </div>
            </body>
        </html>
        ';

        //envoi du mail après verification et traitement des données
        if (mail($to_email, $subject, $messageHtml, $headers)){
            echo "<p>Merci de nous avoir contacté, $name. Nous vous répondrons au plus vite.</p>";
            echo "<a href='index.html'>Retour sur la page d'accueil</a>";
        } else {
            echo 'Une erreur est survenue lors de l\'envoi';
        }
    }
        
    ?>