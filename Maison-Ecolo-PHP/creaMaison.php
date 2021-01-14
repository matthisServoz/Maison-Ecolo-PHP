<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
		//On se connecte à la BDD
		$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
		$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                 //On vérifie que la maison n'existe pas 
                                
                $reponse = $dbco->prepare("SELECT COUNT(*) FROM Maison WHERE nomMaison = :nomM and numeroM = :numeroM");
                $reponse->bindParam(':nomMaison',$nomMaison);
		$reponse->bindParam(':numeroM',numeroM);
                $reponse->execute();
                $compte = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
                
                if ($compte>0){
                    echo "<p>Cette maison existe deja</br>";
                    echo "<a href = \"creaMaison.html\"><input type=\"button\" value=\"retour\"></a></p>";
                }else{
                    
                    //Sinon on insère les données reçues
                    $sth = $dbco->prepare("
                    INSERT INTO Ville(CodePostal , Rue, num_maison, ville, idDepartement )
                    VALUES(:codePostal , :rue , :numMaison , :ville, :idDep)");
                    $sth->bindParam(':rue',$rue);
                    $sth->bindParam(':numeroM',$numeroM);
                    $sth->bindParam(':numMaison',$numMaison);
                    $sth->bindParam(':ville',$ville);
                    $sth->bindParam(':idDep',floor($code_postal/1000));
                    
                    $sth->execute();
                    $sth->CloseCursor();
                    
                    
                                    
                    $sth1 = $dbco->prepare("
                    INSERT INTO users(nomMaison , numeroM, eval, degreIso, ville )
                    VALUES(:nomMaison , :numeroM , :eval , :degreIso , :ville)");
                    $sth1->bindParam(':nomMaison',$nomMaison);
                    $sth1->bindParam(':numeroM',$numeroM);
                    $sth1->bindParam(':eval',$eval);
                    $sth1->bindParam(':degreIso',$degreIso);
                    $sth1->bindParam(':idVille',$dbco->lastInsertId());
                    
                    $sth1->execute();
                    
                    
                    //On renvoie l'utilisateur vers la page d'accueil
                    header("Location:creaMaison.html");
                }
                }
                catch(PDOException $e){
                    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
                    }
                
        ?>
        
        
        
    </body>
</html>
