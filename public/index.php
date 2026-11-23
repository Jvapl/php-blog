<?php
require_once __DIR__ . '/../src/database/Database.php';
include '../src/constants.php';

$pdo = Database::connect();

$errors = [];

try {
    $pdo = Database::connect();
    $stmt = $pdo->query('SELECT posts. *, users.name AS author FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC');
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log($e->getMessage());
    $errors[] = ERROR_MSG_GET_DATA;
    $posts = [];
}

$imageClasses = ['first-image', 'second-image', 'third-image'];

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
        <h1><a href="index.php">PHP Blog</a></h1>
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
            <?php foreach ($posts as $index => $post): ?>
                <?php
                $contentCharLess = mb_substr($post['content'], 0, 180);
                $hasMore = mb_strlen($post['content']) > 180;

                $imageClass = $imageClasses[$index % 3];
                ?>

                <article class="post-card">
                    <div class="post-image <?= $imageClass ?>">

                        <?php if (!empty($post['image'])): ?>
                            <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                        <?php else : ?>
                            <?= $index + 1 ?>
                        <?php endif; ?>

                    </div>

                    <p class="article-info">
                        <?= htmlspecialchars($post['created_at']) ?> -
                        <?= htmlspecialchars($post['author']) ?> .
                    </p>

                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p>
                        <?= nl2br(htmlspecialchars($contentCharLess)); ?>
                        <?= $hasMore ? '...' : '' ?>
                    </p>
                    <a href="editionPage.php?id=<?= urlencode($post['id']); ?>">Edit post →
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
    <?php
    include 'components/footer.php';
echo $footerHTML
?>
</body>

</html>