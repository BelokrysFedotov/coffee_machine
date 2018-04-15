<?php

namespace CoffeeMachine;


interface StorageItemInterface {


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
	 * ID товара
	 * @return string
	 */
	public function id();

	/**
	 * Наименование товара
	 * @return string
	 */
	public function name();

	/**
	 * Кол-во товара
	 * @return int
	 */
	public function count();

	/**
	 * Цена
	 * @return int
	 */
	public function price();

	/**
	 * Общая цена всех товаров
	 * @return int
	 */
	public function sum();

	/**
	 * Добавить товар в кол-ве $count
	 *
	 * @param int $count
	 */
	public function push(int $count);

	/**
	 * Добавить один товар
	 */
	public function pushOne();

	/**
	 * Забрать товара в кол-ве $count
	 *
	 * @param int $count
	 *
	 * @throws \Exception
	 */
	public function get(int $count);

	/**
	 * Забрать один товар
	 *
	 * @throws \Exception
	 */
	public function getOne();

}