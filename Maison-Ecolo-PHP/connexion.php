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
                // Démarage de la session  
                session_start();
                // On recupere le nom et le mdp de l'utilisateur
                $_SESSION['nom_utilisateur'] = $_POST['nom_utilisateur'];
                $_SESSION['password'] = $_POST['passord'];

                $DATABASE_HOST = 'localhost';
                $USER = 'root';
                $PASSWORD = '';
                $DATABASE_NAME = 'mesappartements';
                
                try{
			//On se connecte à la BDD
			$dbco = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME",$USER,$PASSWORD);
			$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
                        if ( mysqli_connect_errno() ) {
                                // S'il y a une erreur avec la connexion ca arrête le script et affiche l'erreur.
                                exit('Erreur dans MySQL : ' . mysqli_connect_error());
                        }
                        
                        if ( !isset($_POST['nom_utilisateur'], $_POST['password']) ) {
                            //Impossible d'obtenir les données qui auraient dû être envoyées.
                            exit('Veuillez remplir les champs nom dutilisateur et mot de passe!');
                        }
                        
                        if($stmt = $dbco->prepare('SELECT IdUser, password FROM users WHERE nom_utilisateur = ?')){
                        
                }
                ?>
        </body>
</html>