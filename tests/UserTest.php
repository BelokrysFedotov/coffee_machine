<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\User;

class UserTest extends TestCase {

	/**
	 * @var User
	 */
	private $user;

	protected function setUp() {
		$this->user = \CoffeeMachine\Factory::getUser([
			'cashBox' => [
				'items' => [
					[
						'value' => 1,
						'count' => 2
					]
				]
			]
		]);
	}

	public function testGetState() {
		$state = $this->user->getState();

		$this->assertTrue(array_key_exists('cashBox', $state));

		return true;
	}

	public function testSave() {
		$state = $this->user->save();

		$this->assertTrue(array_key_exists('cashBox', $state));

		return true;
	}

	public function testCashBox() {
		$cashBox = $this->user->CashBox();

		$this->assertTrue(!empty($cashBox));

		return true;
	}

}
