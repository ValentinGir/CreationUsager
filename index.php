<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <h1>COURS 2</h1>
    <?php
        $nom = $mdp = $mdpconf = $mail = $avatar = $sexe = $naissance = $transport = "";
        $nomErreur = $mdpErreur = $mdpconfErreur = $mailErreur = $avatarErreur = $sexeErreur = $naissanceErreur = $transportErreur =  "";
        $erreur = false;

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            //CAS #2
            //On vient de recevoir le formulaire
            echo "<h1>POST == TRUE </h1>";
            
            if(empty($_POST['nom'])){
                $nomErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                if($_POST['nom'] != "SLAY"){
                    $nom = trojan($_POST['nom']);
                }
                else {
                    $nomErreur = "Ce nom est déjà pris";
                    $erreur  = true;
                }
            }

            if(empty($_POST['mdp'])){
                $mdpErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                $mdp = trojan($_POST['mdp']);
            }

            if(empty($_POST['mdpconf'])){
                $mdpconfErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                if($_POST['mdp'] != $_POST['mdpconf']){
                    $mdpconfErreur = "Les mots de passe doivent être identiques";
                    $erreur  = true;
                }
                else {
                    $mdpconf = trojan($_POST['mdpconf']);
                }
            }

            if(empty($_POST['mail'])){
                $mailErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    $mailErreur = "L'adresse courriel n'est pas valide";
                    $erreur  = true;
                    
                }
                else {
                    $mail = trojan($_POST['mail']);
                }
            }

            if(empty($_POST['avatar'])){
                $avatarErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                $avatar = trojan($_POST['avatar']);
            }

            if(isset($_POST['sexe'])){
                $sexe = trojan($_POST['sexe']);
            }
            else {
                $sexeErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }

            if(empty($_POST['naissance'])){
                $naissanceErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                $naissance = trojan($_POST['naissance']);
            }

            if(empty($_POST['transport'])){
                $transportErreur = "Ce champ est obligatoire";
                $erreur  = true;
            }
            else {
                $transport = trojan($_POST['transport']);
            }

            //AFFICHER LE RÉSULTAT DE MON FORM
        }
        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
            // Cas #1 On veut afficher le formulaire
            echo "<h1>On affiche le formulaire </h1>";
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                Nom usager : <input type="text" name="nom" maxLength="15" value="<?php echo $nom;?>"><br>
                <p style="color:red;"><?php echo $nomErreur; ?></p>

                Mot de passe : <input type="text" name="mdp" maxLength="15" value="<?php echo $mdp;?>"> <br>
                <p style="color:red;"><?php echo $mdpErreur; ?></p>

                Confirmation de mot de passe : <input type="text" name="mdpconf" maxLength="15" value="<?php echo $mdpconf;?>"> <br>
                <p style="color:red;"><?php echo $mdpconfErreur; ?></p>

                Adresse courriel : <input type="text" name="mail" maxLength="30" value="<?php echo $mail;?>"> <br>
                <p style="color:red;"><?php echo $mailErreur; ?></p>

                Lien vers une image avatar : <input type="text" name="avatar" value="<?php echo $avatar;?>"><br>
                <p style="color:red;"><?php echo $avatarErreur; ?></p>

                Sexe : <br>
                <input type="radio" name="sexe" id="masculin" value="masculin" <?php if($sexe == "masculin") echo ("CHECKED"); ?>> Masculin <br>
                <input type="radio" name="sexe" id="féminin" value="féminin" <?php if($sexe == "féminin") echo ("CHECKED"); ?>> Féminin <br>
                <input type="radio" name="sexe" id="nongenré" value="nongenré" <?php if($sexe == "nongenré") echo ("CHECKED"); ?>> Non genré <br>
                <p style="color:red;"><?php echo $sexeErreur; ?></p>

                Date de naissance : <input type="date" name="naissance" value="<?php echo $naissance;?>"><br>
                <p style="color:red;"><?php echo $naissanceErreur; ?></p>

                <label for="transport"> Moyen de transport : </label>
                <select name="transport">
                    <option value="" disabled selected>Choisir votre option </option>
                    <option value="auto" <?php if($transport == "auto") echo ("SELECTED"); ?>>Auto</option>
                    <option value="autobus" <?php if($transport == "autobus") echo ("SELECTED"); ?>>Autobus</option>
                    <option value="marche" <?php if($transport == "marche") echo ("SELECTED"); ?>>Marche</option>
                    <option value="vélo" <?php if($transport == "vélo") echo ("SELECTED"); ?>>Vélo</option>
                </select>
                <p style="color:red;"><?php echo $transportErreur; ?></p><br>

                <input type="submit">
            </form>
        <?php
        }

        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            
            return $data;
        }

    ?> 
<script src="https://kit.fontawesome.com/97daa36ca6.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>