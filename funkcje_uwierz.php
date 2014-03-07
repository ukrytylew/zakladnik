<?php

require_once('funkcje_bazy.php');

function rejestruj($nazwa_uz, $email, $haslo) {
// zarejestrowanie nowej osoby w bazie danych
// zwraca true lub komunikat o b��dzie

 // po��czenie z baz� danych
  $lacz = lacz_bd();

  // sprawdzenie, czy nazwa u�ytkownika nie powtarza si�
  $wynik = $lacz->query("select * from uzytkownik where nazwa_uz='" .$nazwa_uz. "'");
  if (!$wynik) {
     throw new Exception('Wykonanie zapytania nie powiod�o si�.');
  }

 if ($wynik->num_rows>0) {
     throw new Exception('Nazwa u�ytkownika zaj�ta � prosz� wr�ci� i wybra� inn�.');
  }

  // je�eli wszystko w porz�dku, umieszczenie w bazie danych
  $wynik = $lacz->query("insert into uzytkownik values
                       ('".$nazwa_uz."', '".$haslo."', '".$email."')");
  if (!$wynik) {
    throw new Exception('Rejestracja w bazie danych niemo�liwa � prosz� spr�bowa� p�niej.');
  }

  return true;
}

function loguj($nazwa_uz, $haslo) {
// sprawdzenie nazwy u�ytkownika i has�a w bazie danych
// je�eli si� zgadza, zwraca true
// je�eli nie, wyrzuca wyj�tek

  // po��czenie z baz� danych
  $lacz = lacz_bd();

  // sprawdzenie unikatowo�ci nazwy u�ytkownika
  $wynik = $lacz->query("select * from uzytkownik
                         where nazwa_uz='".$nazwa_uz."'
                         and haslo = sha1('".$haslo."')");
  if (!$wynik) {
     throw new Exception('Logowanie nie powiod�o si�.');
  }

  if ($wynik->num_rows>0) {
     return true;
  } else {
     throw new Exception('Logowanie nie powiod�o si�.');
  }
}

function sprawdz_prawid_uzyt() {
// sprawdzenie czy u�ytkownik jest zalogowany i powiadomienie go je�eli nie
  if (isset($_SESSION['prawid_uzyt'])) {
      echo "Zalogowano jako ".$_SESSION['prawid_uzyt'].".<br />";
  } else {
     // nie jest zalogowany
     tworz_naglowek_html('Problem:');
     echo 'Brak zalogowania.<br />';
     tworz_HTML_URL('logowanie.php', 'Logowanie');
     tworz_stopke_html();
     exit;
  }
}

function zmien_haslo($nazwa_uz, $stare_haslo, $nowe_haslo) {
// zmiana has�a u�ytkownika ze stare_haslo na nowe_haslo
// zwraca true lub false

  // je�eli stare has�o jest prawid�owe zmiana nowe_haslo i zwr�cenie true
  // w przeciwnym wypadku wyrzucenie wyj�tku
  loguj($nazwa_uz, $stare_haslo);
  $lacz = lacz_bd();
  $wynik = $lacz->query("update uzytkownik
                         set haslo = sha1('".$nowe_haslo."')
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    throw new Exception('Zmiana has�a nie powiod�a si�.');
  } else {
    return true;  // zmiana udana
  }
}

function pobierz_losowe_slowo($dlugosc_min, $dlugosc_max) {
//pobranie losowego s�owa ze s�ownika o okre�lonej d�ugo�ci zwr�cenie go

  // generowanie losowego s�owa
  $slowo = '';
  // t� �cie�k� nale�y dostosowa� do ustawie� w�asnego systemu
  $slownik = '/usr/dict/words';  // s�ownik ispell
  $wp = @fopen($slownik, 'r');
  if(!$wp) {
    return false;
  }
  $wielkosc = filesize($slownik);

  // przej�cie do losowej pozycji w s�owniku
  $losowa_pozycja = rand(0, $wielkosc);
  fseek($wp, $losowa_pozycja);

  // pobranie ze s�ownika nast�pnego pe�nego s�owa o w�a�ciwej d�ugo�ci
  while ((strlen($slowo) < $dlugosc_min) || (strlen($slowo)>$dlugosc_max) || strstr($slowo, "'")) {
     if (feof($wp)) {
        fseek($wp, 0);        // je�eli koniec pliku, przeskocz na pocz�tek
     }
     $slowo = fgets($wp, 80);  // przeskoczenie pierwszego s�owa bo mo�e by� niepe�ne
     $slowo = fgets($wp, 80);  // potencjalne has�o
  }
  $slowo = trim($slowo); // obci�cie pocz�tkowego \n z funkcji fgets
  return $slowo;
}

function ustaw_haslo($nazwa_uz) {
// ustawienie has�a u�ytkownika na losow� warto��
// zwraca nowe has�o lub false w przypadku niepowodzenia

  // pobranie losowego s�owa ze s�ownika o d�ugo�ci pomi�dzy 6 i 13 znak�w
  $nowe_haslo = pobierz_losowe_slowo(6, 13);

  if($nowe_haslo == false) {
    throw new Exception('Wygenerowanie nowego has�a nie powiod�o si�.');
  }

  // dodanie liczby pomi�dzy 0 i 999 w celu stworzenia lepszego has�a
  $losowa_liczba = rand(0, 999);
  $nowe_haslo .= $losowa_liczba;

  // ustawienie nowego has�a w bazie danych lub zwr�cenie false
  $lacz = lacz_bd();
      return false;
  $wynik = $lacz->query("update uzytkownik
                         set haslo = sha1('".$nowe_haslo."')
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    throw new Exception('Zmiana has�a nie powiod�a si�.');  // has�o nie zmienione
  } else {
    return $nowe_haslo;  // has�o zmienione pomy�lnie
  }
}

function powiadom_haslo($nazwa_uz, $haslo) {
// powiadomienie u�ytkownika o zmianie has�a

    $lacz = lacz_bd();
    $wynik = $lacz->query("select email from uzytkownik
                           where nazwa_uz='".$nazwa_uz."'");
    if (!$wynik) {
      throw new Exception('Nie znaleziono adresu e-mail');
    } else if ($wynik->num_rows == 0) {
      throw new Exception('Nie znaleziono adresu e-mail'); // nazwy u�ytkownika nie ma w bazie danych
    } else {
      $wiersz = $wynik->fetch_object();
      $email = $wiersz->email;
      $od = "From: obsluga@zakladkaphp \r\n";
      $wiad = "Has�o systemu Zak�adkaPHP zosta�o zmienione na $haslo \r\n"
              ."Prosz� zmieni� je przy nast�pnym logowaniu. \r\n";


      if (mail($email, 'Informacja o logowaniu Zak�adkaPHP', $wiad, $od)) {
        return true;
      } else {
        throw new Exception('Wys�anie e-maila nie powiod�o si�');
      }
    }
}

?>