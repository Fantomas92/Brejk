<?php

function lastConversion() {
 if( date('G') >= 23 ) {
  return ( strtotime('today') );
 } else {
  return ( strtotime('yesterday') );
 }
}

?>
