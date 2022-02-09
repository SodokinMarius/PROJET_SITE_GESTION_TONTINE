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

 

 $paiements=$connexion->query("SELECT * FROM 
                    paiement,client,agent 
                    WHERE paiement.matricule=client.matricule
                    AND  paiement.idAgent=agent.idAgent");


    //Affichage de la liste des clients
    echo '<table border="1">';
while($tous_paiement=$paiements->fetch())
{
   
    echo '<tr> 
     <th>carnet N°: </th> <td>           ' . htmlspecialchars($tous_paiement['paiement.matricule']).' </td></tr>
     <tr> 
     <th>Nom : </th> <td>           ' .htmlspecialchars($tous_paiement['client.nomClient']).' </td></tr>
     <tr> 
     <th>Prenom : </th> <td>           ' .htmlspecialchars($tous_paiement['client.prenomClient']).' </td></tr>
     <tr> 
     <th>Poste de l\'Agent: </th> <td>           ' .htmlspecialchars($tous_paiement['agent.poste']).' </td></tr>
     <tr> 
     <th>Nom de L\'Agent : </th> <td>           ' .htmlspecialchars($tous_paiement['agent.nomAgent']).' </td></tr>
     <tr> 
     <th>Prenom de l\Agent: </th> <td>           ' .htmlspecialchars($tous_paiement['agent.prenomClient']).' </td></tr>
     <tr> 
     <th>Souscription Journalier Client  : </th> <td>           ' .htmlspecialchars($tous_paiement['client.sous_journalier']).' </td></tr>
     <tr> 
     <th> Dernier Paiement: </th> <td>           ' .htmlspecialchars($tous_paiement['sexe']).' </td></tr>
     <tr> 
     <th>Date du Paiement : </th> <td>           ' .htmlspecialchars($tous_paiement['profession']).' </td></tr>

     <tr> 
     <th>Montant total Attendu: </th> <td>           ' .htmlspecialchars($tous_paiement['AdressClient']).' </td></tr>';
     
}
  echo '</table><br><br><br><br>';
     
/*
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
     </table>';*/

   $paiements->CloseCursor();


 
 ?>