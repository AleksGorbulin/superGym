<?php
//Database connection, replace with your connection string.. Used PDO
$dbh = new PDO("mysql:host=localhost;dbname=webd173", "root", "root");
// $dbh = new PDO("mysql:host=localhost;dbname=webd173_custome", "agorbulin", "agorbulin");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>