<?php
    require('./connect.php'); //連接資料庫

    if(isset($_COOKIE['cookie'])){
        $username = $_COOKIE['cookie'];
        echo $username;
        $content = $_POST['content'];
        echo $content;
        $timestamp = date('m-d H:i:s', strtotime('+8 hours'));  
        echo  $timestamp; 
        $parent = $_POST['parent'];
        echo  $parent;    
    }


/*
    if($parent == 0){
        $table = 'yuchun_board';
    }
    else{
        $table = 'yuchun_board' . $parent;
        echo $table . '<br>';
    }

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $table . '(
            ID int NOT NULL AUTO_INCREMENT,
            user varchar(30),
            content varchar(255),
            timestamp varchar(30),
            parent int,
            PRIMARY KEY (ID))';
    echo $sql;

    
    if($conn->query($sql)===TRUE){
        //echo 'Table ' . $table . ' created successfully' . '<br>';
    } else {
        echo 'error creating table: ' . $conn->error . '<br>';
    }
*/
    if(!empty($_COOKIE['vertify'])){
        echo 'ccc'.$_COOKIE['vertify'];
        $table = 'yuchun_board';
        $sql = "INSERT INTO $table (user, content, timestamp, parent) VALUES ('{$username}','{$content}','{$timestamp}',{$parent})";
        //$sql = "INSERT INTO "
        
        
        if($conn->query($sql)===TRUE){
            echo 'New record created successfully' . '<br>';
            $last_id = $conn->insert_id;
            echo $last_id;
            $lastID = array("ID"=>$last_id);
            echo $lastID["ID"];
            $fp = fopen('lastID.json','w');
            fwrite($fp,json_encode($lastID));
            fclose($fp);

        } else {
            echo $sql . '<br>';
            echo 'error creating record: ' . $conn->error . '<br>';
        }
        $url = './memberBoard.php';
        header("Location: " . $url);   
    }else{
?>
    <script>
        confirm('登入才可以留言ㄛ');
        location.href='./index.html'
    </script>
<?php
    }
    
   

?>