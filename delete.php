<?php
session_start();

require_once ('funkcje_zakladki.php');
showBand();
//if(isset($_SESSION['user'])){
$login=$_SESSION['user'];
$hostname = 'localhost';
$mark=$_POST['markDelete'];

/*** mysql username ***/
$username = 'root';
/*** mysql password ***/
$password = '';
//echo $mark.'<br/>';

//echo $login .'<br/>';

try {
 //  if (count($mark) > 0) 
   //    echo count($mark);
   //    {
   //   foreach($mark as $item) {
   //     echo $item.'<br/>';
  //    }
 //   } 
  
    $dbh = new PDO("mysql:host=$hostname;dbname=zakladki", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database<br />';

    /*** set the error reporting attribute ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$login = $_POST['iduzytkownika'];
 //if (count($mark) > 0){
    //    foreach($mark as $dbh){
            /*** prepare the SQL statement ***/
   $stmt = $dbh-> exec("DELETE FROM zakladka WHERE nazwa_uz = '$login' and URL_zak = '$mark' ");
            
      //  }
   // }
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
