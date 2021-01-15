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
                            <li> <a href = "AccueilUtil.php">Accueil</a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        </br>
        <p>Vous voulez faire une déclaration de location d'appartement ? Remplissez le formulaire ci-dessous.</p>
        <form action="inscription_php.php" method="post" >
            <!-- Début du formulaire d'inscription -->
            <fieldset class="formulaire_inscription">
                <legend>A propos de vous</legend>
                <p>
                    <label for="nom">Nom</label> :
                    <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" size="40" required />
                    <br/>
                    <label for="prenom">Prénom</label> :
                    <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom" size="40" required />
                    <br/>
                    <label for="Age">Age</label> :
                    <input type="number" name="Age" id="Age" min=18 required />
                    <br/>
                    Genre :<br />
                </p>
                <div>
                    <input type="radio" name="genre" value="Homme " id="genre_homme" /> <label for="genre_homme">Homme</label><br />
                    <input type="radio" name="genre" value="Femme " id="genre_femme" /> <label for="genre_femme">Femme</label><br />
                    <input type="radio" name="genre" value="Autre " id="genre_perso" /> <label for="genre_perso">Autre</label><br />
                </div>
            </fieldset>

    </body>
</head>