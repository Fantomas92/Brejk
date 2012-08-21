    <?php
    $stadium = dibi::query('
     select t.`stadium`, t.`stadium_capacity`,
     s.`tp`, s.`rp`
     from `team_update` t
     join `stadium_update` s using (`id_team`)
     where t.`id_team` = %i and s.`update` = %d and t.`update` = %d
     limit 1', $team->id_team, lastConversion(), lastConversion())->fetch();
    ?>
    <div class="content level_three">
     <p>
      Tým<br>
      <a href="http://www.brejk.cz/index.php?p=info_tym&tym=<?php echo $team->id_team; ?>" target="_blank">
       <strong><?php echo $team->name_team .' ('. $team->id_team .')'; ?></strong>
      </a>
     </p>
     <p>
      Stadion<br>
      <strong><?php echo $stadium->stadium .' ('. $stadium->stadium_capacity .')'; ?></strong>
     </p>
     <p>
      Tréninkové prostory<br>
      <strong><?php echo $stadium->tp; ?></strong>
     </p>
     <p>
      Regenrační prostory<br>
      <strong><?php echo $stadium->rp; ?></strong>
     </p>
    </div>