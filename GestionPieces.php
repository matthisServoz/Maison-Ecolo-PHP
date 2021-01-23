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
        <?php
        echo "<div><p>Cliquez sur \"Ajouter\" pour ajouter un nouveau type de piece</p>".
        "<form action=\"GestionPieces.php\" method=\"post\" >".
            "<p>".
            "<label for=\"Nomtype\">Nom du type de la piece </label> :".
            "<input type=\"text\" name=\"Nomtype\" id=\"Nomtype\" placeholder=\"Entrez ici\" size=\"40\" required />".
            "<input type=\"submit\" value=\"ajouter\" />".
            "</p>".
        "</form>".
        "</div>";
        //Partie qui affiche la liste des type de pieces
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
                "<p>Voici la liste des types de pieces :</p><table>".
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
                echo "</table>";
                }
            else{
                echo "<p>Il n'y a pas de type de piece</p>";
            }
        }
        ?>
        
        <?php
        if (isset($_POST['IdAppartement'])){
            echo "<div>
            <p> Voici les piece qu'il y a dans l'appartement :</p>";
            $requete_compt = $dbco->prepare("SELECT COUNT(*)"
                                    . "FROM piece WHERE IdAppartement = ?");
            $requete_compt->execute([$_POST['IdAppartement']]);
            $requete = $dbco->prepare("SELECT * "
                                    . "FROM piece INNER JOIN typepieces USING(IdTypePiece) WHERE IdAppartement = ?");
            $requete1 = $dbco->prepare("SELECT * "
                                        . "FROM typepieces");
            $requete1->execute();
            $resultat1 = $requete_compt->fetch(PDO::FETCH_ASSOC);
            
            echo "<p>Remplir le formulaire ci-dessous pour en ajouter .</p>";
            echo "<form action=\"GestionPieces.php\" method=\"post\" ><p>".
                  "<label for=\"NomPiece\">Nom de la piece</label> :".
                  "<input type=\"text\" name=\"NomPiece\" id=\"NomPiece\" placeholder=\"saisir le nom\" size=\"40\" required /></br>".
                  "<label for=\"ajoutPiece\">Selectionnez le type de piece a ajoute</label><br />".
                  "<select name=\"ajoutPiece\" id=\"ajoutPiece\">";
            foreach ($requete1 as $row){
                echo "<option value=".$row['NomType'].">".$row['NomType']."</option>";
            }
            echo "<input type=\"hidden\" value=\"".$_POST['IdAppartement']."\" id=\"IdAppartement\" name=\"IdAppartement\"/>".
                  "<input type=\"submit\" value=\"Ajouter\" /></p></form>";                        

            if (isset($_POST['IdAppartement']) AND isset($_POST['ajoutPiece']) AND isset($_POST['NomPiece'])){
                $requete_typePiece = $dbco->prepare("SELECT IdTypePiece FROM typepieces WHERE NomType = ?");
                $requete_typePiece->execute([$_POST['ajoutPiece']]);
                $res = $requete_typePiece->fetch(PDO::FETCH_ASSOC);
                $requete_ajout = $dbco->prepare("INSERT INTO piece(NomPiece , IdAppartement, IdTypePiece) "
                                                . "VALUES (? , ? , ?);");
                $requete_ajout->execute([$_POST['NomPiece'],$_POST['IdAppartement'], $res['IdTypePiece']]);
                
                $requete_ajout->closeCursor();
                $requete_typePiece->closeCursor();
            }
            $requete->execute([$_POST['IdAppartement']]);
            echo "<table>".
                 "<tr>".
                "<th>Nom de la piece</th>".
                "<th>Type de piece</th>".
                "</tr>";
            foreach ($requete as $row){
                echo
                "<tr>".
                    "<td>"
                        .$row['NomPiece'].
                    "</td>".
                    "<td>"
                        .$row['NomType'].
                    "</td>".
                "</tr>";
            }
            echo "</table>";
            
        }else{
            echo "<p><a href = \"GestionMaison.php\"><input type=\"button\" value=\"retour\"></a></p>";
        }
        ?>
        </div>
        
    </body>
</head>
