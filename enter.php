<?php
session_start();
    
require_once ('funkcje_zakladki.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
showBand();
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

try {
    
   
    
    $dbh = new PDO("mysql:host=$hostname;dbname=zakladki", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database<br />';

    /*** set the error reporting attribute ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$login = $_POST['iduzytkownika'];
  $stmt = $dbh-> exec('INSERT INTO `zakladka`  VALUES ( 
                                \''.$_SESSION['user'].'\',
				\''.$_POST['addressURL'].'\')');

  
  
    //showMarksP2();
    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
   }
//}

tworz_stopke_html();
?>
