<?php
require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];
    $articleRepository = new ArticleRepository('articles.json');
    
    // Call the deleteArticleById method to delete the article
    $articleRepository->deleteArticleById($articleId);
    
    // Redirect back to the article list or any other appropriate page
    header('Location: index.php'); // Redirect to the article list
    exit();
}
