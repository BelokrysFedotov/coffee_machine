<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\Application;
use \CoffeeMachine\CoffeeMachineException;

class ApplicationTest extends TestCase {

	/**
	 * @var Application
	 */
	private $app;

	protected function setUp() {
		$this->app = \CoffeeMachine\Factory::getApplication([
			'coffeeMachine' => [
				'balance' => 0,
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
							'count' => 20,
							'price' => 18
						],
						[
							'id'    => 'product_3',
							'name'  => 'Кофе с молоком',
							'count' => 0,
							'price' => 21
						],
						[
							'id'    => 'product_4',
							'name'  => 'Сок',
							'count' => 2,
							'price' => 35
						]
					]
				],
				'cashBox' => [
					'items' => [
						[
							'value' => 1,
							'count' => 100
						],
						[
							'value' => 2,
							'count' => 100
						],
						[
							'value' => 5,
							'count' => 100
						],
						[
							'value' => 10,
							'count' => 100
						]
					]
				],

			],
			'user'          => [
				'cashBox' => [
					'items' => [
						[
							'value' => 1,
							'count' => 10
						],
						[
							'value' => 2,
							'count' => 2
						],
						[
							'value' => 5,
							'count' => 0
						],
						[
							'value' => 10,
							'count' => 10
						]
					]
				]
			]
		]);
	}

	public function testGetState() {
		$state = $this->app->getState();

		$this->assertTrue(array_key_exists('coffeeMachine', $state));
		$this->assertTrue(array_key_exists('user', $state));

		return true;
	}

	public function testSave() {
		$state = $this->app->save();

		$this->assertTrue(array_key_exists('coffeeMachine', $state));
		$this->assertTrue(array_key_exists('user', $state));

		return true;
	}

	public function testTake() {

		$this->app->take('coin_2');
		$this->app->take('coin_2');

		try {
			$this->app->take('coin_2');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		try {
			$this->app->take('coin_5');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		$this->assertTrue(true);

		return true;
	}


	public function testBuy() {

		try {
			$this->app->buy('product_1');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		$this->app->take('coin_10');
		$this->app->take('coin_2');
		$this->app->take('coin_1');

		$this->app->buy('product_1');

		try {
			$this->app->buy('product_1');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		$this->app->take('coin_10');
		$this->app->take('coin_10');
		$this->app->take('coin_1');

		try {
			$this->app->buy('product_3');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

		$this->assertTrue(true);

		return true;
	}

	public function testGetChange() {

		$this->app->getChange();

		$this->assertTrue(true);

		return true;
	}


}
