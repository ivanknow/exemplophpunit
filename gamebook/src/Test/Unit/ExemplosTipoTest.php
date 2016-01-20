<?php
require __DIR__ . "\..\..\Entity\Game.php";


class GameTest extends PHPUnit_Framework_TestCase{

	public function testExemplo() {
		//$this->assertEquals('/images/game.jpg','sss',"Mensagem de erro 2");
		$this->assertTrue(2<5,"Mensagem de erro 3");
	}
	/**
	 * @expectedException Exception
	 */
	public function testExemplo2() {
		throw new Exception("deu ruim");
	}
	/**
	 * @dataProvider data
	 */
	public function testRepeat($real,$expected){
		echo "opa";
		$this->assertEquals($expected,$real>5);
	}
	
	public function data(){
		$returned = [];
		$returned[] = [6,true];
		$returned[] = [2,false];
		return $returned;
	}

}