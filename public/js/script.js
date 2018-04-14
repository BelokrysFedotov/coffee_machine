window.addEventListener('load', function () {

	var data = {
		message: 'Hello Vue!',
		Debug: '',
		CoffeeMachine: {
			Machine: {
				status: 'ready',
				Items: [
					{
						id: 1,
						name: 'Чай',
						count: 10,
						price: 13,
						disabled: false
					},
					{
						id: 2,
						name: 'Кофе',
						count: 20,
						price: 18,
						disabled: false
					},
					{
						id: 3,
						name: 'Кофе с молоком',
						count: 20,
						price: 21,
						disabled: false
					},
					{
						id: 4,
						name: 'Сок',
						count: 15,
						price: 35,
						disabled: false
					}
				],
				Cashbox: {
					sum: 105,
					balance: 0,
					Coins: [
						{
							value: 1,
							count: 100
						},
						{
							value: 2,
							count: 100
						},
						{
							value: 5,
							count: 100
						},
						{
							value: 10,
							count: 100
						}
					]


				}
			},
			User: {
				Cashbox: {
					sum: 105,
					Coins: [
						{
							value: 1,
							count: 100
						},
						{
							value: 2,
							count: 100
						},
						{
							value: 5,
							count: 100
						},
						{
							value: 10,
							count: 100
						}
					]
				}
			}
		}
	};

	var app = new Vue({
		el: '#CoffeeMachine',
		delimiters: ['${', '}'],

		methods: {
			take: function (item) {
				//JS solition
				if (item.count <= 0) {
					app.Debug = 'Не достаточно монет';
					return false;
				}

				var coin = this.getMachineCashboxCoin(item.value);
				item.count--;
				coin.count++;
				this.CoffeeMachine.Machine.Cashbox.balance += item.value;
			},
			buy: function (item) {
				//JS solition
				if (item.count <= 0) {
					this.Debug = 'Не достаточно товара';
					return false;
				}
				if (item.price > app.CoffeeMachine.Machine.Cashbox.balance) {
					this.Debug = 'Не достаточно баланса';
					return false;
				}
				item.count--;
				this.CoffeeMachine.Machine.Cashbox.balance -= item.price;
			},
			getChange: function (event) {
				var app = this;
				//JS solition
				if (this.CoffeeMachine.Machine.Cashbox.balance <= 0) {
					this.Debug = 'Нечего возвращать';
					return false;
				}

				var coins = this.CoffeeMachine.Machine.Cashbox.Coins.slice();

				coins.sort(function (a, b) {
					if (a.value < b.value) return 1;
					if (a.value > b.value) return -1;
					return 0;
				});

				coins.forEach(function (coin) {
					var uCoin = app.getUserCashboxCoin(coin.value);
					while (app.CoffeeMachine.Machine.Cashbox.balance >= coin.value && coin.count > 0) {
						coin.count--;
						uCoin.count++;
						app.CoffeeMachine.Machine.Cashbox.balance -= coin.value;
					}
				});
			},

			getMachineCashboxCoin: function (value) {
				var find = null;
				this.CoffeeMachine.Machine.Cashbox.Coins.forEach(function (coin) {
					if (coin.value == value) {
						find = coin;
					}
				});
				if (find) return find;
				var n = this.CoffeeMachine.Machine.Cashbox.Coins.push({
					value: value,
					count: 0
				});
				return this.CoffeeMachine.Machine.Cashbox.Coins[n];
			},
			getUserCashboxCoin: function (value) {
				var find = null;
				this.CoffeeMachine.User.Cashbox.Coins.forEach(function (coin) {
					if (coin.value == value) {
						find = coin;
					}
				});
				if (find) return find;
				var n = this.CoffeeMachine.User.Cashbox.Coins.push({
					value: value,
					count: 0
				});
				return this.CoffeeMachine.User.Cashbox.Coins[n];
			}
		},

		data: data
	});
});


