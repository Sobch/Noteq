<!DOCTYPE html>
<html lang="pl-PL" >
    
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>Noteq admin</title>
	<link rel="Stylesheet" type="text/css" href="css/admin.css" />
</head>

<body>

    <h1>Lista użytkowników</h1>
    
    <?php
        $connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
        if (!$connection) {
            echo "Błąd łączenia z bazą danych";
            exit();
        }
        mysqli_set_charset($connection, 'utf-8');
        $session = Session::getInstance();
        $userid = $session->userid;
        if (!$userid) exit();
        $data = mysqli_query($connection, "SELECT id, email, privileges, DATE_FORMAT(jointime,'%Y-%m-%d') as date FROM `user` ORDER BY jointime desc");
        if (!$data) {
            echo "Błąd pobierania danych";
            exit();
        }
        $row_cnt = mysqli_num_rows($data);
        if ($row_cnt < 1) {
            echo ("failed");
        } else {
            echo "<ul>";
            while ($row = mysqli_fetch_row ($data)) {
                echo '<li>';
                echo $row[1].', od '.$row[3];
                if ($row[2]) echo '<span class="admin">ADMIN</span>';
                if ($row[0]!=1 && $row[0]!=$userid) echo '<span class="delete" name='.$row[0].'>usuń użytkownika</span>';
                echo '</li>';
            }
            echo "</ul>";

        }
    ?>

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    
</body>
</html>