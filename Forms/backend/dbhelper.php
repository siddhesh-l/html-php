<?php 

$SERVERNAME =  "localhost";
$USER = "root";
$PASSWORD = "";
$DBNAME = "siddhesh";

$conn = new mysqli($SERVERNAME, $USER, $PASSWORD, $DBNAME);

if(!$conn){
   die("Connection Failed!!!");
}

echo "Database Connected successfully";

?>