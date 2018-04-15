<?php

namespace CoffeeMachine;


interface CoffeeMachineInterface {

	public function getState();

	public function take(int $value);

	public function buy(int $id);

	public function getChange();

}