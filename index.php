<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    Mon premier commit distant est a jour ou pas
    <div class="container">
        <a href="ajouter.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        
        <table>
            <tr id="items">
                 <th>id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>





        <?php 

              
            






                //inclure la page de connexion
                include_once "connexion.php";
                 include_once "phplanceMAJ.php";

                //requête pour afficher la liste des employés
               // Requête préparée pour éviter les injections SQL
                $requete = $pdo->prepare("SELECT * FROM users ");
                $requete->execute();
                if($requete->rowCount() == 0){
                    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore d'utilisateurs ajouter !" ;
                    
                }else {







                    $row = $requete->fetch(PDO::FETCH_ASSOC);

                    //si non , affichons la liste de tous les employés
                    while($row = $requete->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['nom']?></td>
                            <td><?=$row['username']?></td>
                            <td><?=$row['age']?></td>
                            <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                            <td><a href="modifier.php?nom=<?=$row['id']?>"><img src="images/pen.png"></a></td>
                            <td><a href="supprimer.php?nom=<?=$row['id']?>"><img src="images/trash.png"></a></td>
                        </tr>
                        <?php
                    }
                    
                }
            ?>
      
         
        </table>
   
   
   
   
    </div>



    essayons le commit
</body>
</html>