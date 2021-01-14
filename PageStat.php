<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>MyHouse</title>
        <link rel="stylesheet" href="./CSS/styles.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body class='PageStat'>
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
                            <li> <a href = "AccueilAdmin.html">Accueil</a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        </br>
        <p>Vous trouvez ci-dessous quelques statistiques concernant les utilisateurs de <strong>Mes Appartement</strong></p>
        </br>
        <table>
            <caption>Nombre d'inscrits</caption>

            <tr>
                <th></th>
                <th>Hommes</th>
                <th>Femmes</th>
                <th>Autres</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>Nombre d'inscrit</td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE Genre='homme'");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre_homme = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre_homme["COUNT(*)"];
                    ?>
                </td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE Genre='femme'");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre_femme = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre_femme["COUNT(*)"];
                    ?>
                </td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE Genre='autre'");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre_autre = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre_autre["COUNT(*)"];
                    ?>
                </td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre_total = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre_total["COUNT(*)"];
                    ?>
                </td>
            </tr>
        </br>

        <table>
            <caption>Nombre d'abonnées par tranches d'âge</caption>
            
            <tr>
                <th>Tranches d'âge :</th>
                <th>[18 - 24]</th>
                <th>]24 - 45]</th>
                <th>]45 - 65]</th>
                <th>+65</th>
            </tr>
            <tr>
                <td>Nombre :</td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE age >=18 and age <= 24 ");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre["COUNT(*)"];
                    ?>
                </td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE age >24 and age <= 45 ");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre["COUNT(*)"];
                    ?></td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE age >45 and age <=65 ");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre["COUNT(*)"];
                    ?>
                </td>
                <td>
                    <?php
                    //Connection avec la BDD.
                    $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
                    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //On execute la requete
                    $reponse = $data->prepare("SELECT COUNT(*) FROM users WHERE age >65 ");
                    $reponse->execute();
                    //on récupere la premiere ligne avec fetch
                    $nombre = $reponse->fetch(PDO::FETCH_ASSOC);
                    //On l'afficher la valeur
                    echo $nombre["COUNT(*)"];
                    ?>
                </td>
            </tr>
            
        
        </br>
        
        
    </body>
</html>
