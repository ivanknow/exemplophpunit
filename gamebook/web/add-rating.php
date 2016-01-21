<?php
$loader = require __DIR__ . '/../vendor/autoload.php';

use Gamebook\Entity\Game;
use Gamebook\Repository\GameRepository;

$repo = new GameRepository();

$game = $repo->findById($_GET['game']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$repo->saveGameRating($_GET['game'], 1, $_POST['score']);
	header("Location: index.php");
	exit;
}
?>
<h1><?php echo $game->getTitle();?></h1>
<form method="POST" >
	<input type="number" name="score" min="1" max="5"/>
	<input type="submit" value="Save">
</form>