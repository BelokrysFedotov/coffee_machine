<?php

namespace CoffeeMachine;


class CoffeeMachine implements CoffeeMachineInterface{

	/**
	 * @var CashBoxInterface
	 */
	private $cashBox;

	/**
	 * @var StorageInterface
	 */
	private $storage;

	/**
	 * @var int
	 */
	private $balance;

	/**
	 * CoffeeMachine constructor.
	 *
	 * @param CashBoxInterface $cashBox
	 * @param StorageInterface $storage
	 * @param int $balance
	 */
	public function __construct(CashBoxInterface $cashBox, StorageInterface $storage, int $balance = 0) {
		$this->cashBox = $cashBox;
		$this->storage = $storage;
		$this->balance = $balance;
	}

	/**
	 * Получить структуру с полным состоянием для отображения
	 * @return array
	 */
	public function getState() {
		return [
			'cashBox' => $this->cashBox->getState(),
			'storage' => $this->storage->getState(),
			'balance' => $this->balance(),
		];
	}

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
			'cashBox' => $this->cashBox->save(),
			'storage' => $this->storage->save(),
			'balance' => $this->balance(),
		];
	}

	/**
	 * Баланс
	 * @return int
	 */
	public function balance() {
		return $this->balance;
	}

	/**
	 * Закинуть монету в аппарат
	 *
	 * @param CashBoxItemInterface $cashBoxItem
	 */
	public function push(CashBoxItemInterface $cashBoxItem) {
		$this->cashBox->pushItem($cashBoxItem);
		$this->balance += $cashBoxItem->sum();
	}

	/**
	 * Совершить покупку $itemId
	 *
	 * @param string $itemId
	 *
	 * @throws \Exception
	 */
	public function buy(string $itemId) {
		$item = $this->storage->find($itemId);
		if ($item->price() > $this->balance()) {
			throw new \Exception('Не достаточно баланса');
		}
		$this->storage->getOne($itemId);
		$this->balance -= $item->price();
	}

	/**
	 * Выдать сдачу
	 */
	public function getChange() {
		$coins = $this->cashBox->getChange($this->balance());

		$sum = 0;
		if (!empty($coins)) {
			foreach ($coins as $coin) {
				$sum += $coin->sum();
			}
		}

		$this->balance -= $sum;

		return $coins;
	}

}