<html>
	<head>
		<title>mission_4</title>
		<meta charset=mb_internal_encoding("utf-8")>
	</head>
<?php
	$dsn='mysql:dbname=tt_753_99sv_coco_com;host=localhost';  //3-1↓ データベース作成
	$user='tt-753.99sv-coco';
	$password='s6RLJenv';
	$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)); //3-1〆

	$sql = "CREATE TABLE IF NOT EXISTS mission_4"
	." ("
	."number INT,"
	."name char(32),"
	."comment TEXT,"
	."password TEXT,"
	."date TEXT"
	.");";
	$stmt = $pdo->query($sql);

if($_POST["name"] != NULL && $_POST["comment"] != NULL && $_POST["hidden"] == NULL && $_POST["password"] != NULL){  //入力↓
	$number = 1;
	$name = $_POST["name"];
	$comment = $_POST["comment"];
	$password = $_POST["password"];
	$date = date("Y m d H:i", time()); 

	$sql = 'SELECT * FROM mission_4';
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll();
		foreach($result as $row){
			++$number;
		}
 			$sql = $pdo->prepare("INSERT INTO mission_4(number,name,comment,password,date) VALUES (:number,:name,:comment,:password ,:date)");
			$sql->bindParam(':number', $number, PDO::PARAM_INT);
			$sql->bindParam(':name', $name, PDO::PARAM_STR);
			$sql->bindParam(':comment', $comment, PDO::PARAM_STR);
			$sql->bindParam(':password', $password, PDO::PARAM_STR);
			$sql->bindParam(':date', $date, PDO::PARAM_STR);
			$sql->execute();
}  //入力〆

if ( $_POST["edit_number"] != NULL && $_POST["edit_password"] != NULL){   //編集↓
	$number = $_POST["edit_number"];
	$password = $_POST["edit_password"];
	$edit_tf = false;
	$sql = 'SELECT * FROM mission_4';
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll();
		foreach($result as $row){
			if ($row['number'] == $number && $row['password'] == $password){
				$edit_number = $row['number'];
				$edit_comment = $row['comment'];
				$edit_name = $row['name'];
				$edit_password = $row['password'];
				$edit_tf= true;
       				break;
		}
}
 					if($edit_tf == false){
  						echo "パスワードが違います。<br>";
					}
			}
						if($_POST["hidden"] != NULL &&  $_POST["name"] != NULL&& $_POST["comment"] != NULL && $_POST["password"] != NULL){
 							$number = $_POST["hidden"];
 							$name = $_POST["name"];
 							$comment = $_POST["comment"];
 							$password = $_POST["password"];
 							$date = date("Y m d H:i", time());
 							$sql = 'update mission_4 set name=:name, comment=:comment, password=:password,date=:date where number=:number';
 							$stmt = $pdo->prepare($sql);
 							$stmt->bindParam(':name', $name, PDO::PARAM_STR);
 							$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
 							$stmt->bindParam(':password', $password, PDO::PARAM_STR);
 							$stmt->bindParam(':number', $number, PDO::PARAM_INT);
 							$stmt->bindParam(':date', $date, PDO::PARAM_INT);
 							$stmt->execute();
						} //編集〆

if($_POST["delete_number"] != NULL && $_POST["delete_password"] != NULL){  //削除↓
 	$number = $_POST["delete_number"];
	$password = $_POST["delete_password"];
 	$delete_tf=false;
	$sql = 'SELECT * FROM mission_4';
 	$stmt = $pdo->query($sql);
 	$result = $stmt->fetchAll();

 		foreach($result as $row){
     			if ($row['number'] == $number && $row['password'] == $password){
        			$delete = "削除されました。";
   				$space = " ";
   				$date = date("Y m d H:i", time())." に";
   				$sql = 'update mission_4 set name=:name, comment=:comment, password=:password,date=:date where number=:number';
   				$stmt = $pdo->prepare($sql);
   				$stmt->bindParam(':name', $delete, PDO::PARAM_STR);
   				$stmt->bindParam(':comment', $write_space, PDO::PARAM_STR);
   				$stmt->bindParam(':password', $write_space, PDO::PARAM_STR);
   				$stmt->bindParam(':number', $row['number'], PDO::PARAM_INT);
   				$stmt->bindParam(':date', $date, PDO::PARAM_STR);
   				$stmt->execute();
   				$delete_tf = true;
       				break;
     			}
 		}
 				if ($delete_tf == false){
  					echo "パスワードが違います。<br>";  
 				}

}
?>

<body>
   <form action = "mission_4.php" method = "post">
  	<input type = "hidden" name = "hidden" value = "<?php echo $edit_number; ?>" >
      	<input type = "text" name = "name" value = "<?php if($edit_name != NULL) {echo $edit_name;}?>"placeholder = "氏名">                                                                                                                                         
  	<input type = "text" name = "comment" value = "<?php if($edit_comment != NULL) {echo $edit_comment;} ?>"placeholder = "コメント">                                                                                                                                                
	<input type = "password" name = "password" value = "<?php if($edit_password != NULL){echo $edit_password;} ?>" placeholder = "パスワード" >
        <input type = "submit" name = "btn" value = "送信">
   </form>
   <form action = "mission_4.php" method = "post">
	<input type = "text" name = "edit_number" placeholder = "編集対象番号">
 	<input type = "password" name = "edit_password" placeholder = "パスワード" >
        <input type = "submit" name = "edit_btn" value = "編集">
   </form>

   <form action = "mission_4.php" method = "post">
	<input type = "text" name = "delete_number" placeholder = "削除対象番号" >
  	<input type = "password" name = "delete_password" placeholder = "パスワード" >
        <input type = "submit" name = "delete_btn" value = "削除" >
   </form>
    
<?php
	$sql = 'SELECT * FROM mission_4';
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll();
		foreach($result as $row){
    			echo $row['number'];
    			echo $row['name'];
    			echo $row['comment'];
    			echo $row['date'];
    			echo "<br>";
		}


?>
  </body>

</html>
