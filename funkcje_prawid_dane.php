<?php

function wypelniony($zmienne_formularza) {
  // sprawdzenie, czy ka�da zmienna posiada warto��
  foreach ($zmienne_formularza as $klucz => $wartosc) {
     if ((!isset($klucz)) || ($wartosc == '')) {
        return false;
     }
  }
  return true;
}

function prawidlowy_email($adres) {
  // sprawdzenie prawid�owo�ci adresu  poczty elektronicznej
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $adres)) {
    return true;
  } else {
    return false;
  }
}

?>
