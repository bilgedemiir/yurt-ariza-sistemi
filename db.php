<?php
$servername="localhost";
$username="root";
$password= "";
$database="yurt_ariza";
$conn= new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
    die("Bağlantı Hatası:" .$conn->connect_error);

}
?>
