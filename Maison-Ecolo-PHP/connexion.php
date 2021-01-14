
 <?php
        // Démarage de la session  
        session_start();
        ?>
<!DOCTYPE html>

<html>
    <head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Théo MILLAIRE"/>
        <link rel="stylesheet" href="./CSS/styles.css">
    </head>
	<body class='inscription'>
           
            <?php
                // On recupere le nom et le mdp de l'utilisateur
		$serveur = "localhost";
		$dbname = "mesappartements";
		$user = "root";
		$pass = "";
                
                $password = $_POST['password'];
                $nom_utilisateur = $_POST['nom_utilisateur'];

               try{
                    $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
                    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $connexion = $dbco->prepare("SELECT COUNT(*) FROM users WHERE nom_utilisateur = ? AND password = ?");
                    $connexion->execute([$nom_utilisateur,$password]);
                    $compte = $connexion->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
                    
                    if($compte > 0){
                        $reponse = $dbco->prepare("SELECT IdUser, Admin FROM users WHERE nom_utilisateur = ? AND password = ?");
                        $reponse->execute([$nom_utilisateur,$password]);

                        foreach ($reponse as $row ) {
                            $IdUser = $row['IdUser'] ;
                            $Admin = $row['Admin'];
                        }

                        $_SESSION['nom_utilsateur'] = $nom_utilisateur;
                        $_SESSION['IdUser'] = $IdUser;
                        $_SESSION['password'] = $password;
                        $_SESSION['Admin'] = $Admin;

                        if($Admin == 'administrateur'){
                            header("Location:AccueilAdmin.html");
                        }
                        else if($Admin == 'utilisateur'){
                            header("Location:AccueilUtil.php");
                        }
                    }
                    else{
                      echo "<p>Nom ou mot de passe incorrect</br>";
                      echo "<a href = \"connexion.html\"><input type=\"button\" value=\"retour\"></a></p>";  
                    }
                }
                catch(PDOException $e){
                        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
                }
            ?>
        </body>
</html>