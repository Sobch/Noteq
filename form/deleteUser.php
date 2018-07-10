<?php

if (isset($_POST['id'])) {
	$connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
	$data = mysqli_query($connection, "DELETE FROM `user` WHERE id=".$_POST['id']);
	if ($data) { echo "success"; } else { echo "failed"; }
} else echo "failed";

?>