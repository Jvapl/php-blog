<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post details - PHP Blog</title>
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

        <article class="article-box">
            <div class="article-cover">PHP Blog</div>
            <p class="article-info">Published on 12/06/2025 by Mariana Costa</p>
            <h2>The beauty of starting slowly</h2>
            <div class="article-text">
                <p>Not everything has to happen at once. There is a quiet beauty in taking the first step, watching the path, and letting ideas find their rhythm.</p>
                <p>We are often encouraged to move quickly. Taking your time can help you see what really matters.</p>
                <p>Starting slowly is still starting. This is how good ideas take shape.</p>
            </div>
            <a class="ButtonClass" href="editionPage.php">Edit this post</a>
        </article>
    </main>

    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>
</html>
