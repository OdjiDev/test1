<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

         //connexion à la base de donnée
          include_once "connexion.php";
          
         //on récupère le id dans le lien
          $nom = $_GET['nom'];

 // Requête préparée pour éviter les injections SQL
 $requete = $pdo->prepare("SELECT * FROM users WHERE nom = :$nom");
 //$requete->bindParam(':nomUtilisateur', $nom);
// $requete->execute([$nom]);

       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
        // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $id= $_POST['id'];
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($id) && isset($nom) && isset($prenom) && $age){
               //requête de modification

    // Liaison des paramètres
                $$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
                $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $requete->bindParam(':age', $age, PDO::PARAM_INT);
                $requete->bindParam(':id', $id, PDO::PARAM_INT);
               $requete = $pdo->prepare( "UPDATE users SET nom = '$nom' , prenom = '$prenom' , age = '$age' WHERE id = $id");
                if($requete){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: index.php");
                }else {//si non
                    $message = "utilisateur non modifié";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
       // Récupération des données de l'enregistrement à modifier depuis la base de données
//$id = /* ID de l'enregistrement à modifier */;
$requete = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$requete->bindParam(':id', $id, PDO::PARAM_INT);
$requete->execute();
$row = $requete->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier l'utilisateur : </h2>
        <p class="erreur_message">
           <?php 
              if(isset($message)){
                  echo $message ;
              }
        if($row){
           ?>
        </p>
    
        <form action="" method="POST">
             <label>Id</label>
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>?>">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($row['nom']) ?>?>">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($row['prenom']) ?>">
            <label>âge</label>
            <input type="number" name="age" value="<?= htmlspecialchars($row['age']) ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
        <?php
} else {
    echo "Aucun enregistrement trouvé avec l'ID spécifié.";
}
?>
    </div>
</body>
</html>