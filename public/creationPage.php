<?php
require_once __DIR__ . '/../src/database/Database.php';
include '../src/constants.php';
$errors = [];

$userId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim((string) filter_input(INPUT_POST, 'title', FILTER_UNSAFE_RAW));
    $content = trim((string) filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW));
    $imageUp = null;
    
    if ($title === ''){
        $errors[] = ERROR_MSG_TITLE;
    }
 
    if ($content === ''){
        $errors[] = ERROR_MSG_CONTENT;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE){
        $file = $_FILES['image'];

        if ($file['error'] !== UPLOAD_ERR_OK){
            $errors[] = ERROR_MSG_UPLOAD;
        } elseif ($file['size'] > 200 * 1024 * 1024) {
            $errors[] = ERROR_MSG_IMG;
        } else {
            $uploadDir = __DIR__ . '/uploads/';
            $mediaType = mime_content_type($file['tmp_name']);
            // send file data type exemple (image/jpeg)
            // Detect the file's MIME type using its temporary path.

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif'
            ];

            if (!isset($allowedTypes[$mediaType])){
                $errors[] = ERROR_MSG_IMG_TYPE;
            } else {
                if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)){
                    // Create the upload directory if it doesn't exist

                    $errors[] = ERROR_MSG_UPLOAD_DIR;
                } else {
                    $fileName = bin2hex(random_bytes(16)) . '.' . $allowedTypes[$mediaType];
                    // Generate a random filename: 16 random bytes converted to hexadecimal

                    $destination = $uploadDir . $fileName;

                    if (!move_uploaded_file($file['tmp_name'], $destination)){
                        $errors[] = ERROR_MSG_UPLOAD_IMG;
                    } else {
                        $imageUp = 'uploads/' . $fileName;
                    }
                }
            }
        }
    }

    if (empty($errors)){
        $createdAt = new DateTime('now', new DateTimeZone('UTC'));
        $dateCreated = $createdAt->format('Y-m-d H:i:s');

        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare('INSERT INTO posts (user_id, title, image, content, created_at) VALUES (:user_id ,:title, :image, :content, :created_at)');

            $stmt->execute([
                ':user_id' => $userId,
                ':title' => $title,
                ':image' => $imageUp,
                ':content' => $content,
                ':created_at' => $dateCreated,
            ]);

            header('Location: /detailPage.php');
            exit;
        } catch (Exception $e){
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

        <form class="form-box" method="POST" action="creationPage.php" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" placeholder="Post title" required>

            <label for="image">Image (optional)</label>
            <input id="image" name="image" type="file" accept="image/*">

            <label for="content">Content</label>
            <textarea id="content" name="content" placeholder="Write your post here..." required></textarea>

            <button class="ButtonClass" type="submit">Publish post</button>
        </form> 
    </main>

    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>
</html>
