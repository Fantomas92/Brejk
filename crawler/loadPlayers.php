<?php

include '../init.php';

if(!isset($_GET['id_team']) or !is_numeric($_GET['id_team'])) {
 exit;
}

$id_team = $_GET['id_team'];

$curl = new cURL('http://www.brejk.cz/index.php?p=info_hraci&tym='. $id_team);
$content = $curl->execute();
$curl->__destruct();

$content = iconv('windows-1250', 'utf-8', $content);
$content = preg_replace('/<script[^>]*>(.*)<\/script>/ismU', '', $content);

preg_match('/<table[^>]*>.*<\/table>/ismU', $content, $table);

$content = $table[0];

$dom = new SmartDOMDocument();
$dom->loadHTML( $content );

$tr = $dom->getElementsByTagName('tr');

for($index = 1; $index < $tr->length; $index++) {

 foreach($tr->item($index)->getElementsByTagName('td') as $i => $column) {

  switch($i) {
   case 0:
    $flag = $column->getElementsByTagName('img')->item(0)->getAttribute('src');
    $flag = str_replace( array('images/flags/', '.gif'), '', $flag);
    break;
   case 1:
    $skill['age'] = $column->nodeValue;
    break;
   case 2:
    $name = $column->nodeValue;
    $id_player = $column->getElementsByTagName('a')->item(0)->getAttribute('href');
    $id_player = preg_replace('/^.*hrac=([0-9]*)&.*$/i', '$1', $id_player);
    break;
   case 3:
    $position = $column->nodeValue;
    break;
   case 4:
    $skill['g'] = $column->nodeValue;
    break;
   case 5:
    $skill['o'] = $column->nodeValue;
    break;
   case 6:
    $skill['u'] = $column->nodeValue;
    break;
   case 7:
    $skill['s'] = $column->nodeValue;
    break;
   case 8:
    $skill['t'] = $column->nodeValue;
    break;
   case 9:
    $skill['h'] = $column->nodeValue;
    break;
   case 10:
    $skill['a'] = $column->nodeValue;
    break;
   case 11:
    $skill['p'] = $column->nodeValue;
    break;
   case 12:
    $skill['k'] = $column->nodeValue;
    break;
   case 13:
    $skill['gr'] = $column->nodeValue;
    break;
   case 14:
    $skill['ga'] = $column->nodeValue;
    break;
   case 15:
    $skill['sd'] = $column->nodeValue;
    break;
   case 16:
    $skill['sz'] = $column->nodeValue;
    break;
   case 17:
    $skill['kr'] = $column->nodeValue;
    break;
   case 18:
    $skill['kv'] = $column->nodeValue;
    break;
   case 19:
    $skill['z'] = $column->nodeValue;
    break;
   case 20:
    $skill['ea'] = $column->nodeValue;
    break;
   case 21:
    $skill['ec'] = $column->nodeValue;
    break;
  }

 }

 if(!isset($id_player) or !is_numeric($id_player)) {
  continue;
 }

 $skill['id_team'] = $id_team;

 $count = dibi::query('select count(`id_player`) from `player` where `id_player` = %i', $id_player)->fetchSingle();

 if( $count == 0 ) {
  dibi::query('insert into `player`', array(
   'id_player' => $id_player,
   'name' => $name,
   'country' => $flag,
   'position' => $position
  ));
 }

 $count = dibi::query('select count(`id_player`) from `player_update` where `update` = %d and `id_player` = %i', lastConversion(), $id_player)->fetchSingle();

 if( $count == 1 ) {
  dibi::query('update `player_update` set', $skill, 'where `id_player` = %i and `update` = %d', $id_player, lastConversion());
 } else {
  $skill['update%d'] = lastConversion();
  $skill['id_player'] = $id_player;
  dibi::query('insert into `player_update`', $skill);
 }

 unset($skill);

}

echo 1;


?>