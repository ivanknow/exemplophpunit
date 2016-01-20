<?php
$loader = require __DIR__ . '/../../../vendor/autoload.php';

class UserTest extends PHPUnit_Framework_TestCase{

	public function testGenreCompatibility_With6And8_Returns7()
	{
		$r1 = $this->getMock('Rating',['getScore']);
		$r1->method('getScore')->willReturn(6);
		
		$r2 = $this->getMock('Rating',['getScore']);
		$r2->method('getScore')->willReturn(8);
		
		$user = $this->getMock('Gamebook\Entity\User',['findRatingsByGenre']);
		$user->method('findRatingsByGenre')->willReturn([$r1,$r2]);
		$this->assertEquals(7,$user->getGenreCompatibility('zombies'));
	}
	
	public function testRatingByGenre_With1ZombiesAnd1Shooters_ReturnsZombie()
	{
		$zombies = $this->getMock('Gamebook\Entity\Game',['getGenreCode']);
		$zombies->method('getGenreCode')->willReturn("zombies");
		
		$shooter = $this->getMock('Gamebook\Entity\Game',['getGenreCode']);
		$shooter->method('getGenreCode')->willReturn("shooter");
		
		$r1 = $this->getMock('Rating',['getGame','getScore']);
		$r1->method('getGame')->willReturn($zombies);
		$r1->method('getScore')->willReturn(7);
		
		
		$r2 = $this->getMock('Rating',['getGame','getScore']);
		$r2->method('getGame')->willReturn($shooter);
		$r2->method('getScore')->willReturn(7);
		
		$user = $this->getMock('Gamebook\Entity\User',['getRatings']);
		$user->method('getRatings')->willReturn([$r1,$r2]);
		$this->assertEquals(7,$user->getGenreCompatibility('zombies'));
		
		
		$ratings = $user->findRatingsByGenre('zombies');
		$this->assertCount(1,$ratings);
		foreach ($ratings as $r) {
			$this->assertEquals('zombies',$r->getGame()->getGenreCode());
		}
		
	}
}