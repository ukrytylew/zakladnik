<?php
require_once ('funkcje_zakladki.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//session_start();
if(isset($_POST['iduzytkownika'])&&isset($_POST['haslo'])){

$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=zakladki", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database<br />';

    /*** set the error reporting attribute ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $login = $_POST['iduzytkownika'];
    $haslo = $_POST['haslo'];

    /*** prepare the SQL statement ***/
    $stmt = $dbh->prepare("SELECT * FROM zakladka WHERE nazwa_uz = :login ");

    /*** bind the paramaters ***/
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);

    /*** execute the prepared statement ***/
    $stmt->execute();

    /*** fetch the results ***/
    $result = $stmt->fetchAll();
     echo '<br/>'.$login.'<br/>';
    foreach($result as $row)
       
    {
        echo $row['URL_zak'].'<br />';
       // echo $row['nazwisko'];
  
    
    }
  

    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}
  


?>
