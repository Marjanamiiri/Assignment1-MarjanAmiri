# COMP 3015 News

An article aggregrator. 

## Running the application

Ensure an `articles.json` file is at the server root.

Run:

```
php -S localhost:9000 # or you could use a different port
```

Install Node (dev) dependencies:

```
npm i
```

Run the Node server for reloading CSS changes:

```
npm run dev
```

You can also run this using Apache or Nginx.

## Introduction

This is an article aggregrator system web application that allows you to create, edit, update, and delete articles. The application consists of several PHP files, stylesheets, and templates.

## Project Structure

- `index.php`: The main page that displays a list of articles.
- `new_article.php`: Allows you to create a new article.
- `update_article.php`: Allows you to edit and update an existing article.
- `delete_article.php`: Enables you to delete an article.
- `article.php`: Contains the Article model class.
- `articleRepository.php`: Contains the ArticleRepository class for managing articles.
- `header.php`: Header template for the application.
- `navigation.php`: Navigation template for the application.
- `style.css`: The stylesheet for styling the application.

## Prerequisites

- PHP (at least version 7.0)
- Web server (e.g., Apache, Nginx)
- Web browser

## Installation and Setup


1. Clone the repository to your local machine:

    ```shell
    git clone https://github.com/Marjanamiiri/Assignment1-MarjanAmiri.git
    ```

2. Configure your web server to serve the application. You can use XAMPP, WAMP, or configure the server manually.

3. Ensure the `data/articles.json` file exists and is writable by the web server. Create an initial JSON file with an empty array `[]`.

## Usage

- To create a new article, visit `new_article.php` on the top right of page or click on +, and fill in the title and URL.
- To edit an existing article, visit `update_article.php`, click on edit button on right side of each article, make changes, and click "Update."
- To delete an article, visit `delete_article.php`, click on trash can button on right side of each article, and confirm the deletion.
- Use `index.php` to view the list of articles.
