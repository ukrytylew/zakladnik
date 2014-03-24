<?php
 require_once ('funkcje_zakladki.php');
session_start();
if(isset($_POST['iduzytkownika'])&&isset($_POST['haslo']))
{

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

    $login = $_POST['iduzytkownika'];
    $haslo = $_POST['haslo'];
    /*** prepare the SQL statement ***/
    $stmt = $dbh->prepare("SELECT * FROM uzytkownik WHERE nazwa_uz = :login AND haslo = :haslo");

    /*** bind the paramaters ***/
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':haslo', $haslo, PDO::PARAM_STR, 5);

    /*** execute the prepared statement ***/
    $stmt->execute();

    /*** fetch the results ***/
    $result = $stmt->fetchAll();
    
    foreach($result as $row)
        {
       // echo $row['login'].'<br />';
        //echo $row['haslo'].'<br />';
       // echo $row['nazwisko'];
    
        
    $ile=$stmt->rowCount();
    
    //echo $ile;
    
    if($stmt -> rowCount() > 0)
    {
        $_SESSION['user'] = $login; 
        $_SESSION['name'] = $row['email'];
    }
        }
  

    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
     
    
   
}


   
        
        if(isset($_SESSION['user']))
        {
           // echo '<br/> uzytkownik zalogowany jako '.$_SESSION['user'].'<br/>'.' o nazwisku: '. $_SESSION['name'];
          //  echo '<a href="wyloguj.php">wyloguj</a><br/>';
           // echo '<a href="showBookmarks.php">zakladki<br/></a>';
            $user=$_SESSION['user'];
         //   echo $_SESSION['user'];
          
            
        }            
        
        else
        {
            if(!isset($login)||!isset($haslo))
            {
                echo'logowanie niemozliwe' ;
            }
            
            else
            {
                echo 'uzytkownik niezalogowany';
            }
        
        
        }
     
   showBand();
    welcomeUser($_SESSION['user']);
    tworz_stopke_html();
    
        ?>


       