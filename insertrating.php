<?php 
//Database connection, replace with your connection string.. Used PDO
// $dbh = new PDO("mysql:host=localhost;dbname=webd173", "root", "root");
// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include 'inc/dbconnect.php';
$prodid = $_GET['product'];
$rating = $_GET['rating'];
$ip = $_SERVER['REMOTE_ADDR'];
//CHECK IP ADDRESS
$checksql = $dbh->prepare("select count(id) from rating where ipaddress = ? and productid = ?");
$checksql->execute(array($ip, $prodid));
$numcheck = $checksql->fetch();
$numrows = $numcheck[0];
// echo 'RATING=' . $rating.' product id= '.$prodid;

if($numrows<1){
    $inssql = $dbh->prepare("insert into rating(rating, ipaddress, productid) values (?,?,?)");
    $inssql->execute(array($rating,$ip,$prodid));
    
//

$sql = $dbh->prepare("SELECT avg(rating) as average from rating where productid = ?");
$sql->bindValue(1, $prodid);
$sql->execute();
$row = $sql->fetch();
$avg = $row['average'];
// var_dump($avg);
$i=1;
// echo 'average = ' . $avg;
while($i<=5){
    if ($i <= ceil($avg)){
        echo '<i class="far fa-star full-star"  onclick="sendRequest(\''.$prodid.'\',\''.$i.'\')";></i>';
    }else{
        echo '<i class="fas fa-star empty-star"  onclick="sendRequest(\''.$prodid.'\',\''.$i.'\')";></i>';
    }
    $i++;
}
}
else{
    echo 'no';
}
?>