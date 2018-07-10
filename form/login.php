<?php
include '../classes.php';

if (isset($_POST['email']) && isset($_POST['pw'])) {
		
	$email = $_POST['email'];
	$password = $_POST['pw'];
	
	$connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
	
	$data = mysqli_query($connection, "SELECT * FROM `user` WHERE `email` = '{$email}' AND `password` = '{$password}'");
	$row_cnt = mysqli_num_rows($data);
	if ($row_cnt == 1) {
		$row = mysqli_fetch_array($data);
		$id = $row['ID'];
        $session = Session::getInstance();
        $session->email=$email;
        $session->userid=$id;
        $session->privileges=$row['privileges'];
		echo "success";
	} else { echo "failed"; }
}

?>