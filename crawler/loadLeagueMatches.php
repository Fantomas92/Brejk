<?php

include '../init.php';

if(!isset($_GET['id_team']) or !is_numeric($_GET['id_team'])) {
 exit;
}

$id_team = $_GET['id_team'];

$curl = new cURL('http://www.brejk.cz/index.php?p=info_zapasy&tym='. $id_team .'&tz=1&dn=9');
$content = $curl->execute();
$curl->__destruct();

$content = iconv('windows-1250', 'utf-8', $content);
$content = preg_replace('/<script[^>]*>(.*)<\/script>/ismU', '', $content);

preg_match('/<table[^>]*>.*<\/table>/ismU', $content, $table);

$content = $table[0];

$dom = new SmartDOMDocument();
$dom->loadHTML( $content );

$table = $dom->getElementsByTagName('table')->item(1);

$tr = $table->getElementsByTagName('tr');

$match = $ids = array();

for( $i = 0; $i < $tr->length; $i += 2 ) {

 $inv = 30 - $i/2;

 $match['date%d'] = strtotime( preg_replace('/[^0-9.]/', '', $tr->item($i)->getElementsByTagName('td')->item(0)->nodeValue) );

 $td = $tr->item($i + 1)->getElementsByTagName('td');

 for( $ii = 0; $ii < $td->length; $ii++ ) {

  $item = $td->item($ii);

  switch($ii) {

   case 0:
    $match['update'] = $item->getElementsByTagName('img')->item(0)->getAttribute('src');
    $match['update'] = strlen( preg_replace('/.*stav(L|W|D)?.*/i', '$1', $match['update']) );
    break;
   case 1:
    $match['round'] = intval($item->nodeValue);
    break;
   case 2:
    $links = $item->getElementsByTagName('a');
    $link = $links->item(0)->getAttribute('href');
    if($links->length > 1)
     $link2 = $links->item(1)->getAttribute('href');
    else
     $link2 = $link;
    $match['id_match'] = preg_replace('/^.*zapas=([0-9]*)$/i', '$1', $link2);
    $match['id_team_home'] = preg_replace('/^.*tym=([0-9]*).*$/i', '$1', $link);
    break;
   case 3:
    $match['score_home'] = intval($item->nodeValue);
    break;
   case 4:
    $match['score_away'] = intval($item->nodeValue);
    break;
   case 5:
    $match['id_team_away'] = $item->getElementsByTagName('a')->item(0)->getAttribute('href');
    $match['id_team_away'] = preg_replace('/^.*tym=([0-9]*).*$/i', '$1', $match['id_team_away']);
    break;

  }

 }

 $matches[$match['id_match']] = $match;
 unset($match);

}

foreach($matches as $id_match => $entry) { $ids[] = $id_match; }

$exist = dibi::query('select `id_match` from `match` where `id_match` in %in and (`date` > now() or `update` = true)', $ids)->fetchAll();

foreach($exist as $row) { unset($matches[$row->id_match]); }

foreach($matches as $match) {

 if($match['update'] == true) {

  $curl = new cURL('http://archiv.brejk.cz/zapasy/'. date('Y/m-d', $match['date%d']) .'/zapas'. $match['id_match'] .'.html');
  $content = $curl->execute();
  $curl->__destruct();

  $dom = new SmartDOMDocument();
  $dom->loadHTML( $content );

  $links = $dom->getElementsByTagName('a');

  $match['id_team_home'] = preg_replace( '/^.*tym=([0-9]*)$/i', '$1', $links->item(0)->getAttribute('href') );
  $match['id_team_away'] = preg_replace( '/^.*tym=([0-9]*)$/i', '$1', $links->item(1)->getAttribute('href') );


 }

 dibi::query('insert into `match`', $match, 'on duplicate key update %a', array(
  'score_home' => $match['score_home'],
  'score_away' => $match['score_away'],
  'update' => $match['update']
 ));

}

echo 1;

/**/
?>