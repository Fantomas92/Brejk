<?php

include '../init.php';

/* Pokud bude potřeba přihlášení */

$curl = new cURL('http://www.brejk.cz/index.php');
$curl->post(array(
 'login' => '',
 'password' => '',
 'submit' => 1
));
$curl->execute();
$curl->__destruct();

/**/
?>