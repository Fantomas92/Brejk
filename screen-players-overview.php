    <?php
    $players = dibi::query('
     select p.`name`, p.`id_player`, p.`country`, p.`position`,
     pu.`age` as age, pu.`g` as g, pu.`o` as o, pu.`u` as u, pu.`s` as s,
     pu.`t` as t, pu.`h` as h, pu.`a` as a, pu.`p` as p, pu.`k` as k,
     pu.`gr` as gr, pu.`ga` as ga, pu.`sd` as sd, pu.`sz` as sz, pu.`kr` as kr,
     pu.`kv` as kv, pu.`z` as z, pu.`ea` as ea, pu.`ec` as ec,
     puy.`age` as yage, puy.`g` as yg, puy.`o` as yo, puy.`u` as yu, puy.`s` as ys,
     puy.`t` as yt, puy.`h` as yh, puy.`a` as ya, puy.`p` as yp, puy.`k` as yk,
     puy.`gr` as ygr, puy.`ga` as yga, puy.`sd` as ysd, puy.`sz` as ysz, puy.`kr` as ykr,
     puy.`kv` as ykv, puy.`z` as yz, puy.`ea` as yea, puy.`ec` as yec
     from `player` as p
     join `player_update` as pu using (`id_player`)
     LEFT JOIN  `player_update` AS puy ON (puy.`id_player` = p.`id_player` and puy.`update` = %t)
     where p.`id_team` = %i and pu.`update` = %t
     order by p.`name` asc', lastConversion() - 60*60*24, $team->id_team, lastConversion())->fetchAll();
    ?>
    <div class="content level_three">
     <p>
      Změny:
      <span class="difference1">1</span>
      <span class="difference2">2</span>
      <span class="difference3">3</span>
      <span class="difference4">4</span>
      <span class="difference5">5</span>
     </p>
     <table>
      <thead>
       <tr>
        <td>Jméno</td>
        <td class="small">Věk</td>
        <td class="small">Ps</td>
        <td class="small">G</td>
        <td class="small">O</td>
        <td class="small">U</td>
        <td class="small">S</td>
        <td class="small">T</td>
        <td class="small">H</td>
        <td class="small">A</td>
        <td class="small">P</td>
        <td class="small">K</td>
        <td class="small">Gr</td>
        <td class="small">Ga</td>
        <td class="small">Sd</td>
        <td class="small">Sz</td>
        <td class="small">Kr</td>
        <td class="small">Kv</td>
        <td class="small">Z</td>
        <td class="small">Ea</td>
        <td class="small">Ec</td>
       </tr>
      </thead>
      <tbody>
       <?php
       foreach($players as $player) :
        if(isset($player['yage'])) {
         $difference[0] = $player->age - $player->yage;
         $difference[1] = $player->g - $player->yg;
         $difference[2] = $player->o - $player->yo;
         $difference[3] = $player->u - $player->yu;
         $difference[4] = $player->s - $player->ys;
         $difference[5] = $player->t - $player->yt;
         $difference[6] = $player->h - $player->yh;
         $difference[7] = $player->a - $player->ya;
         $difference[8] = $player->p - $player->yp;
         $difference[9] = $player->k - $player->yk;
         $difference[10] = $player->gr - $player->ygr;
         $difference[11] = $player->ga - $player->yga;
         $difference[12] = $player->sd - $player->ysd;
         $difference[13] = $player->sz - $player->ysz;
         $difference[14] = $player->kr - $player->ykr;
         $difference[15] = $player->kv - $player->ykv;
         $difference[16] = $player->z - $player->yz;
         $difference[17] = $player->ec - $player->yec;
         } else {
          $difference = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
         }
       ?>
       <tr>
        <td>
         <img src="http://www.brejk.cz/images/flags/<?php echo $player->country; ?>">
         <a href="screen.php?id_team=<?php echo $team->id_team; ?>&p=players&s=<?php echo $player->id_player; ?>">
          <?php echo $player->name; ?>
         </a>
        </td>
        <td class="small difference<?php echo $difference[0]; ?>"><?php echo $player->age; ?></td>
        <td class="small"><?php echo $player->position; ?></td>
        <td class="small difference<?php echo $difference[1]; ?>"><?php echo $player->g; ?></td>
        <td class="small difference<?php echo $difference[2]; ?>"><?php echo $player->o; ?></td>
        <td class="small difference<?php echo $difference[3]; ?>"><?php echo $player->u; ?></td>
        <td class="small difference<?php echo $difference[4]; ?>"><?php echo $player->s; ?></td>
        <td class="small difference<?php echo $difference[5]; ?>"><?php echo $player->t; ?></td>
        <td class="small difference<?php echo $difference[6]; ?>"><?php echo $player->h; ?></td>
        <td class="small difference<?php echo $difference[7]; ?>"><?php echo $player->a; ?></td>
        <td class="small difference<?php echo $difference[8]; ?>"><?php echo $player->p; ?></td>
        <td class="small difference<?php echo $difference[9]; ?>"><?php echo $player->k; ?></td>
        <td class="small difference<?php echo $difference[0]; ?>"><?php echo $player->gr; ?></td>
        <td class="small difference<?php echo $difference[11]; ?>"><?php echo $player->ga; ?></td>
        <td class="small difference<?php echo $difference[12]; ?>"><?php echo $player->sd; ?></td>
        <td class="small difference<?php echo $difference[13]; ?>"><?php echo $player->sz; ?></td>
        <td class="small difference<?php echo $difference[14]; ?>"><?php echo $player->kr; ?></td>
        <td class="small difference<?php echo $difference[15]; ?>"><?php echo $player->kv; ?></td>
        <td class="small difference<?php echo $difference[16]; ?>"><?php echo $player->z; ?></td>
        <td class="small"><?php echo $player->ea; ?></td>
        <td class="small difference<?php echo $difference[17]; ?>"><?php echo $player->ec; ?></td>
       </tr>
       <?php
       endforeach;
       ?>
      </tbody>
     </table>
    </div>