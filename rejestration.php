<?php

  // utworzenie kr�tkich nazw zmiennych
  $email=$_POST['email'];
  $nazwa_uz=$_POST['iduzytkownika'];
  $haslo=$_POST['haslo'];
  $haslo2=$_POST['haslo2'];

  // rozpocz�cie sesji, kt�ra mo�e okaza� si� konieczna p�niej
  // rozpocz�cie w tym miejscu, musi ona zosta� przekazana przed nag��wkami
   session_start();

   // do��czenie plik�w funkcji tej aplikacji
   require_once('funkcje_zakladki.php');

   try {
     // sprawdzenia wype�nienia formularzy
     if (!wypelniony($_POST)) {
        throw new Exception('Formularz wype�niony nieprawid�owo � prosz� wr�ci� i spr�bowa� ponownie.');
     }

     // nieprawid�owy adres poczty elektronicznej
    // if (!prawidlowy_email($email)) {
   //     throw new Exception('Nieprawid�owy adres poczty elektronicznej � prosz� wr�ci� i spr�bowa� ponownie.');
   //  }

     // r�ne has�a
     if ($haslo != $haslo2) {
        throw new Exception('Niepasuj�ce do siebie has�a � prosz� wr�ci� i spr�bowa� ponownie.');
     }

     // sprawdzenie d�ugo�ci nazwy u�ytkownika
     

     // sprawdzenie d�ugo�ci has�a
     // nazw� u�ytkownika mo�na skr�ci�, lecz zbyt d�ugiego
     // has�a skr�ci� nie mo�na
     if ((strlen($haslo) < 6) || (strlen($haslo) > 16)) {
        throw new Exception('Has�o musi mie� co najmniej 6 i maksymalnie 16 znak�w � prosz� wr�ci� i spr�bowa� ponownie.');
     }
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';
     // pr�ba zarejestrowania
    try {
    $dbh = new PDO("mysql:host=$hostname;dbname=zakladki", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database<br />';

    /*** set the error reporting attribute ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   

    
    
    

    /*** prepare the SQL statement ***/
    $stmt = $dbh-> exec('INSERT INTO `uzytkownik` (`nazwa_uz`, `haslo`, `email`)	VALUES(
				\''.$_POST['iduzytkownika'].'\',
				\''.$_POST['haslo'].'\',
				\''.$_POST['email'].'\')');
  
  

    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }


     // stworzenie ��cza do strony cz�onkowskiej
     tworz_naglowek_html('Rejestracja pomyślna');
     echo 'Zakończona sukcesem, miód i w ogóle tęcza i takie tam '
         .'skonfiguruj bejbe swoje zakładki co ?!';
     tworz_HTML_URL('index.php', 'Strona cz�onkowska');

     // koniec strony
     tworz_stopke_html();
   }
   catch (Exception $e) {
     tworz_naglowek_html('Problem:');
     echo $e->getMessage();
     tworz_stopke_html();
     exit;
   }
?>