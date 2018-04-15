<?php

namespace CoffeeMachine;


interface CashBoxItemInterface {

	/**
	 * Получить структуру с полным состоянием приложения для отображения
	 * @return array
	 */
	public function getState();

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save();

	/**
	 * Имя Item (для отображения)
	 * @return string
	 */
	public function name();

	/**
	 * ID item
	 * @return string
	 */
	public function id();

	/**
	 * count item
	 * @return int
	 */
	public function count();

	/**
	 * value item
	 * @return int
	 */
	public function value();

	/**
	 * Взять item в количестве count
	 * @param int $count
	 * @return CashBoxItemInterface
	 */
	public function get(int $count);

	/**
	 * Взять один item
	 * @return CashBoxItemInterface
	 */
	public function getOne();

	/**
	 * Добавить item в количестве count
	 * @param int $count
	 */
	public function push(int $count);

	/**
	 * Добавить один item
	 */
	public function pushOne();

	/**
	 * Возвращает сумму
	 * @return int
	 */
	public function sum();

}