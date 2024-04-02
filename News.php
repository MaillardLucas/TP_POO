<?php
class News {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=news_site', 'root', '');
    }

    public function getLatestNews($limit) {
        $stmt = $this->db->prepare('SELECT * FROM news ORDER BY publish_date DESC LIMIT :limit');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNews($title, $description, $author, $image, $publish_date, $category_id) {
        // Insérer l'actualité dans la table news
        $stmt = $this->db->prepare('INSERT INTO news (title, description, author, image, publish_date) VALUES (:title, :description, :author, :image, :publish_date)');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':publish_date', $publish_date);
        $stmt->execute();
    
        // Récupérer l'ID de la dernière actualité insérée
        $news_id = $this->db->lastInsertId();
    
        // Insérer la relation entre l'actualité et la catégorie dans la table news_categories
        $stmt = $this->db->prepare('INSERT INTO news_categories (news_id, category_id) VALUES (:news_id, :category_id)');
        $stmt->bindParam(':news_id', $news_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
    }
    

    public function getCategories() {
        $stmt = $this->db->query('SELECT * FROM categories');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name) {
        $stmt = $this->db->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateCategory($id, $name) {
        $stmt = $this->db->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    
    public function getNewsByCategory($category_id) {
        $stmt = $this->db->prepare('SELECT * FROM news WHERE category_id = :category_id');
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getCategoryName($category_id) {
        $stmt = $this->db->prepare('SELECT name FROM categories WHERE id = :category_id');
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['name'] : null;
    }
}
?>
