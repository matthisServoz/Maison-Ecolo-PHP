<?php
session_start(); // On démarre la session AVANT toute chose
?>
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
        <p>Cliquez sur "nouvelle maison" pour ajouter une nouvelle maison, 
            cliquez sur une maison deja existante pour y ajouter des appartements !</p>
        <a href = "creaMaison.html"> <button "type="button">nouvelle maison</button> </a>
        <p>Cliquez sur "Ajouter" pour ajouter un nouveau type d'appartement</p>
        <a href = "Ajout_type_appart.html"> <button "type="button">Ajouter</button> </a>
        
        <!<!-- Partie qui affiche la liste des maisons  -->
        <?php 
        
        
        // On compte le nombre de maison
        try{
            $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $reponse = $dbco->prepare("SELECT COUNT(*) "
                                    . "FROM maison");
            $reponse->execute();
            $nb_maison = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
            
        }
        catch(PDOException $e){
                echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
        }
        
        if ($nb_maison != 0){
            echo 
            "<p>Voici la liste des maisons :</p>".
            "<table>".
            "<caption>Liste des maisons</caption>".
            
            "<tr>".
                "<th>Nom de la maison</th>".
                "<th>Evaluation de base en terme d'eco-immeuble</th>".
                "<th>degres d'isolation</th>".
                "<th>Adresse</th>".
                "<th>Appartements associes</th>".
            "</tr>";
             
            //on recupere les info sur les maisons
            try{
                
                $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $reponse = $dbco->prepare("SELECT DISTINCT * ".
                                         "FROM maison INNER JOIN ville ".
                                         "ON (maison.IdVille = ville.IdVille)");
                $reponse->execute();
            }
            catch(PDOException $e){
                    echo 'Impossible de traiter les donnees. Erreur : '.$e->getMessage();
            }
            //on affiche les info des apparts sur chaque lignes
            for($index_maison = 0; $index_maison < $nb_maison; $index_maison++){
                $res = $reponse->fetch(PDO::FETCH_ASSOC);
                echo 
                "<tr>".
                    "<td>";
                        echo $res['NomMaison'];
                    echo 
                    "</td>".
                    "<td>";
                        echo $res['Eval'];
                    echo
                    "</td>".
                    "<td>";
                        echo $res['Deg_iso'];
                    echo
                    "</td>".
                    "<td>";
                        echo "numero ".$res['NumeroMaison']." ".$res['Rue']." a ".$res['nom_reel'];
                    echo
                    "</td>".
                    "<td>";
                        $appart = $dbco->prepare("SELECT COUNT(*) FROM appartement WHERE IdMaison = ?");
                        $appart->execute([$res['IdMaison']]);
                        $nb_appart = $appart->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
                        echo "Nombre d'appartements ".$nb_appart.
                             "<form action=\"GestionAppartement.php\" method=\"post\" >".
                             "<input type=\"hidden\" value=\"".$res['IdMaison']."\" id=\"IdMaison\" name=\"IdMaison\"/>".
                             "<input type=\"submit\" value=\"voir\" />".
                             "</form>";
                echo "</tr>";
            }
            $reponse->CloseCursor();
            $appart->CloseCursor();
            }
        else{
            echo "Vous ne louez pas d'appartement";
        }
        ?>
        

        
        
    </body>
    </head>
