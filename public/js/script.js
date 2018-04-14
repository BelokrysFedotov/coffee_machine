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
				var coin = null;
				app.CoffeeMachine.Machine.Cashbox.Coins.forEach(function (c) {
					if (c.value == item.value) {
						coin = c;
					}
				});

				item.count--;
				coin.count++;
				app.CoffeeMachine.Machine.Cashbox.balance += item.value;
			},
			buy: function (item) {
				//JS solition
				if (item.count <= 0) {
					app.Debug = 'Не достаточно товара';
					return false;
				}
				if (item.price > app.CoffeeMachine.Machine.Cashbox.balance) {
					app.Debug = 'Не достаточно баланса';
					return false;
				}
				item.count--;
				app.CoffeeMachine.Machine.Cashbox.balance -= item.price;
			},
			getChange: function (event) {
				//JS solition
				if (app.CoffeeMachine.Machine.Cashbox.balance <= 0) {
					app.Debug = 'Нечего возвращать';
					return false;
				}

				var coins = app.CoffeeMachine.Machine.Cashbox.Coins.slice();

				coins.sort(function (a, b) {
					if (a.value < b.value) return 1;
					if (a.value > b.value) return -1;
					return 0;
				});

				coins.forEach(function (coin) {
					var uCoin = null;
					app.CoffeeMachine.User.Cashbox.Coins.forEach(function (c) {
						if (c.value == coin.value) {
							uCoin = c;
						}
					});
					while (app.CoffeeMachine.Machine.Cashbox.balance >= coin.value && coin.count > 0) {
						coin.count--;
						uCoin.count++;
						app.CoffeeMachine.Machine.Cashbox.balance -= coin.value;
					}
				});
			},
		},

		data: data
	});
});


