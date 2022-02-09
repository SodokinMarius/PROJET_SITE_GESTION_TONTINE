
<?php 
error_reporting(0);
try{
    $connexion= new PDO("mysql:host=localhost;bdname=tontine",'root','');
    $connexion->SetAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->exec('SET NAMES UTF8');
  
}
catch(PDOException $erreur){
    die('Connexion aboutit avec succès '.$erreur->getMessage());
}


$errors=[];
$sexe=array('M','F');

if($_POST['numcarnet']=='' OR $_POST['numcarnet']<=0)
{
    $errors['carnet']='Veullez renseigner le numero de cartnet ou veifiez bien la valeur';
}


if(!isset($_POST['nomClient']))
$errors['nom']='Veuillez enseigner le nom svp';

if(!isset($_POST['prenomClient']))
$errors['prenom']='Le Prenom n\est pas renseigner';

if(!isset($_POST['dateNaissance']))
$errors['dateNaissance']='La date de Naissance est non renseignée ou Invalide !';

if(!isset($_POST['LieuNaissance']))
$errors['LieuNaissance']="Renseignez le lieu de Naissance svp";
 
if($_POST['sexe']==0 OR (!array_key_exists('sexe',$_POST)  AND !isset($sexe[$_POST['sexe']])))
$errors['sexe']='Veuillez specifier votre sexe ou Sexe Invalide';

if(!isset($_POST['profession']))
$errors['profession']='Renseignez votre profession svp';

if($_POST['AdClient']=='')
$errors['adresse']='Precisez votre adresse svp' ;


if($_POST['telephone']=='' OR (strlen($_POST['telephone'])>=8
AND strlen($_POST['telephone']<=15)))
$errors['telephone']='Numero de telephone non renseigné ou Invalide !';



if(empty($errors))
{


   $success='Merci de vous avoir Inscrire ';
    $_SESSION['succes']=$success;
 

   /* $inserer=$connexion->prepare("INSERT INTO client 
        VALUES('',?,?,?,?,?,?,?,?,)");
    
    $envoi=$inserer->execute(array($_POST['numCarnet'],$_POST['nomClient'],
        $_POST['prenomClient'],$_POST['dateNaissance'],
        $_POST['LieuNaissance'],$_POST['sexe'],
        $_POST['profession'],$_POST['AdClient'],
        $_POST['telephone']));*/



    $inserer=$connexion->prepare("INSERT INTO tontine.client
    (matricule,nomClient,prenomClient,dateNaissance,LieuNaissance,
    sexe,profession,AdressClient,telephone,sous_journalier,date_sous)
  
    VALUES(:mtle,:nom,:prenom,:datnais,:lieunais,:sexe,:profess,:addres,:tel,:sousJ,CURDATE())");

    $Einserer=$inserer->execute(array(
    'mtle'=>$_POST['numcarnet'],
    'nom'=>$_POST['nomClient'],
    'prenom'=>$_POST['prenomClient'],
    'datnais'=>$_POST['dateNaissance'],
    'lieunais'=>$_POST['LieuNaissance'],
    'sexe'=>$_POST['sexe'],
    'profess'=>$_POST['profession'],
    'addres'=>$_POST['AdClient'],
     'tel'=>$_POST['telephone'],
     'sousJ'=>$_POST['sous_journalier']));

    $prix_unit=500;
    $stock=1000;

    $insertionCarnet=$connexion->prepare("INSERT INTO  tontine.carnet
    VALUES(:numCarnet,NOW(),:prix,:stock)");

    $ValidateInsertionCarnet=$insertionCarnet->execute(array(
    'numCarnet'=>$_POST['numcarnet'],
    'prix'=>$prix_unit,'stock'=>$stock));

    $insertionCarnet->CloseCursor(); 

}
else
{
  session_start();
  $_SESSION['errors']=$errors;
  $_SESSION['inputs']=$_POST;
      //echo 'Erreur ! Veuillez verifier les données entrées';
   // header("Location:Formulaire_EnregistrementClient.php");
}

/*

//A importer sur la page du formulaire
session_start();

if(array_key_exists('$errors',$_SESSION['errors']))
{
    echo implode('<br>',$_SESSION['errors']);
     unset($_SESSION['errors']);

     //Attubuts values des inputs du Formulaire
     $value=(isset($_SESSION['inputs']['name'])) ? $_SESSION['inputs']['name']:'';
}
else{
    echo $_SESSION['succes'];
}*/
?>