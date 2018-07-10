    <?php 
		  include '../classes.php';
        $connection = mysqli_connect(Connection::HOST, Connection::USER, Connection::PASSWORD, Connection::DATABASE);
        mysqli_set_charset($connection, 'utf-8');
        $session = Session::getInstance();
        $userid=$session->userid;
        $data = mysqli_query($connection, "SELECT `id`, SUBSTRING(`subject`, 1, 50), SUBSTRING(`content`, 1, 120), DATEDIFF(NOW(), insertTime), DATEDIFF(NOW(), editTime), LENGTH(`subject`), LENGTH(`content`) FROM `note` WHERE userID='{$userid}' ORDER BY insertTime DESC");
        if (!$data) { echo "failed"; return; }
        $row_cnt = mysqli_num_rows($data);
    
        
        while($row = mysqli_fetch_row ($data)){
            echo '<tr name="post-'.$row[0].'" class="post">';
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
            
                if ($row[3]==0) echo '<td class="green">dzisiaj</td>';
                else if ($row[3]==1) echo '<td class="green">wczoraj</td>';
                else if ($row[3]>1) echo '<td class="blue">'.$row[3].' dni temu</td>';
            
                if ($row[4]==0) echo '<td class="green">dzisiaj</td>';
                else if ($row[4]==1) echo '<td class="green">wczoraj</td>';
                else if ($row[4]>1) echo '<td class="blue">'.$row[3].' dni temu</td>';
        }
        
        
      ?>


