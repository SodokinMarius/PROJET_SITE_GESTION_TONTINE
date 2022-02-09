<?php
try{
$connexion=new PDO("mysql:host=localhost;dbname=tontine",'root','');
 $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $connexion->exec('SET NAMES UTF8');
}
 
 catch(PDOException $erreur)
 {
  die("Une erreur s'est produite ".$erreur->getMessage());
 }
error_reporting(0);
 $numeros=$connexion->query("SELECT matricule FROM client");

 //Verification de l'existence du numero

 $clientExiste=0;
 while($existe=$numeros->fetch())
 {
     if($existe['matricule']==$_POST['matricule'])
     {
         $clientExiste=1;
     }
 }

 if(!empty($_POST['matricule']) AND $clientExiste==1)
 {
    $InfosClient=$connexion->prepare('SELECT * FROM tontine.client WHERE matricule=?');
    $InfosClient->execute(array($_POST['matricule']));


  /*  $RecuperationDate=$connexion->prepare("SELECT DATE_FORMAT(carnet.date_enregistrement,'%d/%m/%Y')
     AS date_enregistrement
     FROM carnet 
     INNER JOIN paiement ON paiement.numCarnet=carnet.numCarnet 
    INNER JOIN client ON paiement.matricule=client.matricule 
     WHERE client.matricule=?");
     $RecuperationDate->execute(array($_POST['matricule']));*/
    
    
$client=$InfosClient->fetch();
//$date=$RecuperationDate->fetch();

    //Affichage de la liste des clients
    echo '<table border="1">';
    echo '<tr> 
     <th>Nom : </th> <td>           ' . htmlspecialchars($client['nomClient']).' </td></tr>
     <tr> 
     <th>Prenom : </th> <td>           ' .htmlspecialchars($client['prenomClient']).' </td></tr>
     <tr> 
     <th>Date De Naissance : </th> <td>           ' .htmlspecialchars($client['dateNaissance']).' </td></tr>
     <tr> 
     <th>Lieu De Naissance : </th> <td>           ' .htmlspecialchars($client['LieuNaissance']).' </td></tr>
     <tr> 
     <th>Sexe : </th> <td>           ' .htmlspecialchars($client['sexe']).' </td></tr>
     <tr> 
     <th>Profession : </th> <td>           ' .htmlspecialchars($client['profession']).' </td></tr>

     <tr> 
     <th>Adresse : </th> <td>           ' .htmlspecialchars($client['AdressClient']).' </td></tr>
     <tr> 
     <th>Contacts : </th> <td>           ' .htmlspecialchars($client['telephone']).' </td></tr>
     <tr> 
     <th>Date de Souscription : </th> <td>           ' .htmlspecialchars($client['date_sous']).
     ' </td></tr></table><br><br><br><br>';
     

     //Informations sur son Carnet
     $carnet=$connexion->query("SELECT carnet.* FROM carnet INNER JOIN paiement  
                ON carnet.numcarnet=paiement.matricule ");

    $carnet=$carnet->fetch();

    //Requete du nombre de Carnet par Client
    $NombreCarnetParClient=$connexion->prepare("SELECT matricule,numCarnet AS nombreCarnet
                         FROM paiement WHERE matricule=:numero 
                                     GROUP BY matricule");
    $nbreCarnet=$NombreCarnetParClient->execute(array('numero'=>$_POST['matricule']));
    //$NombreCarnetParClient->fetch();

    //Affichage des Infos Carnet
    echo '<table border="1">';
    echo '<tr> 
     <th>Numéro du Carnet: </th> <td>           '  . htmlspecialchars($_POST['matricule']).' </td></tr>
     <tr> 
     <th>Date de souscription : </th> <td>           ' .htmlspecialchars($carnet['date_enregistrement']).' </td></tr>
     <tr> 
     <th>Prix : </th> <td>          ' .(int)htmlspecialchars($carnet['prix_unit']).' </td></tr>
    

     <tr> 
     <th>Sousciption Journalier : </th> <td>           ' .(float)htmlspecialchars($client['sous_journalier']).' </td></tr>
     </table><br><br><br><br>';


     //Requete pour recuperer le total des paiements
        $num=$_POST['matricule'];
    $total=$connexion->prepare("SELECT SUM(montant_paye) AS 
            montant_cotise FROM tontine.paiement
            WHERE matricule=?");

    $mont=$total->execute(array($num));

   while($tot=$total->fetch())
   {
    $montant=$tot['montant_cotise'];
   }


     //Cote financier
     $nbrefois=$nbreCarnet['nombreCarnet'];
     $prix_Unit=$carnet['prix_unit'];
     $MontantCarnet=$prix_Unit;
     $totalcotise=(float)$montant;
     $quota_A_preleve=12*$client['sous_journalier'];
     $Montant_attendu=$totalcotise-($MontantCarnet+$quota_A_preleve);

     //Affichage des informations

     echo '<table border="1">';
    echo '<tr> 
     <th>Quote-part journalier: </th> <td>           ' .(float)htmlspecialchars($client['sous_journalier']).' F CFA</td></tr>
     <tr> 
     <th>Montant des Carnet : </th> <td>           ' .(float)htmlspecialchars($MontantCarnet).' F CFA</td></tr>
     <tr> 
     <th>Total Cotisé : </th> <td>           ' .(float)htmlspecialchars($totalcotise).' F CFA</td></tr>
     <tr> 
     <th>Quota à Prelever: </th> <td>           ' .(float)htmlspecialchars($quota_A_preleve).' F CFA</td></tr>
     <tr> 
     <th>Montant attendu: </th> <td>           ' .(float)htmlspecialchars($Montant_attendu).' F CFA</td></tr>
     </table>';

   $total->CloseCursor();


 }
 ?>