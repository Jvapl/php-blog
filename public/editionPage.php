<?php
require_once __DIR__ . '/../src/database/Database.php';
require_once __DIR__ . '/../public/functions/functions.php';
include '../src/constants.php';

$helpers = new functions();
$errors = [];
$postId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$post = null;

if ($postId === false || $postId === null) {
    $errors[] = ERROR_MSG_GET_ID;
} else {
    try {
        $post = $helpers->editId($postId);

        if ($post === null) {
            $errors[] = "";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        $errors[] = ERROR_MSG_GET_DATA;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $post !== null) {
    $formData = $helpers->postInfo($_POST);
    $errors = array_merge($errors, $formData['errors']);
    $imageUp = $post['image'];


    if (empty($errors)) {
        $hasUpload = $helpers->fileAdder($_FILES['image'] ?? null);
        $errors = array_merge($errors, $hasUpload['errors']);

        if ($hasUpload['image'] !== null) {
            $imageUp = $hasUpload['image'];
        }
    }

    if (empty($errors)) {

        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare('UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id');

            $stmt->execute([
                ':title' => $formData['title'],
                ':image' => $imageUp,
                ':content' => $formData['content'],
                ':id' => $postId
            ]);

            if (!empty($post['image'])) {
                $helpers->removeFile($post['image']);
            }

            header('Location: /index.php');
            exit;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $errors[] = ERROR_MSG_SAVING_POST;
        }
    }
}



?>
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
        <h1><a href="index.php">PHP Blog</a></h1>
        <div class="nav-components">
            <a class="navButtonClass" href="index.php">Home</a>
            <a class="navButtonClass" href="detailPage.php">My post</a>
            <a class="ButtonClass" href="creationPage.php">Write a post</a>
        </div>
    </nav>

    <main class="page-content">
        <a href="index.php">← Back to the post</a>
        <h2>Edit a post</h2>
        <p class="page-description">Example: you can edit the title and content of your post.</p>

        <form class="form-box" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" value="<?= htmlspecialchars($post['title']) ?>">

            <label for="image">Image (optional)</label>
            <input id="image" name="image" type="file" placeholder="Image address">

            <label for="content">Content</label>
            <textarea id="content" name="content"><?= htmlspecialchars($post['content']) ?></textarea>

            <button class="ButtonClass" type="submit" href="index.php">Save changes</button>
        </form>
    </main>

    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>

</html>