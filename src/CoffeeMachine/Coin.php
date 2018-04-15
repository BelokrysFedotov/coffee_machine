<?php

namespace CoffeeMachine;


class Coin implements CashBoxItemInterface {

	/**
	 * @var int
	 */
	private $value;

	/**
	 * @var int
	 */
	private $count;

	/**
	 * Coin constructor.
	 *
	 * @param int $value
	 * @param int $count
	 */
	public function __construct(int $value, int $count) {
		$this->value = $value;
		$this->count = $count;
	}

	/**
	 * Получить структуру с полным состоянием приложения для отображения
	 * @return array
	 */
	public function getState() {
		return [
			'id'	=> $this->id(),
			'name'  => $this->name(),
			'count' => $this->count,
			'value' => $this->value,
		];
	}

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
			'id'	=> $this->id(),
			'name'  => $this->name(),
			'count' => $this->count,
			'value' => $this->value,
		];
	}

	/**
	 * Имя монеты
	 * @return string
	 */
	public function name() {
		return $this->value . 'р';
	}

	/**
	 * ID монеты
	 * @return string
	 */
	public function id() {
		return 'coin_' . $this->value;
	}

	/**
	 * count item
	 * @return int
	 */
	public function count() {
		return $this->count;
	}

	/**
	 * value item
	 * @return int
	 */
	public function value() {
		return $this->value;
	}

	/**
	 * Взять item в количестве count
	 *
	 * @param int $count
	 *
	 * @return CashBoxItemInterface
	 * @throws \Exception
	 */
	public function get(int $count) {
		if ($this->count < $count) {
			throw new \Exception('Не достаточно монет достоинством ' . $this->name());
		}
		$this->count -= $count;
		return new Coin($this->value, $count);
	}

	/**
	 * Взять одну монету
	 *
	 * @return CashBoxItemInterface
	 * @throws \Exception
	 */
	public function getOne() {
		return $this->get(1);
	}

	/**
	 * Добавить item в количестве count
	 *
	 * @param int $count
	 */
	public function push(int $count) {
		$this->count += $count;
	}

	/**
	 * Добавить одну монету
	 */
	public function pushOne() {
		$this->push(1);
	}

	/**
	 * Возвращает сумму монет
	 * @return int
	 */
	public function sum() {
		return $this->count * $this->value;
	}
}