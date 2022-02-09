
 <?php
 error_reporting(-1);
    $server='localhost';
    $login='root';
    $password="";
    
    try {
        $connexion=new PDO("mysql:host=$server;dbname=tontine",$login,$password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec('SET NAMES utf8');
        echo 'Connexion etablie avec succès</br>';
    
    }
    catch (PDOException $e)
    {
     die( 'Error of connexion: '.$e->getMessage());
    }
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
      

        }
        
     ?>
 