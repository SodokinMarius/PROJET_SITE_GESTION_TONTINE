<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des clients</title>
    <link rel="stylesheet" href="gestion_client.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <header>
        <img class="img1" src="logo.jpeg" alt="logo tontine">
        <h1>GESTION DES AGENTS</h1>
    </header>
    <div class="banner">
        <div class="mutuelle">MUTUELLE POUR LE FINANCEMENT A LA BASE</div>
    </div>
    <br><br><br>

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

    <form action="Location: Accueil.php" method="POST">
        <fieldset>
            <legend>AUTHENTIFICATION</legend><br><br>
            <label id="pseudo">Votre Pseudo  ou Identifiant :</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="XXXX" required><br><br>
            <center><font color="red">
            <?php 

                if(isset($_POST['pseudo']))
               {
                  //Recuperation des Informations de connexion de la BD
                
                $infosConnect=$connexion->query("SELECT idAgent FROM agent");
            
                //Verification de la presence des informations de connexion
                    $idExiste=0;
                    $PassCorrecte=0;
                    while($infos=$infosConnect->fetch())
                    {
                        if($infos['idAgent']==($_POST['pseudo']))
                        {
                            $idExiste++;
                            
                        }
                    }
                    $errors=array();
                
                if($idExiste!=1){
                    
                    echo "Ce Agent n'existe pas! Merci de reverifier.";
                    $errors['AgPas']="Ce Agent n'existe pas! Merci de reverifier.";
                }

                if(empty(($_POST['pseudo'])))
                 {
                echo "Le pseudo n'est pas renseigné<br>";
                 $errors['PasPseudo']="Le pseudo n'est pas renseigné";
                }
            } 
            ?>
        </font></center>

            <br><label id="poste">POSTE :</label><select name="poste" id="poste" required>
                <option value="1">SUPERVISEUR</option>
                <option value="2">PRESIDENT</option>
                <option value="3">SECRETAIRE</option>
                <option value="4">TRESORIER(E)</option>
            </select> <br><br>
                <!--Traitement-->
            <?php
            if(!empty($_POST['poste']))
            
            {
              $postes=array('1','2','3','4');

            if(!isset($_POST['poste']))

         {
            echo "Veuillez choisir le poste svp";
            $errors['PosteVide']="Veuillez choisir le poste svp";
        }

            if(!(in_array(($_POST['poste']),$postes)))
            {
            echo "Ce poste  n'existe pas !<br>";
            $errors['PasPoste']="Ce poste  n'existe pas !";
            }
            
         }
         
         ?>

         
          <label id="passwd">Mot de passe:</label>
            <input type="password" name="passwd" id="passwd"><br><br>

            <!--Traitement du mot de passe entrée-->
 
         <center><font color="red">
            <?php
            echo $_POST['passwd'] .'<br>';
            echo sha1(($_POST['passwd'])); 

            if($idExiste==1)
            {   
                $motPasse=$connexion->prepare("SELECT mot_de_passe FROM agent WHERE idAgent=?");
                $passwd_base=$motPasse->execute(array($_POST['pseudo']));
           
                $long_passwd=strlen(($_POST['passwd']));
                $pass_hach=sha1(($_POST['passwd']));
                
                

               /* while($passwd=){

                  if(!empty($passwd['mot_de_passe']))
                    $motde_passe=$passwd['mot_de_passe'];

                    else 
                    echo 'Vide';
                }*/
         
            if($long_passwd<8 OR $long_passwd>12)
            {
                echo "Le mot de passe doit être compris entre 8 et 12 caractères<br> ";
                $errors['Passcourt']= "Le mot de passe doit être compris entre 8 et 12 caractères ";
            }
           
            elseif(!in_array($pass_hach,!empty($passwd_base['mot_de_passe'])))
            {
            echo '<br>Le Mot de passe est Incorrecte<br>
                                                          ';
           $errors['FauxPass']= 'Le Mot de passe est Incorrecte';
            }
            else 
            
            echo '<br> Voici  vide : ';

           
            if(empty($errors))
            { 
                header("Location: Accueil.php");
            }
        
           
            }


            ?>


            </center></font>

    <button class="bouton" type="submit">CONNEXION</button>
  
            
</fieldset>

       
    </form>
    
    <div class="nouve">Vous etes nouveau veuillez vous authentifiez<a href="new_agent.html">  ici</a> </div>

   
</body>
</html>