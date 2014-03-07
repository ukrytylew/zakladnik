<?php

function lacz_bd() {
   $wynik = new mysqli('localhost', 'root', '', 'zakladki');
   if (!$wynik) {
      throw new Exception('Po��czenie z serwerem bazy danych nie powiod�o si�');
   } else {
      return $wynik;
   }
}

?>
