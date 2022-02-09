<?php
error_reporting(-1);
try{
    $connexion= new PDO("mysql:host=localhost;bdname=tontine",'root','');
    $connexion->SetAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->exec('SET NAMES UTF8');
  
}
catch(PDOException $erreur){
    die('Connexion aboutit avec succès '.$erreur->getMessage());
}
if(isset($_POST['matricule']) AND isset($_POST['nomClient'])
AND isset($_POST['prenomClient']) AND isset($_POST['dateNaissance'])
AND isset($_POST['LieuNaissance']) AND isset($_POST['sexe'])
AND isset($_POST['profession']) AND isset($_POST['AdressClient']) 
AND isset($_POST['telephone'])){

    $insertion=$connexion->prepare("INSERT INTO tontine.client(matricule,nomClient,prenomClient,dateNaissance,
                LieuNaissance,sexe,profession,AdressClient,telephone)
    VALUES(?,?,?,?,?,?,?,?,?)");

    $envoie=$insertion->execute(array(
    $_POST['matricule'],
    $_POST['nomClient'],
    $_POST['prenomClient'],
    $_POST['dateNaissance'],
    $_POST['LieuNaissance'],
    $_POST['sexe'],
    $_POST['profession'],
    $_POST['AdressClient'],
    $_POST['telephone']));
   
}

?>
