<?php
require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';

$errors = [];
$validUrl = true; // Assume the URL is initially valid

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $articleId = (int)$_POST['id'];
    $newTitle = $_POST['title'];
    $newUrl = $_POST['url'];

    $articleRepository = new ArticleRepository('articles.json');
    $article = $articleRepository->getArticleById($articleId);

    if ($article) {
        // Validate the new URL format
        if (!preg_match('/^https?:\/\/[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/', $newUrl)) {
            $errors['url'] = 'Invalid URL format. Please enter a valid URL.';
            $validUrl = false;
        }

        // Check if the URL is valid before updating the article
        if ($validUrl) {
            // Update the article with the new title and URL
            $article->setTitle($newTitle);
            $article->setUrl($newUrl);
            $articleRepository->updateArticle($articleId, $article);

            // Redirect back to the article list
            header('Location: index.php');
            exit();
        }
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
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body>
    <?php require_once 'layout/navigation.php' ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Edit Article</h2>
                <?php if (isset($errors['url'])) : ?>
                    <div class="error-message"><?php echo $errors['url']; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $articleId; ?>">
                    <div class="form-group">
                        <input id="edit-title" name="title" type="text" class="form-control" placeholder="Edit Title" value="<?php echo isset($title) ? $title : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <input id="edit-url" name="url" type="text" class="form-control" placeholder="Edit URL" value="<?php echo isset($url) ? $url : ''; ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-secondary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
