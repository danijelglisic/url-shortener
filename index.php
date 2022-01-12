
<html>
    <head>
    <title>Link Shortener</title>
    </head>
    <header>

            <h1>LINK SHORTENER</h1>

        </header>

<body>

    <div class="form">
    

        <form method="POST" enctype="multipart/form-data" class="form">
            
                
                <input type="text" name="link" placeholder="Input yout link">
            
            <button type="submit" name="submit">SHORTEN</button>
        </form>
    </div> 
    <div class="href">
        <a href="views.php">Check how many clicks your new link has :) </a>
    </div>
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
       color: #001ea3;;
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

	background-color: #001ea3;
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
a{
    
    color: #001ea3;
    
}
.href{
    color: #001ea3;
    margin: auto;
    width: 50%;
    text-align: center;
    
}


   </style>


</html>



<?php
error_reporting(0);

include_once("mysqli_conn.php");
include("classes.php");

if($_GET["c"]== null){

    if(isset($_POST['submit']))
    {

        $link = new Shortener();
        $link->link = $_POST['link'];

        do{
            $unique = false;
            $link->createShortLink();
            $sql = "SELECT * FROM link WHERE short_link = '" . $link->short_link . "'";
            $result = mysqli_query($mysqli, $sql);
            $row = mysqli_num_rows($result);
            if($row < 1){
                $unique = true;
            }
            
        }while($unique==false) ;



        $sql = "INSERT INTO link (link, short_link)
        VALUES ('$link->link', '$link->short_link')";

        if ($mysqli->query($sql) === TRUE) {
        //echo "New record created successfully\n";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "INSERT INTO views (views)
        VALUES ('0')";
        $mysqli->query($sql);
    ?>
    <div class="a">
        <a href = "<?php echo  "http://localhost/URL/index.php?c=" . $link->short_link; ?>"><?php echo  "http://localhost/URL/index.php?c=" . $link->short_link;?></a>
    </div>
    <?php
        
        
    }
}



else if($_GET["c"] != null){
    $short_link = $_GET["c"];

    $result = mysqli_query($mysqli, "SELECT * FROM link WHERE short_link = '" . $short_link . "' LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    echo $row['link'];


    $id = $row['ID'];

    $sql = "UPDATE views SET views = views + 1  WHERE id = '".$id."'";

    $mysqli->query($sql);



    


    if ($result->num_rows > 0) {
        header("Location: ". $row['link']);

      }
        

}








?>