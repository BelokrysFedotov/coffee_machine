<?php

namespace CoffeeMachine;


class Factory {

	/**
	 * Создание и загрузка приложения
	 * @param array $data
	 *
	 * @return Application
	 */
	static function getApplication(array $data = []) {
		$coffeeMachine = self::getCoffeeMachine($data['coffeeMachine'] ?: []);
		$user          = self::getUser($data['user'] ?: []);
		$application   = new Application($coffeeMachine, $user);

		return $application;

	}

	/**
	 * @param array $data
	 *
	 * @return CoffeeMachine
	 */
	static function getCoffeeMachine(array $data) {
		$cashBox = self::getCacheBox($data['cashBox'] ?: []);
		$storage = self::getStorage($data['storage'] ?: []);
		$balance = $data['balance'] ?: 0;
		return new CoffeeMachine($cashBox, $storage, $balance);
	}

	/**
	 * @param array $data
	 *
	 * @return Storage
	 */
	static function getStorage(array $data) {
		$items = [];
		if (!empty($data['items'])) {
			foreach ($data['items'] as $item) {
				$items[] = self::getStorageItem($item);
			}
		}

		return new Storage($items);
	}

	/**
	 * @param array $data
	 *
	 * @return StorageItem
	 */
	static function getStorageItem(array $data) {
		$id    = (string)$data['id'] ?: 0;
		$name  = (string)$data['name'] ?: '';
		$price = (int)$data['price'] ?: 0;
		$count = (int)$data['count'] ?: 0;

		return new StorageItem($id, $name, $price, $count);
	}

	/**
	 * @param array $data
	 *
	 * @return User
	 */
	static function getUser(array $data) {
		$cashBox = self::getCacheBox($data['cashBox'] ?: []);

		return new User($cashBox);
	}

	/**
	 * @param array $data
	 *
	 * @return CashBox
	 */
	static function getCacheBox(array $data) {
		$items = [];
		if (!empty($data['items'])) {
			foreach ($data['items'] as $item) {
				$items[] = self::getCacheBoxItem($item);
			}
		}

		return new CashBox(new ChangeStrategy(), $items);
	}

	/**
	 * @param array $data
	 *
	 * @return Coin
	 */
	static function getCacheBoxItem(array $data) {
		$value = (int)$data['value'] ?: 1;
		$count = (int)$data['count'] ?: 0;

		return new Coin($value, $count);
	}


}