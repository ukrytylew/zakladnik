<?php
require_once('funkcje_bazy.php');

function pobierz_urle_uzyt($nazwa_uz) {
  // pobranie z bazy danych wszystkich URL-i danego u�ytkownika
  $lacz = lacz_bd();
  $wynik = $lacz->query("select URL_zak
                         from zakladka
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    return false;
  }

  // tworzenie tablicy URL-i
  $tablica_url = array();
  for ($licznik = 0; $rzad = $wynik->fetch_row(); ++$licznik) {
    $tablica_url[$licznik] = $rzad[0];
  }
  return $tablica_url;
}

function dodaj_zak($nowy_url) {
  // dodawanie nowych zak�adek do bazy danych

  echo "Pr�ba dodania ".htmlspecialchars($nowy_url)."<br />";
  $prawid_uzyt = $_SESSION['prawid_uzyt'];

  $lacz = lacz_bd();

  // sprawdzenie, czy zak�adka ju� istnieje
  $wynik = $lacz->query("select * from zakladka
                         where nazwa_uz='$prawid_uz'
                         and URL_zak='".$nowy_url."'");
  if ($wynik && ($wynik->num_rows>0)) {
    throw new Exception('Zak�adka ju� istnieje.');
  }

  // umieszczenie nowej zakladki
  if (!$lacz->query("insert into zakladka values
                     ('".$prawid_uzyt."', '".$nowy_url."')")) {
    throw new Exception('Wstawienie nowej zak�adki nie powiod�o si�');
  }

  return true;
}

function usun_zak($uzytkownik, $url) {
  // usuni�cie jednego URL-a z bazy danych
  $lacz = lacz_bd();
   // usuni�cie zak�adki
  if (!$lacz->query("delete from zakladka
                     where nazwa_uz='".$uzytkownik."' and URL_zak='".$url."'")) {
    throw new Exception('Usuni�cie zak�adki nie powiod�o si�.');
  }
  return true;
}

function rekomenduj_urle($prawid_uzyt, $popularnosc = 1) {
  // tworzenie p�inteligentnych rekomendacji
  // Je�eli posiadaj� URL-e wsp�lne z innymi u�ytkownikami, mog� im si�
  // spodoba� inne URL-e, kt�re lubi� inni
  $lacz = lacz_bd();

  // znalezienie innych pasuj�cych u�ytkownik�w
  // z podobnymi URL-ami
  // jako prosty spos�b wy��czania prywatnych stron u�ytkownik�w oraz
  // zwi�kszania szansy rekomendacji warto�ciowego URL
  // podany jest minimalny poziom popularno�ci
  // je�eli $popularnosc=1, wtedy wi�cej ni� jedna osoba musi posiada�
  // dany URL przed jego rekomendacj�

  $zapytanie = "select URL_zak
                from zakladka
                where nazwa_uz in
                                 (select distinct(z2.nazwa_uz)
                                  from zakladka z1, zakladka z2
                                  where z1.nazwa_uz='".$prawid_uzyt."'
                                  and z1.nazwa_uz!=z2.nazwa_uz)
                and URL_zak not in
                                 (select URL_zak
                                  from zakladka
                                  where nazwa_uz='".$prawid_uzyt."')
                group by URL_zak
                having count(URL_zak)>".$popularnosc;

  if (!($wynik = $lacz->query($zapytanie))) {
     throw new Exception('Nie znaleziono �adnych rekomendowanych zak�adek.');
  }
  if ($wynik->num_rows==0) {
     throw new Exception('Nie znaleziono �adnych rekomendowanych zak�adek.');
  }

  $urle = array();
  // stworzenie tablicy odpowiednich URL-i
  for ($licznik=0; $rzad = $wynik->fetch_object(); $licznik++) {
     $urle[$licznik] = $rzad->URL_zak;
  }

  return $urle;
}
?>
