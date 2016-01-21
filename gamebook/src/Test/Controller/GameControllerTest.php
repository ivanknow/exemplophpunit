<?php
$loader = require __DIR__ . '/../../../vendor/autoload.php';

use Gamebook\Entity\Game;
use Goutte\Client;
class GameTest extends PHPUnit_Framework_TestCase {
	
	/*
	 * use GuzzleHttp\Client;
	 * public function testIndex_HasUl() {
	 * $client = new Client();
	 * $response = $client->request('GET','http://localhost/workspace/cursoPHPUnit/gamebook/web/');
	 * $this->assertRegexp('/<ul>/',$response->getBody()->getContents());
	 * }
	 */
	public function testIndex_HasUl() {
		$client = new Client ();
		$response = $client->request ( 'GET', 'http://localhost/workspace/cursoPHPUnit/gamebook/web/' );
		$this->assertCount ( 6, $response->filter ( 'ul>li' ) );
	}
	public function testAddRating_withGet_HasEmptyForm() {
		$client = new Client ();
		$response = $client->request ( 'GET', 'http://localhost/workspace/cursoPHPUnit/gamebook/web/add-rating.php?game=1' );
		$this->assertCount ( 1, $response->filter ( 'form' ) );
		
		$this->assertEquals ( "", $response->filter ( 'form input[name=score]' )->attr ( "value" ) );
	}
	public function testAddRating_withPost_isRedirect() {
		/*
		 teste funcional de formulario
		 1 - abre URL
		 2 - inpeciona formulario
		 3 - manda os dados para a mesma url
		 4 - CHECA NO BANCO - SEM USAR A INFRA. DO CONTRARIO VC ESTA USANDO O SISTEMA PARA SE TESTAR
		 */
		$client = new GuzzleHttp\Client ();
		$response = $client->request ( 'POST', 'http://localhost/workspace/cursoPHPUnit/gamebook/web/add-rating.php?game=1', [ 
				'allow_redirects' => false,
				'form_params' => [ 
						'score' => 5 
				] 
		] );
		
		$this->assertEquals ( 302, $response->getStatusCode () );
		$this->assertEquals ( "index.php", $response->getHeaderLine ( 'Location' ) );
		
		$pdo = new \PDO ( "mysql:host=localhost;dbname=game", "root", null );
		$sta = $pdo->prepare ( 'SELECT * FROM rating' );
		$sta->execute ();
		$result = $sta->fetchAll ( PDO::FETCH_ASSOC );
		
		$this->assertCount ( 1, $result );
		$this->assertEquals ( [ 
				'user_id' => '1',
				'game_id' => 1,
				'score' => '5' 
		], $result [0] );
	}
}