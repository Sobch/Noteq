<?php


if (isset($_POST['subject'])) {
    include '../classes.php';
    $session = Session::getInstance();
    $userid = $session->userid;
    $connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
	$data = mysqli_query($connection, "INSERT INTO `note`(`userID`, `subject`, `content`, `insertTime`, `editTime`) VALUES ( ".$userid.", '".$_POST['subject']."', '".$_POST['content']."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    if ($data) { echo "success"; } else { echo "failed"; }
    
} else echo "failed";

?>