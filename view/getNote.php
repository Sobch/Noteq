<?php 
	 include '../classes.php';
    $connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
    mysqli_set_charset($connection, 'utf-8');
    $session = Session::getInstance();
    $userid = $session->userid;
    $id = $_POST["id"];
    $data = mysqli_query($connection, "SELECT `id`, `subject`, `content`, `insertTime`, `editTime` FROM `note` WHERE ID='{$id}' AND userID='{$userid}'");
    $row_cnt = mysqli_num_rows($data);
    if ($row_cnt < 1) {
        echo ("failed");
    } else { 
        $row = mysqli_fetch_row ($data);
        echo "<tr class='editPost existingPost' style='display:none'><td colspan='4'>";
        echo '<div style="display:none">';
        echo '<form method="post" name="edit-'.$row[0].'">';
            echo '<h1>Tytuł notatki:</h1>';
            echo '<input type="text" name="subject" placeholder="Wprowadź tytuł notatki" required="required" value="'.$row[1].'"/>';
            echo '<h1>Treść notatki:</h1>';
            echo '<textarea name="content" placeholder="Wprowadź treść notatki" >'.$row[2].'</textarea>';  
            echo '<p style="margin-top:20px;">Dodano: '.$row[3].'</p>';
            echo '<p style="padding-bottom:30px;">Edytowano: '.$row[4].'</p>';
            echo '<div style="width:100%;">';
                echo '<button type="submit" class="submitPost">Zapisz notatkę</button>';
                echo '<button type="submit" class="deletePost">Usuń!</button>';
            echo '</div>';
        echo '</form>';
        echo '</div>';
        echo "</td></tr>";
    }
  ?>
