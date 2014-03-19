<?php
    function tworz_naglowek_html($tytul)
    { //wyswietlanie naglowka html

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" media="screen">
         <link href="css/style.css" rel="stylesheet" media="screen">
        <title><?php echo $tytul; ?></title>
    </head>
    <body>
        <?php
             if($tytul)
             {
                 tworz_tytul_html($tytul);
                 
                
             }
     }
              function tworz_stopke_html()
              {
                
        ?>
        <div class="row">
            <div class="col-md-12 tlo fox">
               Copyright by my mom
            </div>
        </div>
    </body>
</html>
        <?php
              }
              function tworz_tytul_html ($tytul)
              {   //wyswietla tytul
         ?>
             <div class="page-header">
                <div class="container-fluid tlo">
                    <div class="row">
                        <h1 class="test bialaCzcionka">
                            Zakładnik <br/>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                         <small>
                             <h3>
                                 <?php 
                                 if(isset($_SESSION['user']))
        {
                                     echo $_SESSION['user'];
          // echo'uzytkownik zalogowany jako '.$_SESSION[''].'<br/>';
            echo '<br/><a href = "wyloguj.php">wyloguj</a>';
        }
        else {echo'';}
                                 ?>
                             Okup będzie słony....<br/>
                             </h3>
                         </small>
                         </div>
                        <div class="col-md-5">
                        </div>
                    </div>
                </div>
            </div>
        <h2>
        <?php echo $tytul;
        ?>
        </h2>
        <?php
             }
             function tworz_HTML_URL($url,$nazwa)
             { //wyswietla url jako lacza i nowa linia
        ?>
             <br /><a href="<?php echo $url;?>"><?php echo $nazwa;?></a><br />
        <br/> 
        <a href = "<?php echo $url; ?>"><?php echo $nazwa; ?></a>
        <br/>
        <?php
            }
            function wyswietl_informacje_witryny()
            {
        ?>
        <?php
            }
            function showMarksP1(){
            ?>
               <table class="table table-hover">
                   
                       
                       <?php 
                       }
                       function marks($marks){ ?>
                       <tr>
                       <td><?php echo $marks; ?></td><td><input type="checkbox"></td>
                       </tr>
                       <?php
                       }
                       ?>
                       <?php
                         function showMarksP2(){
                             ?>
                     
               </table>
            <button type="submit" class="btn btn-danger">Usuń mnie</button>
        <?php
            }
            function welcomeUser($welcomeUser){
        ?>
        <button type="button" class="btn btn-default"><?php echo $welcomeUser; ?></button>
      

        <?php
            }
        function stopka_rej()
        {
        
        ?>
 <div class="row">
            <div class="col-md-12 tlo">
                <h1 class="test bialaCzcionka">
                    <a href="rejestracja.php">
                         Zarejestruj mnie tak...
                         <small>
                            <?php
                            
                            ?>
                             <h3>
                             nawet gdy nie będę chciał.
                             </h3>
                         </small>
                    </a>
                </h1>
            </div>
        </div>
        <?php
        }
            function wyswietl_form_log()
            {
                
        ?>
        
        <?php
            }
            function wyswietl_form_rej()
            {
        ?>
        <form class="form-horizontal" role="form" action="rejestration.php" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-md-2 control-label" >Email</label>
    <div class="col-md-9">
      <input type="text" class="form-control" id="inputlogin" name="email" placeholder="Email">
    </div>
    <div class="col-md-1">
    </div>
  </div>
   <div class="form-group">
    <label for="inputNazwa" class="col-md-2 control-label" >Nazwa użytkownika</label>
    <div class="col-md-9">
      <input type="text" class="form-control" id="inputlogin" name="iduzytkownika" placeholder="nazwa uzytkownika">
    </div>
    <div class="col-md-1">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-md-2 control-label" >Password</label>
    <div class="col-md-9">
      <input type="password" class="form-control" id="inputPassword3" name="haslo" placeholder="Password">
    </div>
    <div class="col-md-1">
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-md-2 control-label">Repeat password</label>
    <div class="col-md-9">
      <input type="password" class="form-control" id="inputPassword3" name="haslo2" placeholder="Password">
    </div
    <div class="col-md-1">
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-offset-2 col-md-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-offset-2 col-md-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>

        <?php
            }
            function wyswietl_urle_uzyt($tablica_url)
            {
        global $tabela_zak;
  $tabela_zak = true;
?>
  <br />
  <form name="tabela_zak" action="usun_zak.php" method="post">
  <table width="300" cellpadding="2" cellspacing="0">
  <?php
  $kolor = "#cccccc";
  echo "<tr bgcolor=\"".$kolor."\"><td><strong>Zak�adka</strong></td>";
  echo "<td><strong>Usu�?</strong></td></tr>";
  if ((is_array($tablica_url)) && (count($tablica_url) > 0)) {
    foreach ($tablica_url as $url) {
      if ($kolor == "#cccccc") {
        $kolor = "#ffffff";
      } else {
        $kolor = "#cccccc";
      }
      // nale�y pami�ta� o wywo�aniu htmlspecialchars() przy wy�wietlaniu danych u�ytkownika
      echo "<tr bgcolor=\"".$kolor."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
            <td><input type=\"checkbox\" name=\"usun_mnie[]\"
             value=\"".$url."\"/></td>
            </tr>";
      }
  } else {
    echo "<tr><td>Brak zapisanych zak�adek</td></tr>";
  }
?>
  </table>
  </form>
        <?php
            }
            function wyswietl_menu_uzyt()
            {
        ?>
     
                            <ul class="nav nav-pills">
  <li class="active"><a href="#">Home</a></li>
  <li><a href="#">Profile</a></li>
  <li><a href="#">Messages</a></li>
</ul>

  <hr />
<a href="czlonek.php">Home</a> &nbsp;|&nbsp;
<a href="dodaj_zak_formularz.php">Dodaj zak�adk�</a> &nbsp;|&nbsp;
<?php
  // opcja usu� jedynie w wypadku wy�wietlenia tabeli zak�adek
  global $tabela_zak;
  if($tabela_zak == true) {
    echo "<a href=\"#\" onClick=\"tabela_zak.submit();\">Usu� zak�adki</a>&nbsp;|&nbsp;";
  } else {
    echo "<span style=\"color: #cccccc\">Usu� zak�adki</span>&nbsp;|&nbsp;";
  }
?>
<a href="zmiana_hasla_formularz.php">Zmiana has�a</a>
<br />
<a href="rekomendacja.php">Zarekomenduj URL-e</a> &nbsp;|&nbsp;
<a href="wylog.php">Wylogowanie</a>
<hr />
  
        <?php
            }
            function wyswietl_dodaj_zak_form()
            {//wyswietlanie formularza do dodawania nowych zakladek
        ?>
        <form name="tabela_zak" action="dodaj_zak.php" method="post">
<table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
<tr><td>Nowa zak�adka:</td>
<td><input type="text" name="nowy_url"  value="http://"
                        size="30" maxlength="255"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Dodaj zak�adk�"></td></tr>
</table>
</form>
        <?php
            }
            function wyswietl_haslo_form()
            {
        ?>
        <br />
   <form action="zmiana_hasla.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Poprzednie has�o:</td>
       <td><input type="password" name="stare_haslo" size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Nowe has�o:</td>
       <td><input type="password" name="nowe_haslo" size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Powtorzenie nowego has�a:</td>
       <td><input type="password" name="nowe_haslo2" size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2" align="center"><input type="submit" value="Zmiana has�a"/>
   </td></tr>
   </table>
   <br />
        <?php
            }//;
            function wyswietl_zapomnij_form()
            {
        ?>
        
        <?php
            }
            function logowanie()
            {
         ?>
        <div class="jumbotron tlo2">
            <form class = "form-horizontal" role = "form" method = "POST" action = "uzytkownik.php">
  <div class="form-group">
      <div class="col-md-12">
    <label class="sr-only" for="email_uz">Email address</label>
    <input type="text" class="form-control" name ="iduzytkownika" id="exampleInputEmail2" placeholder="Enter login baby!">
  </div>
  </div>
  <div class="form-group">
      <div class="col-md-12">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <input type="password" name="haslo" class="form-control" id="exampleInputPassword2" placeholder="Password">
  </div>
  </div>
 <div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox"> Remember me
    </label>
  </div>
 </div>
 <div class="form-group">
  <button type="submit" class="btn btn-success ">Sign in</button>
</form>
</div>
</div>

        <?php
            }
            function wyswietl_rekomend_urle($tablica_url)
            {
        ?>
        
     <br />
  <table width="300" cellpadding="2" cellspacing="0">
<?php
  $kolor = "#cccccc";
  echo "<tr bgcolor=\"".$kolor."\"><td><strong>Rekomendacje</strong></td></tr>";
  if ((is_array($tablica_url) && count($tablica_url)>0)) {
    foreach ($tablica_url as $url) {
      if ($kolor == "#cccccc") {
        $kolor = "#ffffff";
      } else {
        $kolor = "#cccccc";
      }
      echo "<tr bgcolor=\"".$kolor."\">
            <td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td></tr>";
    }
  } else {
    echo "<tr><td>Aktualnie brak rekomendacji.</td></tr>";
  }
?>
  </table>
     
 
<?php

}
?>

     

     