<?php

use PHPUnit\Framework\TestCase;
use CoffeeMachine\StorageItem;
use \CoffeeMachine\CoffeeMachineException;

class StorageItemTest extends TestCase {

	/**
	 * @var StorageItem
	 */
	private $storageItem;

	protected function setUp() {
		$this->storageItem = new StorageItem('p1', 'product1', 1, 2);
	}

	public function testGetState() {

		$state = $this->storageItem->getState();

		$this->assertEquals($state['id'], $this->storageItem->id());
		$this->assertEquals($state['name'], $this->storageItem->name());
		$this->assertEquals($state['count'], $this->storageItem->count());
		$this->assertEquals($state['price'], $this->storageItem->price());

		return true;
	}

	public function testSave() {

		$save = $this->storageItem->save();

		$this->assertEquals($save['id'], $this->storageItem->id());
		$this->assertEquals($save['name'], $this->storageItem->name());
		$this->assertEquals($save['count'], $this->storageItem->count());
		$this->assertEquals($save['price'], $this->storageItem->price());

		return true;
	}

	public function testGetters() {

		$this->assertEquals('p1', $this->storageItem->id());
		$this->assertEquals('product1', $this->storageItem->name());
		$this->assertEquals(2, $this->storageItem->count());
		$this->assertEquals(1, $this->storageItem->price());

		return true;
	}

	public function testGetOne() {
		$this->storageItem->getOne();
		$this->assertEquals(1, $this->storageItem->count());
	}

	public function testGet() {

		$this->storageItem->get(2);
		$this->assertEquals(0, $this->storageItem->count());

		try {
			$this->storageItem->get(1);
			$this->fail("Expected exception not thrown");
		} catch (CoffeeMachineException $exception){

		}

		return true;
	}

	public function testPush() {
		$this->storageItem->pushOne();
		$this->assertEquals(3, $this->storageItem->count());

		$this->storageItem->push(3);
		$this->assertEquals(6, $this->storageItem->count());

		return true;
	}

	public function testSum() {

		$sum = $this->storageItem->sum();
		$this->assertEquals(2, $sum);

		return true;
	}

}
