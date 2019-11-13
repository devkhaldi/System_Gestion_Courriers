var app = new Vue({
	el: '#app',
	data: {
		courrier: {},
		piecejointes: [],
		status: '',
		services: [],
		employes: []
	},
	methods: {
		getCourrier: function(id_courrier) {
			axios
				.get(window.Laravel.url + '/courrier/' + id_courrier)
				.then((response) => {
					console.log('success : ', response);
					this.courrier = response.data;
					this.getPiecejointes(id_courrier);
					this.getStatusCourrier(id_courrier);
				})
				.catch((error) => {
					console.log('errors : ', error);
				});
		},
		getPiecejointes: function(id_courrier) {
			axios
				.get(window.Laravel.url + '/piecejointe/' + id_courrier)
				.then((response) => {
					console.log('success : ', response);
					this.piecejointes = response.data;
				})
				.catch((error) => {
					console.log('errors : ', error);
				});
		},
		getStatusCourrier: function(id_courrier) {
			axios
				.get(window.Laravel.url + '/courrier/status/' + id_courrier)
				.then((response) => {
					console.log('success : ', response.data[0].status);
					if (response.data[0].status) {
						this.status = response.data[0].status;
					}
				})
				.catch((error) => {
					console.log('errors : ', error);
				});
		},
		getstatuscourrier: function(id_courrier) {
			this.services = [];
			this.employes = [];
			axios
				.get(window.Laravel.url + '/courrier/statuscourrier/' + id_courrier)
				.then((response) => {
					console.log('success : ', response);
					var services = response.data.services;

					services.forEach((service) => {
						var s = {
							nom: '',
							status: '',
							employes: []
						};
						s.nom = service.nom;
						s.status = service.status;
						var employes = response.data.employes;

						employes.forEach((employe) => {
							if (employe.service_id == service.id) {
								var emp = {
									service: '',
									statusenvoi: '',
									name: '',
									status: ''
								};
								emp.service = s.nom;
								emp.statusenvoi = s.status;
								emp.name = employe.name;
								emp.status = employe.status;
								this.employes.push(emp);
								s.employes.push(emp);
							}
						});
						if (s.status == 'nonvalide') {
							this.services.push(s);
						}

						console.log(' services ', this.services);
					});
				})
				.catch((error) => {
					console.log('errors : ', error);
				});
		}
	}
});
