<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link rel="stylesheet" href="new.css"-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min">
</head>
<body>
<?php  require_once("Menu_entete.php")?> 
    <h1 class="h11">FORMULAIRE DES NOUVEAUX PAIEMENTS</h1>
    <p>
        Veuillez ajouter les nouveaux paiements ici;
    </p>

    <?php
    error_reporting(0);
     try
     {
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

    <form action="" method="POST"> 
        
            <fieldset>
                <legend>NOUVEAU PAIEMENT</legend>
                <label id="numcarnet">NUMERO DU CARNET :</label>
                <input type="text" name="numcarnet" id="numcarnet" placeholder="Carnet N° 0000" required><br><br>
                
                <center><font color="red">
                <?php 
                if(!empty($_POST['numcarnet']))
                {       
                    $numcarnet=$_POST['numcarnet'];
                        $carnet=$connexion->query("SELECT numCarnet FROM carnet WHERE numCarnet=$numcarnet");
                        
                        $carnetExiste=0;
                
                    while($temp=$carnet->fetch())
                    {
                        if($temp['numCarnet']==($_POST['numcarnet']))
                        {
                            
                            $carnetExiste++;
                        }
                    }

                    if($carnetExiste==0)
                    {
                        $errors['CExPas']='Ce carnet n\'existe pas encore ! Contactez l\'Administrateur';
                        echo 'Ce carnet n\'existe pas encore ! Contactez l\'Administrateur<br><br>';
                    
                    }
                }
                
               
                ?>
            </font></center>
            <label id="montpaye">MONTANT A PAYER :</label>
            <input type="montpaye" name="montant_paye" id="montpaye"><br><br>

           <center> <font color="red">
            <?php 
            if(isset($_POST['montant_paye']))
            {
               
                if((int)($_POST['montant_paye']<100))
               
                {
                    $errors['montInvalid']='Montant Invalide';
                    echo 'Montant Invalide<br>';
                 
                } 
                
            }
            else
            
            {
                $errors['montVide']='Veuilez entrer le montant à payer';
                echo 'Veuilez entrer le montant à payer<br>';
            }
            
          ?>
        </font></center>
        <label id="idAgent">AGENT CHARGE :</label>
         <input type="text" name="idAgent" id="idAgent" placeholder="AGENT 2021" required><br><br>

         <center><font color="red">
         <?php 
                if (!empty($_POST['idAgent']))
                {
                    //$agent=$_POST['idAgent'];
                    $Identifiants=$connexion->query("SELECT idAgent FROM agent");
                    //$Identifiants->execute(array(($_POST['idAgent'])));
                    
                   // $id=$Identifiants->fetch();
                   $AgentExiste=0;
            
                while($temp=$Identifiants->fetch())
                {
                    if($temp['idAgent']==($_POST['idAgent']))
                    {
                       
                        $AgentExiste++;
                       
                    }
                }

                if($AgentExiste==0)
                {
                  
                    $errors['PasAgent']='Cet Agent N\'existe pas ! Veuillez reverifier ou Contactez l\'Administrateur';
                    echo 'Cet Agent N\'existe pas ! Veuillez reverifier ou Contactez l\'Administrateur<br>';
                    unset($errors);
                }
                }
                   
            ?>
                </font> </center>
  

         <br><label id="nature_paiement"> NATURE DU PAIEMENT :</label>
                
                <select name="nature_paiement" id="nature_paiement" required>
            
                <option value="1">NATURE</option>
                <option value="2">ESPECE</option>
                <option value="3">A DISTANCE</option>
               
            </select> <br><br>
        
          </fieldset>
    
        <button class="bouton" type="submit">Effectuer</button>
        <?php 

        if(empty($errors))
        {
          
      if(!empty($_POST['numcarnet'])
            AND !empty($_POST['idAgent']) AND !empty($_POST['nature_paiement'])
            AND !empty($_POST['montant_paye']))
            {
                
                $inserer=$connexion->prepare("INSERT INTO paiement
                (matricule,numCarnet,idAgent,date_paiement,nature_paiement,
                montant_paye)
                VALUES(:matricule,:numCarnet,:idAgent,CURDATE(),:nature_paiement,:montant_paye)");
                $insertion=$inserer->execute(array(
                'matricule'=>$_POST['numcarnet'],
                'numCarnet'=>$_POST['numcarnet'],
                'idAgent'=>$_POST['idAgent'],
                'nature_paiement'=>$_POST['nature_paiement'],
                'montant_paye'=>($_POST['montant_paye'])
                ));

                $inserer->closeCursor();
                echo '<br> <center><font color="green">L\'Ajout à été bien effectué</font></center><br>';
             
               //require_once("Traitement_page_Inscription_Agent.php");
        //include_once("Traitement/Recherche_Infos_Sur_Client.php");
            }
           
        }   
           
        
        ?>
        <?php include_once("Pied_de_Page.php") ;?>
    </form>
</body>
</html>