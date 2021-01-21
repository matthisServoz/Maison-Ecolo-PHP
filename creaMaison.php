<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="./CSS/styles.css">
    </head>
    <body>
        <?php
       
            $serveur = "localhost";
            $dbname = "mesappartements";
            $user = "root";
            $pass = "";       
            
            $CodePostal = $_POST["CodePostal"];
            $Rue = $_POST["Rue"];
            
            
            $nomMaison = $_POST["nomMaison"];
            $numeroM = $_POST["numeroM"];
            $eval = $_POST["eval"];
            $degreISo = $_POST["degreIso"];
            $ville = $_POST["ville"];
            
            
            try{
		//On se connecte Ã  la BDD
		$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
		$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                 //On vÃ©rifie que la maison n'existe pas 
                                
                $reponse = $dbco->prepare("SELECT COUNT(*) FROM Maison WHERE NomMaison = :nomMaison and NumeroMaison = :numeroM");
                $reponse->bindParam(':nomMaison',$nomMaison);
		$reponse->bindParam(':numeroM',$numeroM);
                $reponse->execute();
                $compte = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
                
                if ($compte>0){
                    echo "<p>Cette maison existe deja</br>";
                    echo "<a href = \"creaMaison.html\"><input type=\"button\" value=\"retour\"></a></p>";
                }else{
                    $reponse->CloseCursor();
                    //On recupere l'IdVIlle de la ville.
                    $requeteV = $dbco->prepare("SELECT IdVille FROM Ville WHERE nom_reel = ? AND CodePostal = ?");
                    $requeteV->execute([$ville,$CodePostal]);
                    $Idville = $requeteV->fetch(PDO::FETCH_ASSOC)["IdVille"];
                    //On vérifie que la requete retourne un résultat
                    if (isset($Idville)){
                        $sth = $dbco->prepare("
                        INSERT INTO Maison(NomMaison, NumeroMaison, Eval, Deg_iso, Rue, IdVille)
                        VALUES(?, ?, ? ,? ,? , ?)");
                        $sth->execute([$nomMaison,$numeroM,$eval,$degreISo,$Rue,$Idville]);
                        $sth->CloseCursor();                   

                        //On renvoie l'utilisateur vers la page d'accueil
                        header("Location:GestionMaison.php");
                    }
                    else{
                        echo "<p>La ville saisie n'existe pas, verifier le nom et/ou le code postal</br>";
                        echo "<a href = \"creaMaison.html\"><input type=\"button\" value=\"retour\"></a></p>";
                    }
                }
            }    
            catch(PDOException $e){
                echo 'Impossible de traiter les donnÃ©es. Erreur : '.$e->getMessage();
            }

        ?>
        
        
        
    </body>
</html>
