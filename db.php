<?php
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "events_management";


try{
$conn = new mysqli($servername,$username, $password, $dbname);
echo"";
}
catch(mysqli_sql_exception){
    echo"<h1>Faild to connect Database. </h1> ";
}


?>