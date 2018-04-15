<?php

namespace CoffeeMachine;


interface CoffeeMachineInterface {

	/**
	 * Получить структуру с полным состоянием для отображения
	 * @return array
	 */
	public function getState();

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save();

	/**
	 * Баланс
	 * @return int
	 */
	public function balance();

	/**
	 * Закинуть монету в аппарат
	 * @param CashBoxItemInterface $cashBoxItem
	 */
	public function push(CashBoxItemInterface $cashBoxItem);

	/**
	 * Совершить покупку $itemId
	 * @param string $itemId
	 *
	 * @throws CoffeeMachineException
	 */
	public function buy(string $itemId);

	/**
	 * Выдать сдачу
	 */
	public function getChange();

}