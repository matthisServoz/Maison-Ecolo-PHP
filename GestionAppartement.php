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
        <header>
            <!-- barre en haut du site (menu) -->
            <div class="bandeau">
                <div class="logoSite">
                    <a href = "AccueilAdmin.html">
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
        <p>Cliquez sur "ajout" pour ajouter un nouveau appartement</p>
        <a href = "creaMaison.html"> <button "type="button">nouveau appartement</button> </a>
        <div>
            <?php 

            $IdMaison = $_POST['IdMaison'];
            // On compte le nombre de maison
            try{
                $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $reponse = $dbco->prepare("SELECT COUNT(*) "
                                        . "FROM appartement WHERE IdMaison = ?");
                $reponse->execute([$IdMaison]);
                $nb_appart = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];

            }
            catch(PDOException $e){
                    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
            }

            if ($nb_appart != 0){
                echo 
                "<p>Voici la liste des appartements:</p>".
                "<table>".
                "<caption>Liste des appartements </caption>".

                "<tr>".
                    "<th>Numero de l'appartement</th>".
                    "<th>degres d'isolation</th>".
                    "<th>Type</th>".
                "</tr>";

                //on recupere les info sur les maisons
                try{

                    $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
                    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $reponse = $dbco->prepare("SELECT DISTINCT * ".
                                             "FROM maison INNER JOIN appartement ".
                                             "ON (maison.IdMaison = appartement.IdMaison)".
                                             "WHERE appartement.IdMaison = ?");
                    $reponse->execute([$IdMaison]);
                }
                catch(PDOException $e){
                        echo 'Impossible de traiter les donnees. Erreur : '.$e->getMessage();
                }
                //on affiche les info des apparts sur chaque lignes
                for($index_appart = 0; $index_appart < $nb_appart ; $index_appart++){
                    $res = $reponse->fetch(PDO::FETCH_ASSOC);
                    echo 
                    "<tr>".
                        "<td>";
                            echo $res['IdAppartement'];
                        echo 
                        "</td>".
                        "<td>";
                            echo $res['Deg_sec'];
                        echo
                        "</td>".
                        "<td>";

                    echo "</tr>";

                }
                $reponse->CloseCursor();
                }
            else{
                echo "<p>Il n'y a pas d'appartement rattache a cette maison.</p>";
            }
            ?>
        </div>        
        <a href = "GestionMaison.php"> <button "type="button">retour</button> </a>
        
    </body>
</head>
