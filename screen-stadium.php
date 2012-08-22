    <?php
    $stadium = dibi::query('
     select t.`stadium`, t.`stadium_capacity`,
     s.`tp`, s.`rp`, s.`mo`, s.`pd`, s.`ssv`, s.`os`, s.`vo`, s.`khp`
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
       <tr>
        <td>Marketinkové oddělení</td>
        <td><div class="stadium-level"><span class="level-<?php echo $stadium->mo; ?>"><?php echo $stadium->mo; ?></span></div></td>
       </tr>
       <tr>
        <td>Příprava dorostu</td>
        <td><div class="stadium-level"><span class="level-max-5 level-<?php echo $stadium->pd; ?>"><?php echo $stadium->pd; ?></span></div></td>
       </tr>
       <tr>
        <td>Středisko pro styk s veřejností</td>
        <td><div class="stadium-level"><span class="level-max-5 level-<?php echo $stadium->ssv; ?>"><?php echo $stadium->ssv; ?></span></div></td>
       </tr>
       <tr>
        <td>Osvětlení stadionu</td>
        <td><div class="stadium-level"><span class="level-max-2 level-<?php echo $stadium->os; ?>"><?php echo $stadium->os; ?></span></div></td>
       </tr>
       <tr>
        <td>Velkoplošná obrazovka</td>
        <td><div class="stadium-level"><span class="level-max-1 level-<?php echo $stadium->vo; ?>"><?php echo $stadium->vo; ?></span></div></td>
       </tr>
       <tr>
        <td>Kvalita herní plochy</td>
        <td><div class="stadium-level"><span class="level-max-3 level-<?php echo $stadium->khp; ?>"><?php echo $stadium->khp; ?></span></div></td>
       </tr>
      </tbody>
     </table>
    </div>