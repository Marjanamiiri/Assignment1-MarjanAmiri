<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $url = $_POST['url'];
    // Create a new Article instance
    $newArticle = new Article(time(), $title, $url);
    // Create an instance of ArticleRepository
    $articleRepository = new ArticleRepository('articles.json');
    // Save the new article
    $articleRepository->saveArticle($newArticle);
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body>
    <?php require_once 'layout/navigation.php' ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">New Article</h2>
                <form method="POST">
                    <div class="form-group">
                        <input id="add-title" name="title" type="text" class="form-control" placeholder="Add Title" required>
                    </div>
                    <div class="form-group">
                        <input id="add-url" name="url" type="text" class="form-control" placeholder="Add URL" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-secondary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
