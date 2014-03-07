<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
        session_start();
        $stary = $_SESSION['user'];
        unset($_SESSION['user']);
        session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       if(!empty($stary))
       {
           echo'wylogowano !!!! <br/>';
       }
       else
       {
           echo'odejdz precz niezalogowany uzytkowniku !';
       }
        ?>
        <a href ="index.php">powrot... do domu</a>
    </body>
</html>
