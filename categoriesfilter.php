<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
//Database connection, replace with your connection string.. Used PDO
// $dbh = new PDO("mysql:host=localhost;dbname=webd173", "root", "root");
// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include 'inc/dbconnect.php';
$qry= $_GET['catid'];
// $query = "SELECT * FROM products where catid like '%$qry%'";
$query = "SELECT * FROM products where catid = '$qry'";
$stmt = $dbh->prepare($query);

$stmt->execute();
$products= $stmt->fetchAll();
include 'inc/showProducts.php';
?>