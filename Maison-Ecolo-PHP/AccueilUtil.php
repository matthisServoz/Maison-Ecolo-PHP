<?php
session_start(); // On démarre la session AVANT toute chose
$_SESSION['nom_utilisateur']='PierreTheRock';
$_SESSION['IdUser']=1;
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
                        <li> <a href = "compte_util.php">monCompte </a> </li>
                        <li> <a href = "afficha_appart_util.php">mes appartements</a> </li>
                        <li> <a href = "AccueilUtil.html">ma Consomation </a> </li>
               
                    </ul>
                </div>
            </nav>
            
        </div>
               
        <h1>Bienvenue <?php echo $_SESSION['nom_utilisateur']?> sur notre site</h1>
        
        <p>Voici les appartements que tu loue</p>
        
        <?php 
        // On compte le nombre d'appartement que loue l'utilisateur
        try{
            $date = date('y-m-d H:i:s');
            $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $reponse = $dbco->prepare("SELECT COUNT(*) "
                                    . "FROM louer AS l INNER JOIN appartement AS a ON (l.IdAppartement = a.IdAppartement)"
                                    . " WHERE DateDebutL <= ? "
                                        . "AND DateFinL > ? "
                                        . "AND IdUser = ? ;");
            $reponse->execute([$date,$date,$_SESSION['IdUser']]);
            $nb_appart = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
            $reponse->CloseCursor();
        }
        catch(PDOException $e){
                echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
        }
        ?>
        
        <table>
            <caption>Appartement loués</caption>
            
            <tr>
                <th>numéro d'appartement</th>
                <th>adresse</th>
                <th>Situé dans l'immeuble</th>
            </tr>
            <?php 
            //on récupère les id des appartements
            try{
                $date = date('y-m-d H:i:s');
                $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $reponse = $dbco->prepare("SELECT l.IdAppartement "
                                        . "FROM louer AS l INNER JOIN appartement AS a ON (l.IdAppartement = a.IdAppartement)"
                                        . " WHERE DateDebutL <= ? "
                                            . "AND DateFinL > ? "
                                            . "AND IdUser = ? ;");
                $reponse->execute([$date,$date,$_SESSION['IdUser']]);
            }
            catch(PDOException $e){
                    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
            }
            //on affiche les info des apparts sur chaque lignes
            for($index_appart = 0; $index_appart < $nb_appart; $index_appart++){
            $res = $reponse->fetch(PDO::FETCH_ASSOC)["IdAppartement"];
            echo 
            "<tr>".
                "<td>";
                    
                    echo $res;
                echo 
                "</td>".
                "<td>";
                    try{
                        $date = date('y-m-d H:i:s');
                        $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
                        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $reponse1 = $dbco->prepare("SELECT IdMaison,NomMaison,NumeroMaison,v.ville,v.IdVille,v.CodePostal,v.Rue "
                                                . "FROM maison INNER JOIN ville AS v ON (maison.IdVille = v.IdVille) "
                                                . "WHERE maison.IdMaison IN "
                                                    . "(SELECT IdMaison "
                                                    . "FROM louer AS l INNER JOIN appartement AS a ON (l.IdAppartement = a.IdAppartement)"
                                                    . " WHERE DateDebutL <= ? "
                                                        . "AND DateFinL > ? "
                                                        . "AND IdUser = ? AND l.IdAppartement = ?) ");
                        $reponse1->execute([$date,$date,$_SESSION['IdUser'],$res]);
                        //On récupère les infos sur la ligne (de la requête)
                        foreach ($reponse1 as $row){
                            echo "numéro " . $row['NumeroMaison'] . " rue " . $row['Rue'] . " à " . $row['ville'] . " " . $row['CodePostal'];
                            $NomMaison = $row['NomMaison'];

                        }
                    }
                    catch(PDOException $e){
                            echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
                    }
                echo
                "</td>".
                "<td>";
                    echo $NomMaison;
                    
                echo
                "</td>";
            }
            $reponse->CloseCursor();
            $reponse1->CloseCursor();
            ?>
        
        
    </body>
</html>

