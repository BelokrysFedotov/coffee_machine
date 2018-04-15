<?php

namespace CoffeeMachine;


class User implements UserInterface {

	/**
	 * @var CashBoxInterface
	 */
	private $cashBox;

	/**
	 * User constructor.
	 *
	 * @param CashBoxInterface $cashBox
	 */
	public function __construct(CashBoxInterface $cashBox) {
		$this->cashBox = $cashBox;
	}

	/**
	 * Получить структуру с полным состоянием пользователя для отображения
	 * @return array
	 */
	public function getState() {
		return [
			'cashBox' => $this->cashBox->getState(),
		];
	}

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
			'cashBox' => $this->cashBox->save(),
		];
	}

	/**
	 * Кошелёк пользователя
	 * @return CashBoxInterface
	 */
	public function CashBox() {
		return $this->cashBox;
	}
}