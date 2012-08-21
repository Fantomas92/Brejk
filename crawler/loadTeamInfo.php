<?php

include '../init.php';

if(!isset($_GET['id_team']) or !is_numeric($_GET['id_team'])) {
 exit;
}

$id_team = $_GET['id_team'];

$curl = new cURL('http://www.brejk.cz/index.php?p=info_tym&tym='. $id_team);
$content = $curl->execute();
$curl->__destruct();

$content = iconv('windows-1250', 'utf-8', $content);
$content = preg_replace('/<script[^>]*>(.*)<\/script>/ismU', '', $content);

preg_match('/<table[^>]*>.*<\/table>/ismU', $content, $table);

$content = $table[0];

$dom = new SmartDOMDocument();
$dom->loadHTML( $content );

$tr = $dom->getElementsByTagName('tr');

for( $i = 1; $i <= $tr->length; $i++ ) {

 switch($i) {
  case 1:
   $id_team = $tr->item($i)->getElementsByTagName('b')->item(0)->nodeValue;
   break;
  case 2:
   $team_name = $tr->item($i)->getElementsByTagName('div')->item(0)->nodeValue;
   break;
  case 3:
   $id_manager = $tr->item($i)->getElementsByTagName('b')->item(0)->nodeValue;
   break;
  case 4:
   $manager_name = $tr->item($i)->getElementsByTagName('div')->item(0)->nodeValue;
   break;
  case 5:
   $flag = $tr->item($i)->getElementsByTagName('img')->item(0)->getAttribute('src');
   $flag = str_replace( array('images/flags/', '.gif'), '', $flag);
   break;
  case 6:
   $league = $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue;
   break;
  case 9:
   $coefficient = $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue;
   break;
  case 10:
   $fans = $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue;
   $fans = str_replace( array('%', ' '), '', $fans );
   list($fans_min, $fans) = explode('/', $fans);
   break;
  case 12:
   $created = $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue;
   break;
  case 13:
   $stadium = $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue;
   break;
  case 14:
   $stadum_capacity = str_replace(' ', '', $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue);
   break;
  case 15:
   $last_active = $tr->item($i)->getElementsByTagName('td')->item(1)->nodeValue;
   break;
 }

}

if(!isset($id_team) or !is_numeric($id_team)) {
 echo 0;
 exit;
}

$count = dibi::query('select count(`id_team`) from `team` where `id_team` = %i', $id_team)->fetchSingle();

if( $count == 0 ) {
 dibi::query('insert into `team`', array(
  'id_team' => $id_team,
  'name_team' => $team_name,
  'id_manager' => $id_manager,
  'name_manager' => $manager_name,
  'country' => $flag,
  'created%d' => $created
 ));
}

$count = dibi::query('select count(`id_team`) from `team_update` where `update` = %t and `id_team` = %i', lastConversion(), $id_team)->fetchSingle();

if( $count == 1 ) {
 dibi::query('update `team_update` set', array(
  'league' => $league,
  'coefficient' => $coefficient,
  'fans_min' => $fans_min,
  'fans' => $fans,
  'stadium' => $stadium,
  'stadium_capacity' => $stadum_capacity
 ), 'where `id_team` = %i and `update` = %d', $id_team, lastConversion());
} else {
 dibi::query('insert into `team_update`', array(
  'id_team' => $id_team,
  'update%d' => lastConversion(),
  'league' => $league,
  'coefficient' => $coefficient,
  'fans_min' => $fans_min,
  'fans' => $fans,
  'stadium' => $stadium,
  'stadium_capacity' => $stadum_capacity
 ));
}

echo 1;

/**/
?>