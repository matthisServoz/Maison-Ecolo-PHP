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
    <body class = 'inscription'>
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
        <p>Cliquez sur "Ajouter" pour ajouter un nouveau type de piece</p>
        <form action="GestionPieces.php" method="post"  >
            <p>
            <label for="Nomtype">Nom du type de la piece </label> :
            <input type="text" name="Nomtype" id="Nomtype" placeholder="Entrez ici" size="40" required />
            <input type="submit" value="ajouter" />
            </p>
        </form>
        <!-- Partie qui affiche la liste des type de pieces  -->
        <?php 
        $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['Nomtype'])){
            $requete = $dbco->prepare("INSERT INTO typepieces(Nomtype)"
                                    . "VALUES(?);");
            $requete->execute([$_POST['Nomtype']]);
            header("Location:GestionPieces.php");
        }else{
            // On compte le nombre de pieces
            try{
                $requete_compt = $dbco->prepare("SELECT COUNT(*)"
                                        . "FROM typepieces");
                $requete_compt->execute();
                $requete = $dbco->prepare("SELECT * "
                                        . "FROM typepieces");
                $requete->execute();
                $resultat1 = $requete_compt->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
            }
            if ($resultat1["COUNT(*)"] != 0){
                echo 
                "<p>Voici la liste des types de pieces :</p>".
                "<table>".
                "<caption>Liste des types de piece</caption>".

                "<tr>".
                    "<th>Nom du type</th>".
                "</tr>";

                foreach ($requete as $row){
                    echo
                    "<tr>".
                        "<td>"
                            .$row['NomType'].
                        "</td>".
                    "</tr>";
                }
                $requete->CloseCursor();
                $requete_compt->CloseCursor();

                }
            else{
                echo "<p>Il n'y a pas de type de piece</p>";
            }
        }
        ?>
        
    </body>
</head>
