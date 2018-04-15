<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\Storage;
use \CoffeeMachine\CoffeeMachineException;

class StorageTest extends TestCase {

	/**
	 * @var Storage
	 */
	private $storage;

	protected function setUp() {
		$this->storage = new Storage([
			new \CoffeeMachine\StorageItem('p1', 'product1', 10, 1),
			new \CoffeeMachine\StorageItem('p2', 'product2', 3, 15),
			new \CoffeeMachine\StorageItem('p3', 'product3', 1, 0),
		]);
	}

	public function testGetState() {
		$state = $this->storage->getState();

		$this->assertEquals(55, $state['sum']);
		$this->assertCount(3, $state['items']);

		return true;
	}

	public function testSave() {
		$save = $this->storage->save();

		$this->assertCount(3, $save['items']);

		return true;
	}

	public function testSum() {
		$sum = $this->storage->sum();

		$this->assertEquals(55, $sum);

		return true;
	}

	public function testFind() {
		$item = $this->storage->find('p1');
		$this->assertEquals('p1', $item->id());
		$item = $this->storage->find('p2');
		$this->assertEquals('p2', $item->id());
		$item = $this->storage->find('p3');
		$this->assertEquals('p3', $item->id());

		try {
			$item = $this->storage->find('p0');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

	}


	public function testGetOne() {
		$this->storage->getOne('p2');
		$this->assertEquals(52, $this->storage->sum());
		$item = $this->storage->find('p2');
		$this->assertEquals(14, $item->count());
		try {
			$this->storage->getOne('p3');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception) {

		}

	}

	public function testPushItem() {

		$item = new \CoffeeMachine\StorageItem('p3','product3',1,2);
		$this->storage->pushItem($item);

		$this->assertEquals(57, $this->storage->sum());
		$this->storage->getOne('p3');
		$this->storage->getOne('p3');

		try {
			$this->storage->getOne('p3');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}
	}

	public function testPushOne() {
		$this->storage->pushOne('p3');
		$this->assertEquals(56, $this->storage->sum());
		$this->storage->getOne('p3');
		$this->assertEquals(55, $this->storage->sum());

		try {
			$this->storage->getOne('p3');
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}
	}
}
