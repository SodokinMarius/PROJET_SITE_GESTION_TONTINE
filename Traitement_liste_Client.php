<?php
try{
$connexion=new PDO("mysql:host=localhost;dbname=tontine",'root','');
 $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION).
 $connexion->exec('SET NAMES UTF8');
}
 
 catch(PDOException $erreur){
  die("Une erreur s'est produite ".$erreur->getMessage());
 }

$requestliste=$connexion->query("SELECT *,DATE_FORMAT(date_sous,'%d/%m/%Y')
AS date_enregistrement, DATE_FORMAT(date_sous,'%H : %i : %s') 
AS heure FROM client ORDER BY matricule ASC");


/*$RecuperationDate=$connexion->query('SELECT DATE_FORMAT(date_sous,"%d/%m/%Y")
 AS date_enregistrement, DATE_FORMAT(date_enregistrement,"%H : %i : %s") AS heure
 FROM carnet 
 INNER JOIN paiement ON paiement.numCarnet=carnet.numCarnet 
INNER JOIN client ON paiement.matricule=client.matricule ');*/


//Affichage de la liste des clients
echo '<table border="2">';
echo '<tr> 
 <th>Nom</th><th>Prenom</th><th>Profession</th>
 <th>Adresse</th><th>Telephone</th><th>Numero du Carnet</th>
 <th>Periode de Souscription</th>
</tr>';

while($client=$requestliste->fetch() )
{
    echo '<tr> 
    <td> ' .($client['nomClient']). ' </td><td> ' .($client['prenomClient']). ' </td>
    <td> ' .($client['profession']). ' </td><td> ' .($client['AdressClient']). ' </td>
    <td> ' .($client['telephone']). ' </td> </td> <td> ' .($client['matricule']).
    '</td><td> '.($client['date_enregistrement']).' à '.$client['heure'].' </td></tr>';

}
echo '</table>';

$requestliste->CloseCursor();

?>
