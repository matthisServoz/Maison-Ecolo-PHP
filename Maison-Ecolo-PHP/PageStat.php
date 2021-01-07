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
    <body>
        </br>
        <table>
            <caption>Nombre d'inscrit</caption>

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
                    ?></td>
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
        </table>

   
        ?>
    </body>
</html>
