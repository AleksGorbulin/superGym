<?php 
error_reporting(E_ALL);
// Connect to DB
include 'inc/dbconnect.php';
// $qry= $_GET['qry'];
$query = "SELECT * FROM products where catid != '7'";
// echo $query;
$stmt = $dbh->prepare($query);
$stmt->execute();
$products= $stmt->fetchAll();
    include 'inc/showProducts.php';
?>