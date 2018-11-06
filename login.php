<?php
session_start();
$us='';$pass='';
if(isset($_POST["email"]))
	{
		$us=$_POST["email"];
	}
if(isset($_POST["password"]))
	{
		$pass=$_POST["password"];
	}
$l="localhost";
$user="root";
$p="";
$db="mywebsite";
$conn = new mysqli($l, $user, $p, $db);
$perr="";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT Name,Buyer FROM signup WHERE Email='$us' AND Password= '$pass'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$name=$row["Name"];
$buy=strtolower($row["Buyer"]);}
$c=$result->num_rows;
if($c==1 && $buy=='buyer') 
{
    $_SESSION["name"] = $name;
    header("location: ./website2.php");
    exit();
}
else if($c==1 && $buy=='seller')
{
	$_SESSION["name"] = $name;
    header("location: ./websiteseller.php");
    exit();
}
else{
$perr="Wrong credentials";
$_SESSION["error"]=$perr;
}
$conn->close();
?>