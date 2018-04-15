<?php

namespace CoffeeMachine;

class Repository {

	/**
	 * @var array
	 */
	private $defaultCoffeeMachine;

	/**
	 * Repository constructor.
	 *
	 * @param array $defaultCoffeeMachine
	 */
	public function __construct(array $defaultCoffeeMachine) {
		$this->defaultCoffeeMachine = $defaultCoffeeMachine;
		session_start();
	}

	/**
	 * @return array
	 */
	public function load() {
		if (!empty($_SESSION['coffeeMachine'])) {
			$data = $_SESSION['coffeeMachine'];
		} else {
			$data = $this->defaultCoffeeMachine;
		}

		return $data;
	}

	/**
	 * @param array $data
	 */
	public function save(array $data) {
		$_SESSION['coffeeMachine'] = $data;
	}
}