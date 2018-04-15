<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\CoffeeMachine;
use \CoffeeMachine\CoffeeMachineException;

class CoffeeMachineTest extends TestCase {

	/**
	 * @var CoffeeMachine
	 */
	private $coffeeMachine;

	protected function setUp() {
		$this->coffeeMachine = \CoffeeMachine\Factory::getCoffeeMachine([
			'balance' => 3,
			'storage' => [
				'items' => [
					[
						'id'    => 'product_1',
						'name'  => 'Чай',
						'count' => 10,
						'price' => 13
					],
					[
						'id'    => 'product_2',
						'name'  => 'Кофе',
						'count' => 0,
						'price' => 18
					],
				]
			],
			'cashBox' => [
				'items' => [
					[
						'value' => 1,
						'count' => 10
					],
					[
						'value' => 2,
						'count' => 5
					]
				]
			],
		]);
	}

	public function testGetState() {
		$state = $this->coffeeMachine->getState();

		$this->assertTrue(array_key_exists('cashBox', $state));
		$this->assertTrue(array_key_exists('storage', $state));
		$this->assertEquals(3, $state['balance']);

		return true;
	}

	public function testSave() {
		$state = $this->coffeeMachine->save();

		$this->assertTrue(array_key_exists('cashBox', $state));
		$this->assertTrue(array_key_exists('storage', $state));
		$this->assertEquals(3, $state['balance']);

		return true;
	}

	public function testBalance() {
		$balance = $this->coffeeMachine->balance();

		$this->assertEquals(3, $balance);

		return true;
	}

	public function testPush() {
		$this->coffeeMachine->push(new \CoffeeMachine\Coin(2, 3));
		$balance = $this->coffeeMachine->balance();
		$this->assertEquals(9, $balance);

		try {
			$this->coffeeMachine->push(new \CoffeeMachine\Coin(3, 3));
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		return true;
	}

	public function testBuy() {

		try {
			$this->coffeeMachine->buy('product_1');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		$this->coffeeMachine->push(new \CoffeeMachine\Coin(2, 5));
		$balance = $this->coffeeMachine->balance();
		$this->assertEquals(13, $balance);
		$this->coffeeMachine->buy('product_1');
		$balance = $this->coffeeMachine->balance();
		$this->assertEquals(0, $balance);

		$this->coffeeMachine->push(new \CoffeeMachine\Coin(2, 9));
		$balance = $this->coffeeMachine->balance();
		$this->assertEquals(18, $balance);

		try {
			$this->coffeeMachine->buy('product_2');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		return true;
	}

	public function testGetChange() {
		$coins = $this->coffeeMachine->getChange();
		$this->assertTrue(!empty($coins));
		$balance = $this->coffeeMachine->balance();
		$this->assertEquals(0, $balance);


		return true;
	}

}

