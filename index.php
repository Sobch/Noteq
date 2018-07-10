<?php
    include "classes.php";
    $session = Session::getInstance();
    $uri = $_SERVER["REQUEST_URI"];
    switch ($uri) {
        case "/sobczak.cc/noteq/":
            if (!$session->email) 
                include "view/login.php";
            else 
                header('Location: /sobczak.cc/noteq/board');
            break;
        case "/sobczak.cc/noteq/board":
            if ($session->email) {
                include "view/board.php";        
            }
            else {
                header('Location: /sobczak.cc/noteq/');
            }
            break;
        case "/sobczak.cc/noteq/admin":
            if ($session->email && $session->privileges) {
                include "view/admin.php";
            } else {
                header('Location: /sobczak.cc/noteq/');
            }
            break;
            
            
        default:
            include "view/404.php";
            header("HTTP/1.0 404 Not Found");
            break;
    }

?>
