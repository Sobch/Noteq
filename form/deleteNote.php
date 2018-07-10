<?php


if (isset($_POST['id'])) {
    include '../classes.php';
    $session = Session::getInstance();
    $userid = $session->userid;
	$connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
	$data = mysqli_query($connection, "DELETE FROM `note` WHERE id=".$_POST['id']." AND userID=".$session->userid);
	if ($data) { echo "success"; } else { echo "failed"; }
    
} else echo "failed";

?>