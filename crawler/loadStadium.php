<?php

include '../init.php';

if(!isset($_GET['id_team']) or !is_numeric($_GET['id_team'])) {
 exit;
}

$id_team = $_GET['id_team'];

if( dibi::query('select count(`id_team`) from `stadium_update` where `id_team` = %i and `update` = %d', $id_team, lastConversion())->fetchSingle() > 0 ) {
 echo 1;
 exit;
}

$curl = new cURL('http://www.brejk.cz/index.php?p=info_stadion&tym='. $id_team);
$content = $curl->execute();
$curl->__destruct();

$content = iconv('windows-1250', 'utf-8', $content);
$content = preg_replace('/<script[^>]*>(.*)<\/script>/ismU', '', $content);

preg_match('/<table[^>]*>.*<\/table>/ism', $content, $table);

$content = $table[0];

$dom = new SmartDOMDocument();
$dom->loadHTML( $content );

$tr = $dom->getElementsByTagName('table')->item(1)->getElementsByTagName('tr');

for( $i = 1; $i < 3; $i++ ) {
 $string = $dom->saveHTML($tr->item($i)->getElementsByTagName('td')->item(1));
 $level[$i] = substr_count(htmlspecialchars($string), '_aktiv');
}

dibi::query('insert into `stadium_update`', array(
 'update%d' => lastConversion(),
 'id_team' => $id_team,
 'tp' => $level[1],
 'rp' => $level[2],
));

echo 1;

/**/
?>