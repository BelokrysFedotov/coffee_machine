<?php

namespace CoffeeMachine;


interface CashBoxInterface {

	/**
	 * Получить структуру с полным состоянием кассы для отображения
	 * @return array
	 */
	public function getState();

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save();


	/**
	 * Сумма кассы
	 * @return int
	 */
	public function sum();

	/**
	 * Взять один item c ID $itemid
	 *
	 * @param string $itemId
	 *
	 * @return CashBoxItemInterface
	 * @throws CoffeeMachineException
	 */
	public function getOne(string $itemId);

	/**
	 * Добавить $item
	 *
	 * @param CashBoxItemInterface $item
	 *
	 * @return void
	 */
	public function pushItem(CashBoxItemInterface $item);

	/**
	 * Добавить один item
	 */
	public function pushOne(string $itemId);

	/**
	 * Массив возможных номиналов монет: id => value
	 * @return array
	 */
	public function values();

	/**
	 * Выдать сдачу в размере $balance
	 *
	 * @param int $balance
	 *
	 * @return array|CashBoxItemInterface[]
	 */
	public function getChange(int $balance);

}