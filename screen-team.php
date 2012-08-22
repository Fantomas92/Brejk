   <nav class="second_level">
    <ul>
     <li>
      <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=team" <?php if(!isset($_GET['s'])) echo 'class="active"'; ?>>Přehled</a>
     </li>
     <li>
      <small>(Ligová tabulka)</small>
     </li>
     <li>
      <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=team&s=matches" <?php if(isset($_GET['s']) && $_GET['s'] == 'matches') echo 'class="active"'; ?>>Ligové zápasy</a>
     </li>
    </ul>
   </nav>
   <?php
   if(!isset($_GET['s'])) {
    include 'screen-team-overview.php';
   } elseif(isset($_GET['s']) && $_GET['s'] == 'matches') {
    include 'screen-team-matches.php';
   }
   ?>