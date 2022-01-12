<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Views Reviews</title>
    </head>
    <header>

            <h1>Check how many clicks the link has</h1>

        </header>
<body>
<div class="form">
    
        <form method="POST" enctype="multipart/form-data" class="form">
            
            
                <input type="text" name="short_link" placeholder="Insert link and check">
            
            <button type="submit" name="submit">CHECK</button>
        </form>
    </div> 






<?php



include_once("mysqli_conn.php");


if(isset($_POST['submit'])){


    $short_link =$_POST['short_link'];


    $short_link = str_replace("http://localhost/URL/index.php?c=","",$short_link);
    $result = mysqli_query($mysqli, "SELECT * FROM link WHERE short_link = '" . $short_link . "' LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    //echo $row['link'];

    $id = $row['ID'];

    $result = mysqli_query($mysqli, "SELECT * FROM views WHERE id = '".$id."'");
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="a">
        <?php
            echo $row['views'];
        ?>
    </div>


<?php

}

?>
</body>
<style>
    * {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Fira Sans', sans-serif;
}
   
   body {
       background-color: #fff;
   }
   
   header {
       display: flex;
       justify-content: center;
       margin: 60px 0px;
   }
   header h1 {
       color: #313131;
       font-weight: 400;
       text-align: center;
   }
   .form {
	display: flex;
	justify-content: center;
	margin-top: 60px;
	margin-bottom: 60px; 
}
.form form {
	display: flex;
	box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	width: 100%;
	max-width: 420px;
}
.form form input[type="text"] {
	display: block;
	padding: 12px 16px;

	appearance: none;
	border: none;
	outline: none;
	background: none;

	background-color: #FFF;
	border-radius: 8px 0px 0px 8px;
	
	width: 100%;

	color: #666666; 
    
}
.form button[type="submit"] {
	display: block;
	padding: 12px 16px;

	appearance: none;
	border: none;
	outline: none;
	background: none;
	cursor: pointer;

	background-color: #ff9500;
	color: #FFF;
	font-weight: 700;
	border-radius: 0px 8px 8px 0px;
}
.a{
    color: #001ea3;
    margin: auto;
    width: 50%;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.2);
    padding: 12px 16px;
    text-align: center;
    border-radius: 8px;

}
</style>
</html>