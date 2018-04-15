<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\Coin;
use \CoffeeMachine\CoffeeMachineException;

class CoinTest extends TestCase {

	public function testGetState() {
		$coin = new Coin(1, 2);

		$state = $coin->getState();

		$this->assertEquals($state['id'], $coin->id());
		$this->assertEquals($state['name'], $coin->name());
		$this->assertEquals($state['count'], $coin->count());
		$this->assertEquals($state['value'], $coin->value());

		return true;
	}

	public function testSave() {
		$coin = new Coin(1, 2);

		$save = $coin->save();

		$this->assertEquals($save['id'], $coin->id());
		$this->assertEquals($save['name'], $coin->name());
		$this->assertEquals($save['count'], $coin->count());
		$this->assertEquals($save['value'], $coin->value());

		return true;
	}

	public function testGetters() {
		$coin = new Coin(1, 2);

		$this->assertEquals('coin_1', $coin->id());
		$this->assertEquals('1р', $coin->name());
		$this->assertEquals(2, $coin->count());
		$this->assertEquals(1, $coin->value());

		return true;
	}

	public function testGet() {
		$coin = new Coin(1, 3);

		$coin2 = $coin->getOne();
		$this->assertEquals($coin->id(), $coin2->id());
		$this->assertEquals($coin->value(), $coin2->value());
		$this->assertEquals(1, $coin2->count());

		$coin3 = $coin->get(2);
		$this->assertEquals($coin->id(), $coin3->id());
		$this->assertEquals($coin->value(), $coin3->value());
		$this->assertEquals(2, $coin3->count());

		try {
			$coin4 = $coin->get(1);
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}

		return true;
	}

	public function testPush() {
		$coin = new Coin(1, 1);

		$coin->pushOne();
		$this->assertEquals(2, $coin->count());

		$coin->push(2);
		$this->assertEquals(4, $coin->count());

		return true;
	}

	public function testSum() {
		$coin = new Coin(3, 4);
		$this->assertEquals(12, $coin->sum());

		$coin = new Coin(0, 1);
		$this->assertEquals(0, $coin->sum());

		$coin = new Coin(10, 10);
		$this->assertEquals(100, $coin->sum());

		return true;
	}

}
