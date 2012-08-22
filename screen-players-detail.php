    <?php
    $player = dibi::query('
     select `name`, `id_player`, `country`, `position`
     from `player`
     where `id_player` = %i
     limit 1', $_GET['s'])->fetch();
    $stats = dibi::query('
     select p.*, s.`tp`, s.`rp`
     from `player_update` p
     left join `stadium_update` s on (s.`update` = p.`update` and s.`id_team` = p.`id_team`)
     where p.`id_player` = %i
     order by p.`id_player_update` desc
     limit 60', $_GET['s'])->fetchAll();
    ?>
    <div class="content level_three">
     <p>
      Hráč<br>
      <img src="http://www.brejk.cz/images/flags/<?php echo $player->country; ?>">
      <a href="http://www.brejk.cz/index.php?p=info_hrac&hrac=<?php echo $player->id_player; ?>&tym=<?php echo $team->id_team; ?>" target="_blank">
       <strong><?php echo $player->name .' ('. $player->id_player .')'; ?></strong>
      </a>
     </p>
     <p>
      Pozice<br>
      <strong><?php echo $player->position; ?></strong>
     </p>
     <p>Historie</p>
     <p>
      <small>Změny:
      <span class="difference1">1</span>
      <span class="difference2">2</span>
      <span class="difference3">3</span>
      <span class="difference4">4</span>
      <span class="difference5">5</span></small>
     </p>
     <table>
      <thead>
       <tr>
        <td>Věk</td>
        <td>TP</td>
        <td>RP</td>
        <td>G</td>
        <td>O</td>
        <td>U</td>
        <td>S</td>
        <td>T</td>
        <td>H</td>
        <td>A</td>
        <td>P</td>
        <td>K</td>
        <td>Gr</td>
        <td>Ga</td>
        <td>Sd</td>
        <td>Sz</td>
        <td>Kr</td>
        <td>Kv</td>
        <td>Z</td>
        <td>Ea</td>
        <td>Ec</td>
       </tr>
      </thead>
      <tbody>
       <?php
       for($i = 0; $i < count($stats); $i++) :
        if(isset($stats[$i + 1])) {
        $difference[0] = $stats[$i]->age - $stats[$i + 1]->age;
        $difference[1] = $stats[$i]->g - $stats[$i + 1]->g;
        $difference[2] = $stats[$i]->o - $stats[$i + 1]->o;
        $difference[3] = $stats[$i]->u - $stats[$i + 1]->u;
        $difference[4] = $stats[$i]->s - $stats[$i + 1]->s;
        $difference[5] = $stats[$i]->t - $stats[$i + 1]->t;
        $difference[6] = $stats[$i]->h - $stats[$i + 1]->h;
        $difference[7] = $stats[$i]->a - $stats[$i + 1]->a;
        $difference[8] = $stats[$i]->p - $stats[$i + 1]->p;
        $difference[9] = $stats[$i]->k - $stats[$i + 1]->k;
        $difference[10] = $stats[$i]->gr - $stats[$i + 1]->gr;
        $difference[11] = $stats[$i]->ga - $stats[$i + 1]->ga;
        $difference[12] = $stats[$i]->sd - $stats[$i + 1]->sd;
        $difference[13] = $stats[$i]->sz - $stats[$i + 1]->sz;
        $difference[14] = $stats[$i]->kr - $stats[$i + 1]->kr;
        $difference[15] = $stats[$i]->kv - $stats[$i + 1]->kv;
        $difference[16] = $stats[$i]->z - $stats[$i + 1]->z;
        $difference[17] = $stats[$i]->ec - $stats[$i + 1]->ec;
        } else {
         $difference = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        }
       ?>
       <tr>
        <td class="difference<?php echo $difference[0]; ?>"><?php echo $stats[$i]->age; ?></td>
        <td><?php echo $stats[$i]->tp; ?></td>
        <td><?php echo $stats[$i]->rp; ?></td>
        <td class="difference<?php echo $difference[1]; ?>"><?php echo $stats[$i]->g; ?></td>
        <td class="difference<?php echo $difference[2]; ?>"><?php echo $stats[$i]->o; ?></td>
        <td class="difference<?php echo $difference[3]; ?>"><?php echo $stats[$i]->u; ?></td>
        <td class="difference<?php echo $difference[4]; ?>"><?php echo $stats[$i]->s; ?></td>
        <td class="difference<?php echo $difference[5]; ?>"><?php echo $stats[$i]->t; ?></td>
        <td class="difference<?php echo $difference[6]; ?>"><?php echo $stats[$i]->h; ?></td>
        <td class="difference<?php echo $difference[7]; ?>"><?php echo $stats[$i]->a; ?></td>
        <td class="difference<?php echo $difference[8]; ?>"><?php echo $stats[$i]->p; ?></td>
        <td class="difference<?php echo $difference[9]; ?>"><?php echo $stats[$i]->k; ?></td>
        <td class="difference<?php echo $difference[0]; ?>"><?php echo $stats[$i]->gr; ?></td>
        <td class="difference<?php echo $difference[11]; ?>"><?php echo $stats[$i]->ga; ?></td>
        <td class="difference<?php echo $difference[12]; ?>"><?php echo $stats[$i]->sd; ?></td>
        <td class="difference<?php echo $difference[13]; ?>"><?php echo $stats[$i]->sz; ?></td>
        <td class="difference<?php echo $difference[14]; ?>"><?php echo $stats[$i]->kr; ?></td>
        <td class="difference<?php echo $difference[15]; ?>"><?php echo $stats[$i]->kv; ?></td>
        <td class="difference<?php echo $difference[16]; ?>"><?php echo $stats[$i]->z; ?></td>
        <td><?php echo $stats[$i]->ea; ?></td>
        <td class="difference<?php echo $difference[17]; ?>"><?php echo $stats[$i]->ec; ?></td>
       </tr>
       <?php
       endfor;
       ?>
      </tbody>
     </table>
    </div>