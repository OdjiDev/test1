
<?php
// Définition du chemin vers le répertoire Git
$cheminRepo = "/C:\xampp1\htdocs\CRUDGIT";

// Boucle infinie pour vérifier périodiquement les mises à jour

while (true!=0) {
    // Commande git pour vérifier les mises à jour
    $output = shell_exec("cd $cheminRepo && git fetch origin && git status -uno");

    // Vérification des mises à jour
    if (strpos($output, 'Your branch is behind') !== false) {
        // Affichage d'un message ou exécution d'une action en cas de mises à jour
        echo "Mises à jour disponibles sur Git!\n";
    } else {
        // Affichage d'un message si aucune mise à jour n'est disponible
        echo "Aucune mise à jour disponible.\n";
    }

    // Attendre 10 secondes avant la prochaine vérification
    sleep(10);
}
?>
