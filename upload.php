<?php
if (!empty($_FILES['attachment'])) {
    $file = $_FILES['attachment'];

// собираем путь до нового файла - папка uploads в текущей директории
// в качестве имени оставляем исходное файла имя во время загрузки в браузере
    $srcFileName = $file['name'];
    $newFilePath = __DIR__ . '/uploads/' . $srcFileName;

    if (file_exists($newFilePath)) {
        $error = 'Файл с таким именем уже существует';
    }elseif (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
        $error = 'Ошибка при загрузке файла';
    } else {
        $result = 'http://myproject.loc/uploads/' . $srcFileName;
    }
}
?>
<html>
<head>
    <title>Загрузка файла</title>
</head>
<body>
<?php if (!empty($error)): ?>
    <?= $error ?>
<?php elseif (!empty($result)): ?>
    <?= $result ?>
<?php endif; ?>
<br>
<form action="/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="attachment">
    <input type="submit">
</form>
</body>
</html>
