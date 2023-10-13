<?php
require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';

$articleRepository = new ArticleRepository('articles.json');
$articles = $articleRepository->getAllArticles();

?>

<!doctype html>
<html lang="en">

<?php require_once 'layout/header.php' ?>

<body>

    <?php require_once 'layout/navigation.php' ?>

    <h2 class="text-center font-semibold text-indigo-700 mt-10">Articles</h2>
    <div class="article_list_box">
    <?php foreach ($articles as $article) : ?>
                    <div class="articles">
                    <a href='<?= $article->getUrl(); ?>'>
                        <div class="articles_list">
                            <?= $article->getTitle(); ?>
                            <div class="article-icons">
                                <a href="update_article.php?id=<?= $article->getId(); ?>" class="article-icon">
                                    <!-- <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> -->
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <a href="delete_article.php?id=<?= $article->getId(); ?>" class="article-icon">
                                    <!-- <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> -->
                                    <span class="material-symbols-outlined">delete_forever</span>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>

                <div class="add">
                    <a href="new_article.php">
                        <span class="material-symbols-outlined">add</span>
                    </a>
                </div>
                


    </div>
            </body>

</html>