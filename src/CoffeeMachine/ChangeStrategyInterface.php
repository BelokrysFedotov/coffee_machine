<?php

namespace CoffeeMachine;

/**
 * Interface ChangeStrategyInterface
 * Стратегия выдачи сдачи из кассы
 * @package CoffeeMachine
 */
interface ChangeStrategyInterface {


	/**
	 * Выдача сдачи $balance из кассы $cashBox
	 *
	 * @param int $balance
	 * @param CashBoxInterface $cashBox
	 *
	 * @return array|CashBoxItemInterface[]
	 * @throws CoffeeMachineException
	 */
	public function getChange(int $balance, CashBoxInterface $cashBox);

}