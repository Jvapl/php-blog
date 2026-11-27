<?php

class Services
{
    public function postInfo(array $data): array
    {
        $title = trim((string) ($data['title'] ?? ''));
        $content = trim((string) ($data['content'] ?? ''));
        $errors = [];

        if ($title === '' | mb_strlen($title) >= 60) {
            $errors[] = ERROR_MSG_TITLE;
        }

        if ($content === '' | mb_strlen($content) >= 1000) {
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
        if ($file === null || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return [
                'image' => null,
                'errors' => [],
            ];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['image' => null, 'errors' => [ERROR_MSG_UPLOAD]];
        }

        if ($file['size'] > 200 * 1024 * 1024) {
            return ['image' => null, 'errors' => [ERROR_MSG_IMG]];
        }

        $uploadDir = __DIR__ . '/../uploads/';
        $mediaType = mime_content_type($file['tmp_name']);
        // Detect the file's MIME type using its temporary path.

        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
        ];

        if (!isset($allowedTypes[$mediaType])) {
            return ['image' => null, 'errors' => [ERROR_MSG_IMG_TYPE]];
        }

        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            return ['image' => null, 'errors' => [ERROR_MSG_UPLOAD_DIR]];
        }

        $fileName = bin2hex(random_bytes(16)) . '.' . $allowedTypes[$mediaType];
        // Generate a random filename: 16 random bytes converted to hexadecimal

        $destination = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return ['image' => null, 'errors' => [ERROR_MSG_UPLOAD_IMG]];
        }

        return ['image' => 'uploads/' . $fileName, 'errors' => []];
    }

    public function editId(int $postId): array | null
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT id, title, image, content FROM posts WHERE id = ?');
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post === false ? null : $post;
    }

    public function removeFile(string $imagePath): bool
    {
        $filePath = __DIR__ . '/../' . $imagePath;
        return is_file($filePath) && unlink($filePath);
    }
}
