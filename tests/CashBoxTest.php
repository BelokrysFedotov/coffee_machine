<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\CashBox;
use \CoffeeMachine\CoffeeMachineException;

class CashBoxTest extends TestCase {

	/**
	 * @var CashBox
	 */
	private $cashBox;

	protected function setUp() {
		$this->cashBox = new CashBox(new \CoffeeMachine\ChangeStrategy(), [
			new \CoffeeMachine\Coin(1, 10),
			new \CoffeeMachine\Coin(2, 1),
			new \CoffeeMachine\Coin(5, 0),
			new \CoffeeMachine\Coin(10, 4)
		]);
	}

	public function testGetState() {
		$state = $this->cashBox->getState();

		$this->assertEquals(52, $state['sum']);
		$this->assertCount(4, $state['items']);

		return true;
	}

	public function testSave() {
		$save = $this->cashBox->save();

		$this->assertCount(4, $save['items']);

		return true;
	}

	public function testSum() {
		$sum = $this->cashBox->sum();

		$this->assertEquals(52, $sum);

		return true;
	}

	public function testValues() {
		$values = $this->cashBox->values();

		$this->assertEquals(1, $values['coin_1']);
		$this->assertEquals(2, $values['coin_2']);
		$this->assertEquals(5, $values['coin_5']);
		$this->assertEquals(10, $values['coin_10']);

		return true;
	}

	public function testGetOne() {
		$coin = $this->cashBox->getOne('coin_2');

		$this->assertEquals('coin_2', $coin->id());
		$this->assertEquals(1, $coin->count());

		try {
			$coin = $this->cashBox->getOne('coin_2');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}

	}

	public function testPushItem() {
		$coin = new \CoffeeMachine\Coin(5,2);
		$this->cashBox->pushItem($coin);
		$this->assertEquals(62, $this->cashBox->sum());
		$coin = $this->cashBox->getOne('coin_5');
		$this->assertEquals(1, $coin->count());
		$coin = $this->cashBox->getOne('coin_5');
		$this->assertEquals(1, $coin->count());

		try {
			$coin = $this->cashBox->getOne('coin_5');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}
	}

	public function testPushOne() {
		$this->cashBox->pushOne('coin_5');
		$this->assertEquals(57, $this->cashBox->sum());
		$coin = $this->cashBox->getOne('coin_5');
		$this->assertEquals(1, $coin->count());

		try {
			$coin = $this->cashBox->getOne('coin_5');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}
	}

	public function testGetChange() {
		$coins = $this->cashBox->getChange(20);
		$this->assertEquals(32, $this->cashBox->sum());

		$coins = $this->cashBox->getChange(20);
		$this->assertEquals(12, $this->cashBox->sum());

		try {
			$coins = $this->cashBox->getChange(20);
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}

	}

}
