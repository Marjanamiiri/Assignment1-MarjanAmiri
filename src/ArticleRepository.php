<?php

class ArticleRepository
{

	private string $filename;

	public function __construct(string $theFilename)
	{
		$this->filename = $theFilename;
	}

	/**
	 * @return Article[]
	 */
	public function getAllArticles(): array
	{
		if (!file_exists($this->filename)) {
			return [];
		}
		$fileContents = file_get_contents($this->filename);
		if (!$fileContents) {
			return [];
		}
		$decodedArticles = json_decode($fileContents, true);
		if (json_last_error() !== JSON_ERROR_NONE) {
			return [];
		}
		$articles = [];
		foreach ($decodedArticles as $decodedArticle) {
			$articleId = time();
			$articles[] = (new Article($articleId))->fill($decodedArticle);
		}
		return $articles;
	}

	/**
	 *
	 */
	public function getArticleById(int $id): Article|null
	{
		$articles = $this->getAllArticles();
		foreach ($articles as $article) {
			if ($article->getId() === $id) {
				return $article;
			}
		}
		return null;
	}

	/**
	 * @param int $id
	 */
	public function deleteArticleById(int $id): void
	{
		$article = $this->getAllArticles();
		for ($i = 0; $i < count($article); $i++) {
			if ($article[$i]->getId() === $id) {
				unset($article[$i]);
			}
		}
		// Re-index the array to remove any gaps
		$article = array_values($article);
		file_put_contents($this->filename, json_encode($article, JSON_PRETTY_PRINT));
	
	}

	/**
	 * @param Article $article
	 */
	public function saveArticle(Article $article): void
	{
		// Get the existing articles
		$articles = $this->getAllArticles();

		// Generate a unique ID for the new article (e.g., using time())
		$articleId = time();
	
		// Fill the article with the ID
		$article->setId($articleId);
	
		// Add the new article to the existing articles array
		$articles[] = $article;
	
		// Save the updated articles back to the JSON file
		file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT));
		if (file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT)) === false) {
			echo 'Error writing to the file.';
		}
	}

	/**
	 * @param int $id
	 * @param Article $updatedArticle
	 */
	public function updateArticle(int $id, Article $updatedArticle): void
	{
		$article = $this->getAllArticles();
		for ($i = 0; $i < count($article); $i++) {
			if ($article[$i]->getId() === $id) {
				$article[$i] = $updatedArticle; // Update the book object
			}
		}
		file_put_contents($this->filename, json_encode($article, JSON_PRETTY_PRINT));
	
	}
}
