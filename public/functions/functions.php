<?php

class functions
{
    public function postInfo(array $data): array
    {
        $title = trim((string) ($data['title'] ?? ''));
        $content = trim((string) ($data['content'] ?? ''));
        $errors = [];

        if ($title === '') {
            $errors[] = ERROR_MSG_TITLE;
        }

        if ($content === '') {
            $errors[] = ERROR_MSG_CONTENT;
        }
        return [
            'title' => $title,
            'content' => $content,
            'errors' => $errors
        ];
    }

    public function fileAdder(?array $file): array
    {
        $errors = [];
        $imagePath = null;

        if ($file === null || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return [
                'image' => null,
                'errors' => [],
            ];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = ERROR_MSG_UPLOAD;
        } elseif ($file['size'] > 200 * 1024 * 1024) {
            $errors[] = ERROR_MSG_IMG;
        } else {
            $uploadDir = __DIR__ . '/../uploads/';
            $mediaType = mime_content_type($file['tmp_name']);
            // send file data type exemple (image/jpeg)
            // Detect the file's MIME type using its temporary path.

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
            ];

            if (!isset($allowedTypes[$mediaType])) {
                $errors[] = ERROR_MSG_IMG_TYPE;
            } elseif (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
                // Create the upload directory if it doesn't exist

                $errors[] = ERROR_MSG_UPLOAD_DIR;
            } else {
                $fileName = bin2hex(random_bytes(16)) . '.' . $allowedTypes[$mediaType];
                // Generate a random filename: 16 random bytes converted to hexadecimal

                $destination = $uploadDir . $fileName;

                if (!move_uploaded_file($file['tmp_name'], $destination)) {
                    $errors[] = ERROR_MSG_UPLOAD_IMG;
                } else {
                    $imagePath = 'uploads/' . $fileName;
                }
            }
        }

        return [
            'image' => $imagePath,
            'errors' => $errors,
        ];
    }

    public function editId(int $postId): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT id, title, image, content FROM posts WHERE id = ?');
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post === false ? null : $post;
    }
}
