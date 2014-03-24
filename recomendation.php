<?php
session_start();

require_once ('funkcje_zakladki.php');
showBand();
//if(isset($_SESSION['user'])){

$hostname = 'localhost';


/*** mysql username ***/
$username = 'root';
/*** mysql password ***/
$password = '';
//echo $mark.'<br/>';

//echo $login .'<br/>';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=zakladki", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database<br />';

    /*** set the error reporting attribute ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $login=$_SESSION['user'];
  //  $haslo = $_POST['haslo'];
    /*** prepare the SQL statement ***/
    
    $stmt = $dbh->prepare("select URL_zak
                from zakladka
                where nazwa_uz in
                                 (select distinct(z2.nazwa_uz)
                                  from zakladka z1, zakladka z2
                                  where z1.nazwa_uz = :login
                                  and z1.nazwa_uz!=z2.nazwa_uz)
                and URL_zak not in
                                 (select URL_zak
                                  from zakladka
                                  where nazwa_uz = :login)
                group by URL_zak
                having count(URL_zak)>0; ");

    /*** bind the paramaters ***/
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
  //  $stmt->bindParam(':haslo', $haslo, PDO::PARAM_STR, 5);

    /*** execute the prepared statement ***/
    $stmt->execute();

    /*** fetch the results ***/
    $result = $stmt->fetchAll();
    
    foreach($result as $row)
        {
        echo $row['URL_zak'].'<br />';
        //echo $row['haslo'].'<br />';
       // echo $row['nazwisko'];
    
        
    $ile=$stmt->rowCount();
    
    //echo $ile;
    
    if($stmt -> rowCount() > 0)
    {
        $_SESSION['user'] = $login; 
        $_SESSION['name'] = $row['URL_zak'];
    }
        }
  

    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
     
    
   
tworz_stopke_html();

?>



       



