<?php

require 'config.php';

$tapID;

if (isset($_GET['trash'])) {
    $tapID = filter_var($_GET['trash'], FILTER_SANITIZE_NUMBER_INT);

    $db->Remove("Delete from tabs where id = :id",[
        'id' => $tapID
    ]);

    header('Location: index.php?delete=deleted');
} else {
    header('Location: index.php?delete=failed');
}

