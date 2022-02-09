<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
<?php  require_once("Menu_entete.php")?> 
    <h1 class="h11">FORMULAIRE D'ENREGISTREMENT  AGENT</h1>
    <p>
        Vous êtes un nouveau agent ,Veuillez vous inscrire  ci-dessous
    </p>

    <?php
     try{
        $connexion=new PDO("mysql:host=localhost;dbname=tontine",'root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES UTF8");
        //echo '<strong>Tout s\'est bien passé</strong>';
     }
     catch(PDOException $e)
     {
        die('Erreur de connexion !'.$e->getMessage());
    }
    ?>

      <?php  ?>
    <form action="" method="POST"> 
        <fieldset>
            <legend>NIVEAU CIVIL</legend><br><br>
            
            <label id="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required><br><br>
           
            <label id="prenom">Prénoms:</label>
            <input type="text" name="prenom" id="prenom" required><br><br>
            
            <label id="sexe">Sexe :</label>
            <select name="sexe" id="sexe" required>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select> <br><br>

            <label id="date">Date de Naissance:</label>
            <input type="date" name="dateNais" id="date" placeholder="XX/XX/XXXX"><br><br>
            
            <label id="lieu">Lieu de naissance:</label>
            <input type="text" name="lieu" id="lieu"><br><br>

            <label id="AdressAg">Adresse :</label>
            <input type="text" name="AdressAg" id="AdressAg"><br><br>
            
            <label id="profession">Profession:</label>
            <input type="text" name="profession" id="profession"><br><br>
            
            <label id="tel">Numero Telephone:</label>
            <input type="text" name="telephone" id="tel" placeholder="00229 XXXXXXXX" required><br><br>
           
            <label ></label>
            </fieldset><br><br><br>
            <fieldset>
                <legend>INFORMATIONS DE CONNEXION</legend>
                <label id="idAgent">PSEUDO OU IDENTIFIANT:</label>
                <input type="text" name="idAgent" id="idAgent" placeholder="Unique à vous " required><br><br>

                <?php 
                if(!empty($_POST['idAgent']))
                {

                        $Identifiants=$connexion->query("SELECT idAgent FROM agent");
                        

                        $AgentExiste=0;
                
                    while($temp=$Identifiants->fetch())
                    {
                        if($temp['idAgent']==($_POST['idAgent']))
                        {
                            echo 'Données : '.$temp['idAgent'];
                            $AgentExiste++;
                        }
                    }

                    if($AgentExiste!=0)
                    {
                        $errors['NonPseudo']='Pseudo Inadmissible ! Veuillez choisir autre ou Contactez l\'Administrateur';
                        echo 'Pseudo Inadmissible ! Veuillez choisir autre ou Contactez l\'Administrateur<br>';
                        echo 'BASE : '. $AgentExiste;
                    }
                }
                   
                ?>

                <label id="poste">POSTE :</label>
                
                <select name="poste" id="poste" required>
            
                <option value="1">SUPERVISEUR</option>
                <option value="2">PRESIDENT</option>
                <option value="3">SECRETAIRE</option>
                <option value="4">TRESORIER(E)</option>
            </select> <br><br>
           
            <label id="passwd">Choisir Un Mot de Passe :</label>
            <input type="password" name="passwd" id="passwd"><br><br>

            <label id="passwd_confirm">Confirmer le Mot de Passe :</label>
            <input type="password" name="passwd_confirm" id="passwd"><br><br>

            <?php 
            if(!empty($_POST['passwd'])  AND !empty($_POST['passwd_confirm']))
            {
                if(($_POST['passwd'])!=($_POST['passwd_confirm']))
                {
                    $errors['passwdId']='Les Mots de Passe ne sont pas identiques';
                    echo 'Les Mots de Passe ne sont pas identiques';
                }
                elseif(strlen(($_POST['passwd']))<8)
                {
                    $errors['passwdInc']='Mot de Passe Trop courte';
                    echo 'Mot de Passe Trop courte';
                 
                } 
                /*else
                {
                    $errors['passVide']='Renseignez d\abord les mots de passe';
                    echo 'Renseignez d\abord les mots de passe<br>';
                }*/
            }
            
          ?>

          </fieldset>
        
        <button class="bouton" type="submit">Enregistrer</button>
        <?php 

        if(empty($errors))
        {
                if(!empty($_POST['idAgent'])AND !empty($_POST['nom']) AND !empty($_POST['prenom'])
                AND !empty($_POST['dateNais']) AND !empty($_POST['lieu'])
                AND !empty($_POST['poste']) AND !empty($_POST['passwd'])
                AND !empty($_POST['AdressAg']) AND !empty($_POST['telephone']))
                {

                    $pass_hash=sha1(($_POST['passwd']));
                
                    $tele=($_POST['telephone']);
        
        
                    $inserer=$connexion->prepare("INSERT INTO tontine.agent
                    (idAgent,nomAgent,prenomAgent,dateNaissanceAg,LieuNaissanceAg,
                    poste,mot_de_passe,AdressAg, telephone,date_debut)
                  
        
                    VALUES(:idAg,:nom,:prenom,:datnais,:lieunais,:poste,:pass,:addres,:tel,CURDATE())");
                  
                    $insererA=$inserer->execute(array(
                    'idAg'=>( $_POST['idAgent']),
                    'nom'=>($_POST['nom']),
                    'prenom'=>($_POST['prenom']),
                    'datnais'=>($_POST['dateNais']),
                    'lieunais'=>($_POST['lieu']),
                    'poste'=>($_POST['poste']),
                    'pass'=> $pass_hash,
                    'addres'=>($_POST['AdressAg']),
                    'tel'=>$tele
                    ));
              
                echo 'Merci d\'avoir inscrire M. '.($_POST['nom']). ' '.($_POST['prenom']);

        
       }
    }
        ?>
    </form>
    <?php include_once("Pied_de_Page.php") ;?>
</body>
</html>