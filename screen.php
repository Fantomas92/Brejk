<?php
require 'init.php';
if(!isset($_GET['id_team'])) {
 header('Location: index.php');
 exit;
}
?>
<!DOCTYPE html>
<html class="no-js">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/main.css">
 </head>
 <body>
  <div id="body">
   <?php
   $team = dibi::query('select `id_team`, `id_manager`, `name_team`, `name_manager`, `country`, `created` from `team` where `id_team` = %i', $_GET['id_team'])->fetch();
   if(!isset($team->id_team)) {
    echo '<p>Neplatné ID týmu, pokud jsi zkopíroval ID týmu do adresy, je potřeba přejít na <a href="index.php">úvodní stránku</a> a využít zadávacího políčka.</p></div></body></html>';
    exit;
   }
   ?>
   <nav class="top_level">
    <p>
     Tým<br>
     <a href="http://www.brejk.cz/index.php?p=info_tym&tym=<?php echo $team->id_team; ?>" target="_blank">
      <strong><?php echo $team->name_team .' ('. $team->id_team .')'; ?></strong>
     </a>
     <img src="http://www.brejk.cz/images/flags/<?php echo $team->country; ?>">
    </p>
    <p>
     Manažer<br>
     <strong><?php echo $team->name_manager .' ('. $team->id_manager .')'; ?></strong>
    </p>
    <ul>
     <li>
      <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=team" <?php if(isset($_GET['p']) && $_GET['p'] == 'team') echo 'class="active"'; ?>>Tým</a>
     </li>
     <li>
      <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=players" <?php if(isset($_GET['p']) && $_GET['p'] == 'players') echo 'class="active"'; ?>>Hráči</a>
     </li>
    </ul>
   </nav>
   <?php
   if(isset($_GET['p']) && $_GET['p'] == 'team') {
    include 'screen-team.php';
   } else if(isset($_GET['p']) && $_GET['p'] == 'players') {
    include 'screen-players.php';
   } else {
    include 'about.php';
   }
   ?>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
  <!-- Google Analytics >
  <script>
   var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
   (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
   g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
   s.parentNode.insertBefore(g,s)}(document,'script'));
  </script-->
 </body>
</html>