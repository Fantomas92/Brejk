    <?php
    $team_d = dibi::query('select * from `team_update` where `id_team` = %i order by `id_team_update` desc limit 1', $team->id_team)->fetch();
    $team_last = dibi::query('select `coefficient`, `fans` from `team_update` where `id_team` = %i order by `id_team_update` desc limit 1, 1', $team->id_team)->fetch();
    if( isset($team_last->coefficient) ) {
     $change_coefficient = $team_d->coefficient - $team_last->coefficient;
     $change_fans = $team_d->fans - $team_last->fans;
    } else {
     $change_coefficient = 0;
     $change_fans = 0;
    }
    ?>
    <div class="content level_three">
     <p>
      Tým<br>
      <a href="http://www.brejk.cz/index.php?p=info_tym&tym=<?php echo $team->id_team; ?>" target="_blank">
       <strong><?php echo $team->name_team .' ('. $team->id_team .')'; ?></strong>
      </a>
     </p>
     <p>
      Manažer<br>
      <strong><?php echo $team->name_manager .' ('. $team->id_manager .')'; ?></strong>
     </p>
     <p>
      Liga<br>
      <strong><?php echo $team_d->league; ?></strong>
      <small>(Zde bude odkaz na ligovou tabulku)</small>
     </p>
     <p>
      Koeficient<br>
      <strong><?php echo $team_d->coefficient; ?></strong>
      <small class="<?php echo ($change_coefficient >= 0 ? 'green' : 'red'); ?>">( <?php echo $change_coefficient; ?> )</small>
     </p>
     <p>
      Přízeň fanoušků<br>
      <strong><?php echo $team_d->fans_min .'% / '. round($team_d->fans, 1) .'%'; ?></strong>
      <small class="<?php echo ($change_fans >= 0 ? 'green' : 'red');  ?>">( <?php echo $change_fans; ?> )</small>
     </p>
     <p>
      Stadion<br>
      <strong><?php echo $team_d->stadium .' ('. $team_d->stadium_capacity .')'; ?></strong>
      <small>(Zde bude odkaz na stadion)</small>
     </p>
     <p>
      Na Brejku od<br>
      <strong><?php echo date('j. n. Y', strtotime($team->created)); ?></strong>
     </p>
    </div>