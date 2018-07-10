<?php


if (isset($_POST['id']) && isset($_POST['subject']) && isset($_POST['content'])) {
    include '../classes.php';
    $session = Session::getInstance();
    $userid = $session->userid;
	$connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
	$data = mysqli_query($connection, "UPDATE note SET subject='".$_POST['subject']."', content='".$_POST['content']."', editTime=CURRENT_TIMESTAMP WHERE ID=".$_POST['id']." AND userID=".$session->userid);
	if ($data) { echo "success"; } else { echo "failed"; }
    
} else echo "failed";

?>