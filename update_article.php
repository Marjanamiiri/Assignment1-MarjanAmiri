<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $articleId = (int)$_POST['id'];
    $newTitle = $_POST['title'];
    $newUrl = $_POST['url'];

    $articleRepository = new ArticleRepository('articles.json');
    $article = $articleRepository->getArticleById($articleId);

    if ($article) {
        // Update the article with the new title and URL
        $article->setTitle($newTitle);
        $article->setUrl($newUrl);
        $articleRepository->updateArticle($articleId, $article);

        // Redirect back to the article list
        header('Location: index.php');
        exit();
    }
} elseif (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    $articleRepository = new ArticleRepository('articles.json');
    $article = $articleRepository->getArticleById($articleId);

    if ($article) {
        $title = $article->getTitle();
        $url = $article->getUrl();
    }

}

// Display the edit form
?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body>
    <?php require_once 'layout/navigation.php' ?>

    <div class="container mt-5">
        <h2 class="text-center font-semibold text-indigo-700 mt-10">Edit Article</h2>
        <form method="POST">
            <div class="form-group">
                <input id="edit-title" name="title" type="text" class="form-control" placeholder="Edit title" value="<?= $title; ?>" required>
            </div>
            <div class="form-group">
                <input id="edit-url" name="url" type="text" class="form-control" placeholder="Edit URL" value="<?= $url; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <input type="hidden" name="id" value="<?= $articleId; ?>">
        </form>
    </div>
</body>
</html>
