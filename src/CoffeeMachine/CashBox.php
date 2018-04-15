<?php

namespace CoffeeMachine;


class CashBox implements CashBoxInterface {

	/**
	 * @var CashBoxItemInterface[]
	 */
	private $items;

	/**
	 * @var ChangeStrategyInterface
	 */
	private $changeStrategy;

	/**
	 * CashBox constructor.
	 *
	 * @param ChangeStrategyInterface $changeStrategy
	 * @param array|CashBoxItemInterface[] $items
	 */
	public function __construct(ChangeStrategyInterface $changeStrategy, array $items) {
		$this->items = [];
		// Складируем переданные items в ассоциативный массив, объединяя одинаковые
		if (!empty($items)) {
			/** @var CashBoxItemInterface $item */
			foreach ($items as $item) {
				if (array_key_exists($item->id(), $this->items)) {
					$this->items[$item->id()]->pushItem($item);
				} else {
					$this->items[$item->id()] = $item;
				}
			}
		}

		$this->changeStrategy = $changeStrategy;
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
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
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
	 * Сумма кассы
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
	 * Взять один item c ID $itemid
	 *
	 * @param string $itemId
	 *
	 * @return CashBoxItemInterface
	 * @throws CoffeeMachineException
	 */
	public function getOne(string $itemId) {
		if (!array_key_exists($itemId, $this->items)) {
			throw new CoffeeMachineException('В кассе не найден ' . $itemId);
		}
		return $this->items[$itemId]->getOne();
	}

	/**
	 * Добавить item
	 *
	 * @param CashBoxItemInterface $item
	 *
	 * @throws CoffeeMachineException
	 */
	public function pushItem(CashBoxItemInterface $item) {
		if (!array_key_exists($item->id(), $this->items)) {
			throw new CoffeeMachineException('В кассе не найден ' . $item->id());
		}
		$this->items[$item->id()]->push($item->count());
	}

	/**
	 * Добавить один item
	 *
	 * @param string $itemId
	 *
	 * @throws CoffeeMachineException
	 */
	public function pushOne(string $itemId) {
		if (!array_key_exists($itemId, $this->items)) {
			throw new CoffeeMachineException('В кассе не найден ' . $itemId);
		}
		$this->items[$itemId]->pushOne();
	}

	/**
	 * Массив возможных номиналов монет: id => value
	 * @return array
	 */
	public function values() {
		$values = [];
		foreach ($this->items as $item) {
			$values[$item->id()] = $item->value();
		}
		return $values;
	}

	/**
	 * Выдать сдачу в размере $balance
	 *
	 * @param int $balance
	 *
	 * @return array|CashBoxItemInterface[]
	 */
	public function getChange(int $balance) {
		return $this->changeStrategy->getChange($balance, $this);
	}
}