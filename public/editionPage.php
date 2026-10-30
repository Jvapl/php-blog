<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a post - PHP Blog</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <nav class="nav-bar">
        <h1>PHP Blog</h1>
        <div class="nav-components">
            <a class="navButtonClass" href="index.php">Home</a>
            <a class="navButtonClass" href="detailPage.php">My post</a>
            <a class="ButtonClass" href="creationPage.php">Write a post</a>
        </div>
    </nav>

    <main class="page-content">
        <a href="detailPage.php">← Back to the post</a>
        <h2>Edit a post</h2>
        <p class="page-description">Example: you can edit the title and content of your post.</p>

        <form class="form-box">
            <label for="title">Title</label>
            <input id="title" type="text" value="The beauty of starting slowly">

            <label for="image">Image (optional)</label>
            <input id="image" type="text" placeholder="Image address">

            <label for="content">Content</label>
            <textarea id="content">Not everything has to happen at once. There is a quiet beauty in taking the first step and letting ideas find their rhythm.

Starting slowly is still starting.</textarea>

            <a class="ButtonClass" href="detailPage.php">Save changes</a>
        </form>
    </main>

    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>
</html>
