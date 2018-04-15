<?php

namespace CoffeeMachine;


class Storage implements StorageInterface {

	/**
	 * @var StorageItemInterface[]
	 */
	private $items;

	public function __construct(array $items) {
		$this->items = [];
		// Складируем переданные items в ассоциативный массив, объединяя одинаковые
		if (!empty($items)) {
			/** @var CashBoxItemInterface $item */
			foreach ($items as $item) {
				if (array_key_exists($item->id(), $this->items)) {
					$this->items[$item->id()]->push($item->count());
				} else {
					$this->items[$item->id()] = $item;
				}
			}
		}
	}

	/**
	 * Получить структуру с полным состоянием для отображения
	 * @return array
	 */
	public function getState() {
		return [
			'sum'   => $this->sum(),
			'items' => $this->getItemsState(),
		];
	}

	/**
	 * Массив структур с состоянием items
	 * @return array
	 */
	private function getItemsState() {
		$data = [];
		foreach ($this->items as $item) {
			$data[] = $item->getState();
		}
		return $data;
	}

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
			'items' => $this->saveItems(),
		];
	}

	/**
	 * Массив структур с состоянием items
	 * @return array
	 */
	private function saveItems() {
		$data = [];
		foreach ($this->items as $item) {
			$data[] = $item->save();
		}
		return $data;
	}

	/**
	 * Сумма товаров
	 * @return int
	 */
	public function sum() {
		$sum = 0;
		foreach ($this->items as $item) {
			$sum += $item->sum();
		}
		return $sum;
	}

	/**
	 * Найти товар c ID $itemId
	 *
	 * @param string $itemId
	 *
	 * @return StorageItemInterface
	 * @throws CoffeeMachineException
	 */
	public function find(string $itemId) {
		if (!array_key_exists($itemId, $this->items)) {
			throw new CoffeeMachineException('Товар ' . $itemId . ' не найден');
		}
		return $this->items[$itemId];
	}

	/**
	 * Взять один товар c ID $itemId
	 *
	 * @param string $itemId
	 *
	 * @return StorageItemInterface
	 * @throws CoffeeMachineException
	 */
	public function getOne(string $itemId) {
		if (!array_key_exists($itemId, $this->items)) {
			throw new CoffeeMachineException('Товар ' . $itemId . ' не найден');
		}
		return $this->items[$itemId]->getOne();
	}

	/**
	 * Добавить товар
	 *
	 * @param StorageItemInterface $item
	 *
	 * @throws CoffeeMachineException
	 */
	public function pushItem(StorageItemInterface $item) {
		if (!array_key_exists($item->id(), $this->items)) {
			throw new CoffeeMachineException('Товар ' . $item->id() . ' не найден');
		}
		$this->items[$item->id()]->push($item->count());
	}

	/**
	 * Добавить один товар
	 *
	 * @param string $itemId
	 *
	 * @throws CoffeeMachineException
	 */
	public function pushOne(string $itemId) {
		if (!array_key_exists($itemId, $this->items)) {
			throw new CoffeeMachineException('Товар ' .$itemId . ' не найден');
		}
		$this->items[$itemId]->pushOne();
	}

}