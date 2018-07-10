<?php
include '../classes.php';

if (isset($_POST['email']) && isset($_POST['pw']) && isset($_POST['pwr'])) {
		
	$email = $_POST['email'];
	$password = $_POST['pw'];
    $passwordRepeat = $_POST['pwr'];
    
    if ($password != $passwordRepeat) { echo "failed"; exit(); }
	
	$connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
    
    $data = mysqli_query($connection, "SELECT `ID` FROM `user` WHERE `email` = '{$email}'");
	$row_cnt = mysqli_num_rows($data);
	if ($row_cnt >= 1) {
		echo "exist";
        exit();
	} else { 
        $data = mysqli_query($connection, "INSERT INTO `user`(`password`, `email`, `privileges`, `joinTime`) VALUES ('{$password}','{$email}',0,NOW())");
	   if ($data) echo "success"; else echo "failed"; 
    }
}

?>