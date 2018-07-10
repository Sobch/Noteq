<?php
    include '../classes.php';
    $session = Session::getInstance();
    $session->destroy();
    if (!$session->email) echo "success";
        else echo "failed";
?>