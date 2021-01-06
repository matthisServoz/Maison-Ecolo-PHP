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
         <?php//Connection avec la BDD.
            $data = new PDO('mysql:host=localhost; dbname=mesappartements', 'root', '');
            
            $data->query("SELECT COUNT(*) FROM users WHERE Genre='homme'");
            $donnees = $res->fetch_assoc();
            <strong>nombre d'homme sur le site</strong> : <?php echo $donnees ?><br />
            $data->closeCursor();
        ?>
    </body>
</html>
