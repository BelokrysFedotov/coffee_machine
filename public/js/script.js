window.addEventListener('load', function () {

	var app = new Vue({
		el: '#CoffeeMachine',
		delimiters: ['${', '}'],

		methods: {
			reset: function () {
				app.debug = '';
				axios.post('/reset/')
					.then(function (response) {
						if(response.data.error) {
							app.debug = response.data.error;
						}else if(response.data) {
							app.update(response.data);
						}
					})
					.catch(function (error) {
						console.log(error);
					});
			},
			take: function (item) {
				app.debug = '';
				axios.post('/take/' + item.id)
					.then(function (response) {
						if(response.data.error) {
							app.debug = response.data.error;
						}else if(response.data) {
							app.update(response.data);
						}
					})
					.catch(function (error) {
						console.log(error);
					});
			},
			buy: function (item) {
				app.debug = '';
				axios.post('/buy/' + item.id)
					.then(function (response) {
						if(response.data.error) {
							app.debug = response.data.error;
						}else if(response.data) {
							app.update(response.data);
						}
					})
					.catch(function (error) {
						console.log(error);
					});
			},
			getChange: function (event) {
				app.debug = '';
				axios.post('/get_change/')
					.then(function (response) {
						if(response.data.error) {
							app.debug = response.data.error;
						}else if(response.data) {
							app.update(response.data);
						}
					})
					.catch(function (error) {
						console.log(error);
					});
			},
			update: function (data) {
				if(data.coffeeMachine != undefined){
					this.coffeeMachine = data.coffeeMachine;
				}
				if(data.user != undefined){
					this.user = data.user;
				}
				if(data.debug != undefined){
					this.debug = data.debug;
				}
			}
		},

		data: appData
	});
});


