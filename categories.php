<h2 class="mt-5">Catégories</h2>
        <ul class="list-group">
            <?php foreach ($categories as $category): ?>
                <li class="list-group-item"><?= $category['name'] ?></li>
            <?php endforeach; ?>
        </ul>