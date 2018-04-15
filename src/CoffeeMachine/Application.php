<?php

namespace CoffeeMachine;


class Application {

	/**
	 * @var CoffeeMachineInterface
	 */
	private $coffeeMachine;

	/**
	 * @var UserInterface
	 */
	private $user;

	/**
	 * @var array
	 */
	private $debug;


	/**
	 * Application constructor.
	 *
	 * @param CoffeeMachineInterface $coffeeMachine
	 * @param UserInterface $user
	 */
	function __construct(CoffeeMachineInterface $coffeeMachine, UserInterface $user) {
		$this->coffeeMachine = $coffeeMachine;
		$this->user          = $user;
	}

	/**
	 * Получить структуру с полным состоянием приложения для отображения
	 * @return array
	 */
	public function getState() {
		return [
			'debug'         => is_array($this->debug) ? implode('</br>', $this->debug) : (string)$this->debug,
			'coffeeMachine' => $this->coffeeMachine->getState(),
			'user'          => $this->user->getState()
		];
	}

	/**
	 * Сохранить состояние
	 * @return array
	 */
	public function save() {
		return [
			'coffeeMachine' => $this->coffeeMachine->save(),
			'user'          => $this->user->save()
		];
	}

	/**
	 * Забросить монету достоинством $value в аппарат
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	public function take(string $id) {

		$cashBoxItem = $this->user->CashBox()->getOne($id);
		$this->coffeeMachine->push($cashBoxItem);

		return true;
	}

	/**
	 * Купить товар $id
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	public function buy(string $id) {

		$this->coffeeMachine->buy($id);

		return true;
	}

	/**
	 * Выдать сдачу
	 * @return bool
	 */
	public function getChange() {

		$coins = $this->coffeeMachine->getChange();

		if (!empty($coins)) {
			foreach ($coins as $coin) {
				$this->user->CashBox()->pushItem($coin);
			}
		}

		return true;
	}


}