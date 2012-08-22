    <?php
    $stadium = dibi::query('
     select t.`stadium`, t.`stadium_capacity`,
     s.`tp`, s.`rp`
     from `team_update` t
     join `stadium_update` s using (`id_team`)
     where t.`id_team` = %i and s.`update` = %d and t.`update` = %d
     limit 1', $team->id_team, lastConversion(), lastConversion())->fetch();
    ?>
    <div class="content level_two">
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
     <table>
      <thead>
       <tr>
        <td>Zázemí</td>
        <td>Úroveň</td>
       </tr>
      </thead>
      <tbody>
       <tr>
        <td>Tréninkové prostory</td>
        <td><div class="stadium-level"><span class="level-<?php echo $stadium->tp; ?>"><?php echo $stadium->tp; ?></span></div></td>
       </tr>
       <tr>
        <td>Regenrační prostory</td>
        <td><div class="stadium-level"><span class="level-<?php echo $stadium->rp; ?>"><?php echo $stadium->rp; ?></span></div></td>
       </tr>
      </tbody>
     </table>
    </div>