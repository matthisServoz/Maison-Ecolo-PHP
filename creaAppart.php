<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="./CSS/styles.css">
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
                            <li> <a href = "AccueilAdmin.html">Accueil</a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        </br>
                
        <?php
            //On se connecte Ã  la BDD
            $dbco = new PDO("mysql:host=localhost;dbname=mesappartements","root","");
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //si le formulaire vient d'être remplit
            if(isset($_POST['IdMaison']) AND isset($_POST['Deg_sec'])){
                $IdMaison = $_POST["IdMaison"];
                $Deg_sec = $_POST["Deg_sec"];            
                $type_appart_choisi = $_POST["type_appart_choisi"];
                try{
                //On vÃ©rifie que l'a maison'appartement n'existe pas 

                    $reponse = $dbco->prepare("SELECT COUNT(*) FROM appartement WHERE Deg_sec = ? AND IdMaison = ? AND IdTypeAppartement = ?");
                    $reponse->execute([$Deg_sec,$IdMaison,$type_appart_choisi]);
                    $compte = $reponse->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];

                    if ($compte>0){
                        $reponse->CloseCursor();
                        echo "<p>Cet appartement existe deja</br>";
                        echo "<a href = \"creaAppart.php\"><input type=\"button\" value=\"retour\"></a></p>";
                    }else{
                        $reponse->CloseCursor();
                        //On ajout l'appartemnt
                        $requeteV = $dbco->prepare("INSERT INTO Appartement(Deg_sec , IdMaison , IdTypeAppartement)
                            VALUES(?, ?, ? )");
                        $requeteV->execute([$Deg_sec,$IdMaison,$type_appart_choisi]);
                        $requeteV->CloseCursor();
                        header("Location:GestionMaison.php");
                    }
                }    
                catch(PDOException $e){
                    echo 'Impossible de traiter les donnÃ©es. Erreur : '.$e->getMessage();
                }
            }
            //On affiche le formulaire pour qu'il soit rempli
            else{
                try{
                $IdMaison = $_POST['IdMaison'];
                echo "<form action=\"creaAppart.php\" method=\"post\" >
                    <fieldset class=\"formulaire_inscription\">
                    <legend>information de votre maison</legend>
                    <p>
                        <label for=\"Deg_sec\">Degre de securite</label> :
                        <input type=\"text\" name=\"Deg_sec\" id=\"Deg_sec\" placeholder=\"Entrez le degre de securite\" size=\"40\" required />".
                        "</br>";
                //On récupère tous les type d'appartement
                $requete_comptage = $dbco->query("SELECT COUNT(*) FROM typeappartement;");
                $nb_type_appart = $requete_comptage->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
                //si il n'y a pas de type d'appartement 
                if($nb_type_appart == 0){
                    echo "<p>Il n'y a aucun type d'appartement</p>";
                }else{
                    //on recupere tous les types d'appartement
                    $requete_info = $dbco->prepare("SELECT * FROM typeappartement");
                    $requete_info->execute();
                    echo "<table>";
                    foreach ($requete_info as $row){
                        echo "<tr>".
                        "<td>";
                        echo 
                        "<input type=\"radio\" name=\"type_appart_choisi\" value= \"".$row['IdTypeAppartement'].
                        "\" id= \"".$row['IdTypeAppartement'].
                        "\" />";
                        echo 
                        "</td>".
                        "<td>".$row['Libelle']." ";
                    }
                    echo 
                    "</td>".
                    "</tr></table></br>";
                    $requete_info->CloseCursor();
                }
                $requete_comptage->CloseCursor();
                echo "<a href = \"Ajout_type_appart.html\"><input class=\"bouton\" type=\"button\" value=\"ajouter un type d'appartement\"></a></p>";
                echo 
                    "<br/></p></fieldset>".
                    "<input type=\"submit\" value=\"ajouter l'appartement\" />".
                    "<input type=\"hidden\" value=\"".$IdMaison."\" id=\"IdMaison\" name=\"IdMaison\"/>".
                    "</form>";
                }catch(PDOException $e){
                    echo 'Impossible de traiter les donnÃ©es. Erreur : '.$e->getMessage();
                }
            }

        ?>
                
    </body>
</html>
