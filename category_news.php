<?php
require_once 'News.php';

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $news = new News();
    $category_name = $news->getCategoryName($category_id); // Méthode à implémenter dans News pour obtenir le nom de la catégorie
    $category_news = $news->getNewsByCategory($category_id); // Méthode à implémenter dans News pour obtenir les actualités par catégorie
} else {
    // Gérer le cas où aucune catégorie n'est sélectionnée
    // Par exemple, rediriger vers une page par défaut ou afficher un message d'erreur
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités par Catégorie - Mon Site d'Actualités</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
</head>
<body>
    <div class="container mt-5">
        <h1>Actualités pour la catégorie <?= $category_name ?></h1>
        <div class="row">
            <?php foreach ($category_news as $item): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['title'] ?></h5>
                            <p class="card-text"><?= $item['description'] ?></p>
                            <p class="card-text">Publié par <?= $item['author'] ?> le <?= $item['publish_date'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>