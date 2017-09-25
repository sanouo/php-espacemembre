<?php

session_start();


$_SESSION = array();

session_destroy();

setcookie('login', '');
setcookie('pass_hache', '');


echo 'Vous etes deconnecter';
?>
