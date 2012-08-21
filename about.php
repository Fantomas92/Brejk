<div class="content level_two">
 <h1>O aplikaci Brejk-Stats</h1>
 <p>
  Pokud chcete využívat aplikaci Brejk-Stats na vlastní počítači, je možnost stáhnout zdrojový kód na GitHubu (<a href="https://github.com/Goues/Brejk/" target="_blank">Odkaz</a>) a nainstalovat. V takovém případě máte zaručeno nesdílení dat o svém účtu s ostatními hráči, na který mnoho manažerů poukazuje. Zároveň výrazně snížíte zátěž této databáze.<br>
  Stejně tak můžete přes GitHub přispět k vývoji aplikace! :)
 </p>
 <p>
  Aplikace byla spuštěna dne <em>20. srpna 2012</em>.<br>
  Administrátorem Brejk-Stats je manažer <a href="http://www.brejk.cz/index.php?p=info_tym&tym=63171" target="_blank">Goues (XYZ White Tiger)</a>.<br>
  Veškeré dotazy, připomínky, doporučení, žádosti či oznámení chyb posílejte poštou na Brejku či na email goues.cz@googlemail.com.
 </p>
 <p>
  <strong>Malá statistika</strong>:
 </p>
 <ul>
  <li>od posledního přepočtu bylo aktualizováno
  <?php echo dibi::query('select count(`id_team`) from `team_update` where `update` = %d', lastConversion())->fetchSingle(); ?> týmů z celkových
  <?php echo dibi::query('select count(`id_team`) from `team`')->fetchSingle(); ?></li>
  <li>od posledního přepočtu bylo aktualizováno
  <?php echo dibi::query('select count(`id_player`) from `player_update` where `update` = %d', lastConversion())->fetchSingle(); ?> hráčů z celkových
  <?php echo dibi::query('select count(`id_player`) from `player`')->fetchSingle(); ?></li>
 </ul>
 <h2>Novinky</h2>
 <p>
  21. srpna<br>
  Byl vylepšen způsob ukládání dat, aplikace by měla zvládnout utáhnout až <del>300 týmů</del>, oprava, asi tak 100, budu to muset ještě zlepšit. Nejlepší by bylo koupit vlastní hosting, tady mám jen 100 MB.<br>
  Bylo přidáno <span class="green">stažení ligových zápasů daného týmu</span>. Ale ještě to <span class="red">není hezké</span>.<br>
  Přidáno <span class="green">zobrazení změny koeficientu a přízně fanoušků</span>.<br>
  Přidáno <span class="green">načítání TP a RP u stadionu</span>, úrovně se zobrazuzí i u detailu hráče.
 </p>
 <h2>Co už umí</h2>
 <p>Načíst základní informace o týmu a hráčích podle zadaného ID</p>
 <p>Zobrazobat historii hráčů a jejich tréninku <strong class="green">včetně úrovně TP a RP</strong> (ostatní zázemí brzy)</p>
 <p>Načíst ligové zápasy týmu v aktuální sezóně (částečná funkčnost)</p>
 <p><strong>Upozornění</strong>: Z důvodu nekonzistence dat během přepočtu se nová data stahují až po 23:00. Pokud tedy Brejk přepočet skončí před 23:00, uvidíte pouze neaktualizovaná data.</p>
 <h2>Co se chystá v nejbližší době</h2>
 <p>Zobrazení historie hráčů pomocí grafů</p>
 <p>Načtení stadionu, a to především zázemí pro ještě snadnější práci s historií tréninku</p>
 <p>Načtení zápasů pro zobrazení výkonu hráče v jednotlivých zápasech</p>
 <p>Naštení ligových tabulek, včetně jejich historie po jednotlivých kolech</p>
</div>