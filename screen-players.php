   <?php
   $players = dibi::query('
    select p.`name`, p.`id_player`
    from `player_update` pu
    join `player` p using(`id_player`)
    where pu.`id_team` = %i and pu.`update` = %d
    order by p.`name` asc', $team->id_team, lastConversion())->fetchAll();
   ?>
   <nav class="second_level">
    <ul>
     <li>
      <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=players" <?php if(!isset($_GET['s'])) echo 'class="active"'; ?>>Přehled (<?php echo count($players);?>)</a>
     </li>
     <?php
     foreach($players as $player) :
     ?>
     <li>
      <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=players&s=<?php echo $player->id_player; ?>" <?php if(isset($_GET['s']) && $_GET['s'] == $player->id_player) echo 'class="active"'; ?>><?php echo $player->name; ?></a>
     </li>
     <?php
     endforeach;
     ?>
    </ul>
   </nav>
   <?php
   if(!isset($_GET['s'])) {
    include 'screen-players-overview.php';
   } else if(is_numeric($_GET['s'])) {
    include 'screen-players-detail.php';
   }
   ?>