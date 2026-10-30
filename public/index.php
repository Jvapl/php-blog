<?php
require_once __DIR__ . '/../src/database/Database.php';

$pdo = Database::connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Blog - Home</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <nav class="nav-bar">
        <h1>PHP Blog</h1>
        <div class="nav-components">
            <a class="navButtonClass" href="index.php">Home</a>
            <a class="navButtonClass" href="loginPage.php">Log in</a>
            <a class="ButtonClass" href="registerPage.php">Create account</a>
        </div>
    </nav>

    <div class="HomePageDescription pagePadding">
        <span>
            <h2>Welcome to PHP Blog</h2>
            <p class="secondary-text">Ideas to read<br>and share.</p>
        </span>
        <a href="creationPage.php" class="ButtonClass">Write a post</a>
    </div>

    <main class="home-content">
        <h2>Latest posts</h2>
        <p class="secondary-text">Discover ideas shared by our community.</p>

        <div class="post-list">
            <article class="post-card">
                <div class="post-image">01</div>
                <p class="article-info">12/06/2026 · Mariana Costa</p>
                <h3>The beauty of starting slowly</h3>
                <p>Not everything has to happen at once. Sometimes, taking the first step is enough.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image second-image">02</div>
                <p class="article-info">10/06/2026 · Lucas Martin</p>
                <h3>Small moments in everyday life</h3>
                <p>A walk, a coffee, or a conversation can give us new ideas.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image third-image">03</div>
                <p class="article-info">08/06/2026 · Emma Bernard</p>
                <h3>Taking time to listen</h3>
                <p>Listening helps us discover new stories and different points of view.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image">01</div>
                <p class="article-info">12/06/2026 · Mariana Costa</p>
                <h3>The beauty of starting slowly</h3>
                <p>Not everything has to happen at once. Sometimes, taking the first step is enough.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image second-image">02</div>
                <p class="article-info">10/06/2026 · Lucas Martin</p>
                <h3>Small moments in everyday life</h3>
                <p>A walk, a coffee, or a conversation can give us new ideas.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image third-image">03</div>
                <p class="article-info">08/06/2026 · Emma Bernard</p>
                <h3>Taking time to listen</h3>
                <p>Listening helps us discover new stories and different points of view.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image">01</div>
                <p class="article-info">12/06/2026 · Mariana Costa</p>
                <h3>The beauty of starting slowly</h3>
                <p>Not everything has to happen at once. Sometimes, taking the first step is enough.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image second-image">02</div>
                <p class="article-info">10/06/2026 · Lucas Martin</p>
                <h3>Small moments in everyday life</h3>
                <p>A walk, a coffee, or a conversation can give us new ideas.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image third-image">03</div>
                <p class="article-info">08/06/2026 · Emma Bernard</p>
                <h3>Taking time to listen</h3>
                <p>Listening helps us discover new stories and different points of view.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image">01</div>
                <p class="article-info">12/06/2026 · Mariana Costa</p>
                <h3>The beauty of starting slowly</h3>
                <p>Not everything has to happen at once. Sometimes, taking the first step is enough.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image second-image">02</div>
                <p class="article-info">10/06/2026 · Lucas Martin</p>
                <h3>Small moments in everyday life</h3>
                <p>A walk, a coffee, or a conversation can give us new ideas.</p>
                <a href="detailPage.php">Read post →</a>
            </article>

            <article class="post-card">
                <div class="post-image third-image">03</div>
                <p class="article-info">08/06/2026 · Emma Bernard</p>
                <h3>Taking time to listen</h3>
                <p>Listening helps us discover new stories and different points of view.</p>
                <a href="detailPage.php">Read post →</a>
            </article>
        </div>
    </main>
    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>
</html>
