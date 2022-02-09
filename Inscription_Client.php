<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enregistrement</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
<?php  require_once("Menu_entete.php")?> 
    <h1 class="h11">FORMULAIRE D'ENREGISTREMENT</h1>
    <p>
        Vous êtes nouveau ,Veuillez vous inscrire  ci-dessous
    </p>
    <form action="Traitement_Inscription_Client.php" method="POST">
        <fieldset>
            <legend>ENREGISTREMENT</legend><br><br>
            <label for="numcarnet">Numero Carnet:</label>
            <input type="number" name="numcarnet" id="carnet" placeholder="XXXX" required><br><br>
            
            <label for="sous_jour">Souscription Journalière:</label>
            <input type="number" name="sous_journalier" id="sous_jour"><br><br>

            <label for="nom">Nom:</label>
            <input type="text" name="nomClient" id="nom" required><br><br>

            <label for="prenom">Prénoms:</label><input type="text" name="prenomClient" id="prenom" required><br><br>
            <label for="sexe">Sexe:</label><select name="sexe" id="sexe" required>
                <option value="1">Masculin</option>
                <option value="2">Féminin</option>
            </select> <br><br>
            <label for="date">Date de Naissance:</label><input type="date" name="dateNaissance" id="date" placeholder="XX/XX/XXXX"><br><br>
            <label for="lieu">Lieu de naissance:</label><input type="text" name="LieuNaissance" id="Lieu"><br><br>

            <label for="AdressClient">Adresse :</label>
            <input type="text" name="AdClient" id="AdClient"><br><br>
            <label for="profession">Profession:</label>
            <input type="text" name="profession" id="profession"><br><br>
            <label for="tel">Numero Telephone:</label>
            <input type="tel" name="telephone" id="tel" placeholder="00229 XXXXXXXX" required><br><br>
            <button class="bouton" type="submit">Envoyer</button>
            <label ></label>
        </fieldset>
    </form>
    <div class="fin"></div>
    <?php include_once("Pied_de_Page.php") ;?>
    
</body>
</html>