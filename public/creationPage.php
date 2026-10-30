<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a post - PHP Blog</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <nav class="nav-bar">
        <h1>PHP Blog</h1>
        <div class="nav-components">
            <a class="navButtonClass" href="index.php">Home</a>
            <a class="navButtonClass" href="loginPage.php">Log in</a>
            <a class="ButtonClass" href="creationPage.php">Write a post</a>
        </div>
    </nav>

    <main class="page-content">
        <a href="index.php">← Back to home</a>
        <h2>Create a post</h2>
        <p class="page-description">Write down your idea and share it with readers.</p>

        <form class="form-box">
            <label for="title">Title</label>
            <input id="title" type="text" placeholder="Post title">

            <label for="image">Image (optional)</label>
            <input id="image" type="text" placeholder="Image address">

            <label for="content">Content</label>
            <textarea id="content" placeholder="Write your post here..."></textarea>

            <a class="ButtonClass" href="detailPage.php">Publish post</a>
        </form>
    </main>

    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>
</html>
