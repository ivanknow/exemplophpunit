<?php
$loader = require __DIR__ . '/../../../vendor/autoload.php';

use Gamebook\Entity\Game;
use Goutte\Client;
class RatingSubmissionTest extends PHPUnit_Extensions_Selenium2TestCase {
	//inicia a cada teste
	public function setUp(){
		$this->setHost('localhost');
		$this->setPort(4444);
		$this->setBrowserUrl("http://localhost/workspace/cursoPHPUnit/gamebook/web/");
		$this->setBrowser("firefox");
	}
	
	//desliga o browser ao final
	public function tearDown() {
		$this->stop();
	}
	
	public function testHomePage() {
		$this->url("/");//abre a raiz
		$content = $this->byCssSelector('li span')->text();
		$this->assertEquals("Game .0",$content);
	}
	
	public function testRatingSumbition() {
		$this->timeouts()->implicitWait(2000);
		$this->url("/");//abre a raiz
		$this->byLinkText("Rate")->click();
		
		$form = $this->byTag('form');
		$form->byName('score')->value(5);
		$form->submit();
		
		$this->assertEquals("http://localhost/workspace/cursoPHPUnit/gamebook/web/", $this->getBrowserUrl());
		
	}
}