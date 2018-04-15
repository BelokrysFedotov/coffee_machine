<?php

namespace CoffeeMachine;

interface UserInterface {

	/**
	 * Получить структуру с полным состоянием пользователя для отображения
	 * @return array
	 */
	public function getState();

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save();

	/**
	 * Кошелёк пользователя
	 * @return CashBoxInterface
	 */
	public function CashBox();
}