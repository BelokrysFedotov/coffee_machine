<?php

namespace CoffeeMachine;


interface StorageInterface {

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
	 * Сумма товаров
	 * @return int
	 */
	public function sum();

	/**
	 * Найти товар c ID $itemId
	 *
	 * @param string $itemId
	 *
	 * @return StorageItemInterface
	 * @throws CoffeeMachineException
	 */
	public function find(string $itemId);

	/**
	 * Взять один товар c ID $itemId
	 *
	 * @param string $itemId
	 *
	 * @throws CoffeeMachineException
	 */
	public function getOne(string $itemId);

	/**
	 * Добавить товар
	 *
	 * @param StorageItemInterface $item
	 *
	 * @throws CoffeeMachineException
	 */
	public function pushItem(StorageItemInterface $item);

	/**
	 * Добавить один товар
	 *
	 * @param string $itemId
	 *
	 * @throws CoffeeMachineException
	 */
	public function pushOne(string $itemId);

}