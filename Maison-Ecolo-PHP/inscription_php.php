<!DOCTYPE html>

<html>
    <head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Quentin SCHAU"/>
        <link rel="stylesheet" href="./CSS/styles.css">
    </head>
	<body class='inscription'>
		<?php
			$serveur = "localhost";
			$dbname = "mesappartements";
			$user = "root";
			$pass = "";
			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$Age = $_POST["Age"];
			$genre = $_POST["genre"];
			$ville = $_POST["ville"];
			$code_postal = $_POST["code_postal"];
			$rue = $_POST["rue"];
			$num_maison = $_POST["num_maison"];
			$email = $_POST["email"];
			$numero_tel = $_POST["numero_tel"];
			$password = $_POST["password"];
			$nom_utilisateur = $_POST["nom_utilisateur"];
                        $DateCrea = date('y-m-d H:i:s');
                        $EtatCompte = "Actif";
                        $Admin = $_POST["Admin"];
                        
			
			try{
				//On se connecte à la BDD
				$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
				$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
                                //On vérifie que l'utilisateur n'existe pas 
                                
                                $reponse = $dbco->prepare("SELECT COUNT(*) FROM users WHERE Nom = :nom and Prenom = :prenom and AdresseMail = :email");
                                $reponse->bindParam(':nom',$nom);
				$reponse->bindParam(':prenom',$prenom);
                                $reponse->bindParam(':email',$email);
                                $reponse->execute();
                                $compte = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
                                
                                if ($compte>0){
                                    echo "<p>adresse mail déjà utilisée</br>";
                                    echo "<a href = \"inscription.html\"><input type=\"button\" value=\"retour\"></a></p>";
                                }else{
                                    //Sinon on insère les données reçues
                                    $sth1 = $dbco->prepare("
                                            INSERT INTO ville( Ville , CodePostal , Rue , num_maison , IdDepartement)
                                            VALUES( :ville , :code_postal , :rue , :num_maison , :IdDepartement)");

                                    $sth1->bindParam(':ville',$ville);
                                    $sth1->bindParam(':code_postal',$code_postal);
                                    $sth1->bindParam(':rue',$rue);
                                    $sth1->bindParam(':num_maison',$num_maison);
                                    $sth1->bindParam(':IdDepartement',floor($code_postal/1000));
                                    $sth1->execute();
                                    $sth1->CloseCursor();

                                    $sth = $dbco->prepare("
                                            INSERT INTO users( Nom , Prenom , Age , Genre , AdresseMail , NumeroTel , nom_utilisateur , password , EtatCompte , DateCrea , Admin ,IdVille)
                                            VALUES( :nom , :prenom , :Age , :genre , :email , :numero_tel , :nom_utilisateur , :password , :EtatCompte  , :DateCrea , :Admin , :IdVille)");
                                    $sth->bindParam(':nom',$nom);
                                    $sth->bindParam(':prenom',$prenom);
                                    $sth->bindParam(':Age',$Age);
                                    $sth->bindParam(':genre',$genre);
                                    $sth->bindParam(':email',$email);
                                    $sth->bindParam(':numero_tel',$numero_tel);
                                    $sth->bindParam(':nom_utilisateur',$nom_utilisateur);
                                    $sth->bindParam(':password',$password);
                                    $sth->bindParam(':EtatCompte',$EtatCompte );
                                    $sth->bindParam(':DateCrea',$DateCrea);
                                    $sth->bindParam(':Admin',$Admin);
                                    $sth->bindParam(':IdVille',$dbco->lastInsertId());
                                    $sth->execute();
                                    

                                    header("Location:connexion.html");
                                    
                                }
                        }
			catch(PDOException $e){
				echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
			}
		?>
	</body>
</html>
