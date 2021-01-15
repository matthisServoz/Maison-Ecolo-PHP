<?php
session_start(); // On dÃ©marre la session AVANT toute chose
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
    <body class = "inscription"> 
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
                            <li> <a href = "AccueilUtil.php">Accueil</a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        </br>
        <?php
        $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Si l'utilisateur à fourni 2 date pour la location alors :
        if (isset($_POST['DateFinL']) AND isset($_POST['DateDebL']))
        {
            echo "<p>Voici les appartements disponible selon les dates :</p>";
            $DateFinL = $_POST['DateFinL'];
            $DateDebL= $_POST['DateDebL'];
            
            $_SESSION['DateFinL'] = $DateFinL;
            $_SESSION['DateDebL'] = $DateDebL;
            //La view ci-dessous permet de trouvers les appartements qui sont disponible pour être loué
            //Elle utilise de sous-requete une indiquant les appart qui sont loue
            //L'autre indique les appart qui sont loue pendant la date de debut que l'utilisateur à fourni
            //Puis on prend les appartements qui ne sont pas dans ces deux sous-requêtes
            $requete_crea_view1 = $dbco->query("DROP VIEW IF EXISTS appart_dispo;");
            $requete_crea_view1->CloseCursor();
            $requete_crea_view = $dbco->prepare("                
                CREATE VIEW Appart_Dispo AS
                SELECT DISTINCT l1.IdAppartement,l1.IdMaison
                FROM appartement l1 LEFT OUTER JOIN louer l2 USING(IdAppartement)
                WHERE l1.IdAppartement NOT IN (SELECT IdAppartement
                FROM louer)
                OR l1.IdAppartement  NOT IN (SELECT IdAppartement
                FROM louer
                WHERE :date BETWEEN DateDebutL AND DateFinL);");
            $requete_crea_view->bindParam(':date',$DateDebL);
            $requete_crea_view->execute();
            $requete_crea_view->CloseCursor();
            $requete_comptage = $dbco->query("SELECT COUNT(*) FROM appart_dispo;");
            $nb_appart_dispo = $requete_comptage->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
            //si il n'y a pas d'appartement disponible on demande de rentrer de nouvelle date
            if($nb_appart_dispo == 0){
                echo "<p>Il n'y a aucun appartement disponible aux dates choisie. Veuillez resaisir de nouvelles dates.</p>";
                echo "<a href = \"Location_formulaire.php\"><input class=\"bouton\" type=\"button\" value=\"retour\"></a></p>";
            }else{
                //on utilise la view qui a ete cree precedemment pour avoir les infos
                $requete_info = $dbco->prepare("SELECT * FROM appart_dispo");
                $requete_info->execute([$DateDebL]);
                echo "<form action=\"Location_formulaire.php\" method=\"post\" >
                    <div>";
                for($index = 0; $index < $nb_appart_dispo; $index++){
                    //On recupere les informations suivant les lignes
                    $information = $requete_info->fetch(PDO::FETCH_ASSOC);
                    //On recurer l'adresse associe a l'appartement
                    $requete_adresse = $dbco->prepare("SELECT DISTINCT * ".
                                                    "FROM maison INNER JOIN ville ".
                                                    "ON (maison.IdVille = ville.IdVille)".
                                                    "WHERE maison.IdMaison = ?");
                    $requete_adresse->execute([$information['IdMaison']]);
                    $adresse = $requete_adresse->fetch(PDO::FETCH_ASSOC);
                    //On affiche l'input ratio avec le donnee de l'appartement et de la ligne lu (issue de la requete)
                    echo 
                    "<input type=\"radio\" name=\"appartement_choisi\" value= \"".$information['IdAppartement']."\" id= \"".$information['IdAppartement']."\" />".
                            "<label for=\"".$information['IdAppartement']."\">".
                            "Appartement ".$information['IdAppartement']." maison ".$adresse['NumeroMaison']." ".$adresse['Rue']." a ".$adresse['nom_reel'].
                            "</label><br />";
                    $requete_comptage->CloseCursor();
                }
                $requete_info->CloseCursor();
                echo "</div>"
                . "<input type=\"submit\" value=\"choisir\" />"
                ."</form>";
            }
           $requete_comptage->CloseCursor();
        }//On est dans le cas ou on a choisi sont appartements il reste plus qu'a l'inserer
        else if (isset($_POST['appartement_choisi'])){
            $insert = $dbco->prepare("INSERT INTO `louer` (`IdUser`, `DateDebutL`, `DateFinL`, `IdAppartement`) "
                    . "VALUES (:IdUser, :DateDeb, :DateFin, :IdAppartement)");
            $insert->bindParam(':IdUser',$_SESSION['IdUser']);
            $insert->bindParam(':DateDeb',$_SESSION['DateDebL']);
            $insert->bindParam(':DateFin',$_SESSION['DateFinL']);
            $insert->bindParam(':IdAppartement',$_POST['appartement_choisi']);
            $insert->execute();
            $insert->closeCursor();
            header("Location:AccueilUtil.php");
        }else{
            echo
            "<p>Vous voulez faire une declaration de location d'appartement ? Remplissez le formulaire ci-dessous.</p>
            <form action=\"Location_formulaire.php\" method=\"post\" >
                <!-- Début du formulaire d'inscription -->
                <p>Duree de la location : 
                    <br/>
                    <label for=\"DateDebL\">Date de debut de location</label> :
                    <input type=\"date\" name=\"DateDebL\" id=\"DateDebL\" required />
                    <br/>
                    Exemple : 2021-01-01 00:00:01
                    <br/>
                    <label for=\"DateFinL\">Date de fin de location</label> :
                    <input type=\"date\" name=\"DateFinL\" id=\"DateFinL\"  required />
                    <br/>
                    Exemple : 2021-12-31 23:59:59
                    <br/>
                    <br/>
                    Ainsi selon l'exemple je veux louer un appartement du 01 janvier 2021 au 31 Decembre 2021
                    <br/>
                </p>
                <input type=\"submit\" value=\"Louer\" />
            </form>
            ";
        }
      
        
        ?>
    </body>
</html>