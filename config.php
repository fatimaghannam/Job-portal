<?php
//database connection details
$servername="localhost";
$username="root";
$password= "";
$database="hiremedb";

//create a new connection to the MySQL database
$conn=new mysqli($servername,$username,$password,$database);

//connection checker 
if($conn -> connect_error){
    die("connection failed :" .$conn->connect_error);
}
?>
