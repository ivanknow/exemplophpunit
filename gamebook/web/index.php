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
<li><span><?php echo $game->getTitle();?></span><br/>
<a href="add-rating.php?game=<?php echo  $game->getId()+1; ?>">Rate</a>
<?php echo $game->getAvg();?><br/>
<img alt="" src="<?php echo $game->getImagePath();?>"> <br/>
</li>
<?php
}
?>

</ul>