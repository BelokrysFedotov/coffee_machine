<?php

namespace CoffeeMachine;


class CoffeeMachine implements CoffeeMachineInterface{

	public function getState() {
		return [];
	}

	public function take(int $value) {
//		if (item.count <= 0) {
//			app.Debug = 'Не достаточно монет';
//			return false;
//		}
//
//		var coin = this.getMachineCashboxCoin(item.value);
//		item.count--;
//		coin.count++;
//		this.CoffeeMachine.Machine.Cashbox.balance += item.value;

		return true;
	}

	public function buy(int $id) {
//		if (item.count <= 0) {
//			this.Debug = 'Не достаточно товара';
//			return false;
//		}
//		if (item.price > app.CoffeeMachine.Machine.Cashbox.balance) {
//			this.Debug = 'Не достаточно баланса';
//			return false;
//		}
//		item.count--;
//		this.CoffeeMachine.Machine.Cashbox.balance -= item.price;
		return true;
	}

	public function getChange() {
//		var app = this;
//		//JS solition
//		if (this.CoffeeMachine.Machine.Cashbox.balance <= 0) {
//			this.Debug = 'Нечего возвращать';
//			return false;
//		}
//
//		var coins = this.CoffeeMachine.Machine.Cashbox.Coins.slice();
//
//		coins.sort(function (a, b) {
//			if (a.value < b.value) return 1;
//			if (a.value > b.value) return -1;
//			return 0;
//		});
//
//		coins.forEach(function (coin) {
//			var uCoin = app.getUserCashboxCoin(coin.value);
//			while (app.CoffeeMachine.Machine.Cashbox.balance >= coin.value && coin.count > 0) {
//				coin.count--;
//				uCoin.count++;
//				app.CoffeeMachine.Machine.Cashbox.balance -= coin.value;
//			}
//		});
		return true;
	}

}