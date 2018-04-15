<?php

namespace CoffeeMachine;


class StorageItem implements StorageItemInterface {

	/**
	 * ID товара
	 * @var string
	 */
	private $id;

	/**
	 * Наименование товара
	 * @var string
	 */
	private $name;

	/**
	 * Цена товара
	 * @var int
	 */
	private $price;

	/**
	 * Кол-во товара
	 * @var int
	 */
	private $count;

	/**
	 * StorageItem constructor.
	 *
	 * @param string $id
	 * @param string $name
	 * @param int $price
	 * @param int $count
	 */
	public function __construct(string $id, string $name, int $price, int $count) {
		$this->id    = $id;
		$this->name  = $name;
		$this->price = $price;
		$this->count = $count;
	}

	/**
	 * Получить структуру с полным состоянием для отображения
	 * @return array
	 */
	public function getState() {
		return [
			'id'    => $this->id(),
			'name'  => $this->name(),
			'price' => $this->price(),
			'count' => $this->count(),
		];
	}

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
			'id'    => $this->id(),
			'name'  => $this->name(),
			'price' => $this->price(),
			'count' => $this->count(),
		];
	}

	/**
	 * ID товара
	 * @return string
	 */
	public function id() {
		return $this->id;
	}

	/**
	 * Наименование товара
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Кол-во товара
	 * @return int
	 */
	public function count() {
		return $this->count;
	}

	/**
	 * Цена
	 * @return int
	 */
	public function price() {
		return $this->price;
	}

	/**
	 * Общая цена всех товаров
	 * @return int
	 */
	public function sum() {
		return $this->count() * $this->price();
	}

	/**
	 * Добавить товар в кол-ве $count
	 *
	 * @param int $count
	 */
	public function push(int $count) {
		$this->count += $count;
	}

	/**
	 * Добавить один товар
	 */
	public function pushOne() {
		$this->push(1);
	}

	/**
	 * Забрать товара в кол-ве $count
	 *
	 * @param int $count
	 *
	 * @throws \Exception
	 */
	public function get(int $count) {
		if ($this->count < $count) {
			throw new \Exception('Товара ' . $this->name() . ' недостаточно на складе');
		}
		$this->count -= $count;
	}

	/**
	 * Забрать один товар
	 *
	 * @throws \Exception
	 */
	public function getOne() {
		$this->get(1);
	}
}