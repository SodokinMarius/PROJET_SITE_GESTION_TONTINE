<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
<?php  require_once("Menu_entete.php")?> 
    <h1>FORMULAIRE D'IDENTIFICATION</h1>
    <p>
        Vous avez deja un compte veuillez vous identifiez ci-dessous
    </p>
    <form action="" method="POST">
        <fieldset>
            <legend>ENREGISTREMENT</legend><br><br><br><br>
            <label id="carnet">Numero Carnet:</label>
            <input type="text" name="matricule" id="carnet" placeholder="XXXX" required><br><br><br><br>
            <!--label id="nom">Nom:</label><input type="text" name="nom" id="nom" required><br><br><br><br>
            <label id="prenom">Prénoms:</label><input type="text" name="prenom" id="prenom" required><br><br><br><br-->
            <button class="bouton" type="submit">Envoyer</button>
        </fieldset>
    </form>
    <div class="fin"></div>
    <?php require_once("Recherche_Infos_Sur_Client.php");?>
    <script>/*
        var k=0;
        var tab=document.querySelectorAll('input');
        var submit=document.getElementsByClassName('bouton');

        submit.Onclick(
        for (var i of tab){
            if (i!="")
            k++;
        }
        if (k==tab.lenght){
            var succes=document.getElementsByClassName('fin');
            succes.innerHTML='<p style="color:green">Bravo Merci de vous êtes inscrites</p>';
        }
        else
        {
            succes.innerHTML='<p style="color:red"> Veuillez renseigner tout les champs disponible</p>';
        });*/
    </script>
    <?php include_once("Pied_de_Page.php") ;?>
</body>
</html>