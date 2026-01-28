<?php
include "db.php";
session_start();

$id=$_SESSION["user"]["id"];
$sql="SELECT * FROM arizalar WHERE ogrenci_id=$id";
$result=$conn->query($sql);

while($row=$result->fetch_assoc()){
    echo $row["baslik"]."-".$row ["durum"]."<br>";
}
?>

