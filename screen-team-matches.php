    <?php
    $matches = dibi::query('
     select m.`id_match`, m.`id_team_home`, m.`id_team_away`, m.`score_home`, m.`score_away`, m.`round`, m.`date`, m.`update`,
     th.`name_team` as team_home, ta.`name_team` as team_away
     from `match` m
     left join `team` th on m.`id_team_home` = th.`id_team`
     left join `team` ta on m.`id_team_away` = ta.`id_team`
     where (m.`id_team_home` = %i or m.`id_team_away` = %i)
     order by m.`id_match` desc
     limit 30', $team->id_team, $team->id_team)->fetchAll();
    ?>
    <div class="content level_three">
     <p>
      Tým<br>
      <a href="http://www.brejk.cz/index.php?p=info_tym&tym=<?php echo $team->id_team; ?>" target="_blank">
       <strong><?php echo $team->name_team .' ('. $team->id_team .')'; ?></strong>
      </a>
     </p>
     <p>
      Ligové zápasy<br>
     </p>
     <p>
      <small>
       <strong>Upozornění</strong>:<br>
       Nechci příliš zatěžovat brejk ani vlastní databázi, pokud místo názvu týmu vidíte jen jeho ID, znamená to, že tento tým ještě nebyl stažen do databáze Brejk-Stats. V této chvíli uvažuju, zda tak činit automaticky, či prozatím nechat zápasy v tomto stavu.<br>
       Ze stejného důvodu se u týmů nestahují automaticky zápasy, pokud tedy vidíte jen některé, znamená to, že do databáze byly přidány při načítání soupeře.
      </small>
     </p>
     <table>
      <thead>
       <tr>
        <td>Datum</td>
        <td>Kolo</td>
        <td></td>
        <td class="align-right">Domácí</td>
        <td></td>
        <td width="1"></td>
        <td></td>
        <td class="align-left">Hosté</td>
        <td></td>
        <td></td>
       </tr>
      </thead>
      <tbody>
       <?php
       foreach($matches as $match) :
       if($match->update == true) {
        if($match->id_team_home == $team->id_team) {
         if($match->score_home > $match->score_away) {
          $result = 'win';
         } elseif($match->score_home < $match->score_away) {
          $result = 'loss';
         } else {
          $result = 'draw';
         }
        } elseif($match->id_team_away == $team->id_team) {
         if($match->score_home > $match->score_away) {
          $result = 'loss';
         } elseif($match->score_home < $match->score_away) {
          $result = 'win';
         } else {
          $result = 'draw';
         }
        }
       } else {
        $result = '';
       }
       ?>
       <tr>
        <td>
         <?php
         if($match->update == true):
         ?>
         <a href="http://www.brejk.cz/index.php?p=zapas_zapas&zapas=<?php echo $match->id_match; ?>" target="_blank">
          <?php echo date('d. m. Y', strtotime($match->date)); ?>
         </a>
         <?php
         else:
          echo date('d. m. Y', strtotime($match->date));
         endif;
         ?>
        </td>
        <td><?php echo $match->round .'.'; ?></td>
        <td class="align-right">
         <small>
          <?php echo (isset($match->team_home) ? '<a href="screen.php?id_team='. $match->id_team_home .'">(Stats)</a>' : ''); ?>
          <a href="http://www.brejk.cz/index.php?p=info_tym&tym=<?php echo $match->id_team_home; ?>" target="_blank">(Brejk)</a>
         </small>
        </td>
        <td class="align-right"><?php echo (isset($match->team_home) ? $match->team_home : $match->id_team_home); ?></td>
        <td class="align-right <?php echo $result; ?>"><?php echo $match->score_home; ?></td>
        <td class="<?php echo $result; ?>">:</td>
        <td class="<?php echo $result; ?>"><?php echo $match->score_away; ?></td>
        <td><?php echo (isset($match->team_away) ? $match->team_away : $match->id_team_away); ?></td>
        <td>
         <small>
          <a href="http://www.brejk.cz/index.php?p=info_tym&tym=<?php echo $match->id_team_away; ?>" target="_blank">(Brejk)</a>
          <?php echo (isset($match->team_away) ? '<a href="screen.php?id_team='. $match->id_team_away .'">(Stats)</a>' : ''); ?>
         </small>
        </td>
        <td></td>
       </tr>
       <?php
       endforeach;
       ?>
      </tbody>
     </table>
    </div>