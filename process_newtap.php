<?php

require 'config.php';

$title = $content = '';
$error = "Make sure both Title and Content fields are not empty";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $content = trim(filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING));
}

if (empty($title) || empty($content)) {
    header('Location: index.php?results=failed');
} else {
    $db->Insert("Insert into `tabs`( `title` , `content`) values ( :title , :content )", [
        'title' => $title,
        'content' => $content,
    ]);
    header('Location: index.php?results=published');
}



