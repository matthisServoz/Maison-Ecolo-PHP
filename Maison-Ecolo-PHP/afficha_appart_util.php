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
                        <li> <a href = "PageStat.php">monCompte </a> </li>
                        <li> <a href = "connexion.html">mes Maisons </a> </li>
                        <li> <a href = "index.html">ma Consomation </a> </li>
               
                    </ul>
                </div>
            </nav>
            
        </div>
