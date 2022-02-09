<?php
     try{
        $connexion=new PDO("mysql:host=localhost;dbname=tontine",'root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES UTF8");
        //echo '<strong>Tout s\'est bien passé</strong>';
     }
     catch(PDOException $e){
        die('Erreur de connexion !'.$e->getMessage());
    }
 
    //Recuperation des Informations de connexion de la BD
    
    $infosConnect=$connexion->query("SELECT idAgent,mot_de_passe,poste FROM agent");

    //Verification de la presence des informations de connexion
    $idExiste=0;
    $PassCorrecte=0;
        while($infos=$infosConnect->fetch())
        {
            if($infos['idAgent']==$_POST['pseudo'])
            {
                $idExiste++;
            }
        }

        $passwd_b=$connexion->prepare("SELECT *  FROM agent WHERE idAgent=?");
        $passwd_base=$passwd_b->execute(array($_POST['pseudo']));
        
    //Gestion des erreurs
    $errors=[];
    $postes=array('SUPERVISEUR','PRESIDENT','SECRETAIRE','TRESORIER(E)');
    $long_passwd=strlen(isset($_POST['passwd']));
    $pass_hach=sha1($_POST['passwd']);
    
    if(empty($_POST['passwd']))
    $errors['passwd']="Le mot de passe n\'est pas renseigné  ";

    if($long_passwd<8 or $long_passwd>12)
    $errors['passlen']="Le mot de passe doit être compris entre 8 et 12 caractères ";


    if(empty($_POST['pseudo']))
    $errors['pseudo']="Le pseudo n'est pas renseigné";

    if( !isset($_POST['poste']))
    $errors['poste']="Veuillez choisir le poste svp";

    if($idExiste!=1)
    $errors['NonTrouver']="Ce Agent n'existe pas! Merci de reverifier.";
        
    if($passwd_base['mot_de_passe']!=$pass_hach)
    $errors['passError']='Le Mot de passe est Incorrecte';

    if(!in_array($_POST['poste'],$postes))
    $errors['poste']="Ce poste  n'existe pas !";

    $passwd_b->closeCursor();

 if(empty($errors))
 {
    $errors['succes']='Merci ! Vous serez desormais connecter';
   // header("Location: Page_Accueil.php");
 } 
    else
    {
        var_dump($errors);
        session_start();
        $_SESSION['errors']=$errors;
        $_SESSION['inputs']=$_POST;

    
        //header("Location:Page_Autentification.php");
       

    }
    

 
       
   ?>