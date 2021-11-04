<?php

require 'config.php';

$id = $title = $content = '';
$status = true;
$responseMessage = 'Notetap updated successfully';

// validate data, trim and filter
if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
    $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $content = trim(filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING));
} else {
    $status = false;
    $responseMessage = "An error occurred, please try again!";
    json_response($status, $responseMessage);
    exit;
}

// date not empty
if (empty($id) || empty($title) || empty($content)) {
    $status = false;
    $responseMessage = "Make sure both Title and Content fields are not empty";
    json_response($status, $responseMessage);
    exit;
} else {
    // edit tap
    $db->Update("UPDATE tabs 
    SET title = :title, content = :content 
    WHERE id = :id",[
        'id' => $id,
        'title' => $title,
        'content' => $content
    ]);

    // return tap content
    $responseTap = $db->Select("SELECT title, content FROM tabs WHERE id = :id", [
        'id' => $id
    ]);

    $title = $responseTap[0]['title'];
    $content = $responseTap[0]['content'];
    json_response($status, $responseMessage, $title, $content);
}

// response text

function json_response($status, $responseMessage, $title = null, $content = null) {
echo json_encode(
    array(
        'status' => $status,
        'message' => $responseMessage,
        'title' => $title,
        'content' => $content,
    )
);}