<?php
$loader = require __DIR__ . '/../vendor/autoload.php';

use Gamebook\Entity\Game;
use Gamebook\Repository\GameRepository;

$repo = new GameRepository();

$games = $repo->findByUserId(1);
?>
<ul>
<?php
foreach ($games as $game) {
?>
<li><?php echo $game->getTitle();?><br/>
<?php echo $game->getAvg();?><br/>
<img alt="" src="<?php echo $game->getImagePath();?>"> <br/>
</li>
<?php
}
?>

</ul>