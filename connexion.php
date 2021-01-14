<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="./CSS/styles.css" />
      <title> Page de connexion </title>
    </head>
    <body class="connexion">
        <header>
            <!-- barre en haut du site (menu) -->
            <div class="bandeau">
                <div class="logoSite">
                    <a href = "index.html">
                        <img src= "photoMenu.jpg" alt= "Appartement" title= "logo" width= "90" height= "60"> 
                    </a> 
                </div>
                <nav id="navigation">
                    <div class="nav">
                        <ul>
                            <li> <a href = "connexion.html">Connexion </a> </li>
                            <li> <a href = "inscription.html">Inscription </a> </li>
                            <li> <a href = "index.html">Accueil </a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <h1>Connexion</h1>
        </header>
        
        <form method="post" action= "connexion.php" >
            <fieldset>
                <legend>Vos identifiants</legend>
                <p>
                    <label for="nom_utilisateur">Nom d'utilisateur</label> :
                    <input type="text" name="nom_utilisateur" id="nom_utilisateur" placeholder="entrez votre nom d'utilisateur" size="40" required />
                    <br/>
                    <label for="password">Mot de passe:</label>
                    <input type="password" name="password" id="password" required />
                    <br/>
                    
            </fieldset>
                <input type="submit" value='LOGIN' />
        </form>
    </body>
</html>

