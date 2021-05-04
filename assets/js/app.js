var vue_det = new Vue({
	el: '#app',
	data: {
		custdet: [],
		cus_name: '',
		cus_email: '',
		cus_phone: '',
		cus_amount: ''
	},
	computed: {
		validator: function () {
			if (this.cus_name != "" && this.cus_email != "" && this.cus_phone != "" && this.cus_amount != "") {
				return true;
			} else {
				return false;
			}
		}
	},
	created: function () {
		this.initSSLScript();
	},
	methods: {
		initSSLScript() {
			let sslScript = document.querySelector("sslPaymentScript");
			if (!sslScript) {
				let script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
				script.setAttribute("id", "sslPaymentScript");
				script.src = "https://sandbox.sslcommerz.com/sslcommerz-4.1.0.min.js?" + Math.random().toString(36).substring(7);
				// script.src = "https://seamless-epay.sslcommerz.com/sslcommerz-4.1.0.min.js?" + Math.random().toString(36).substring(7);
				tag.parentNode.insertBefore(script, tag);
			}
		},
		showdata: function () {
			this.custdet.push({
				cus_name: this.cus_name,
				cus_email: this.cus_email,
				cus_phone: this.cus_phone,
				cus_amount: this.cus_amount
			});
			window.sslczPayBtn('http://localhost:8080/sslcvue/page/request.php', this.tranid(9), {
				cus_name: this.cus_name,
				cus_email: this.cus_email,
				cus_phone: this.cus_phone,
				cus_amount: this.cus_amount
			});
		},
		tranid: function (length) {
			var result = '';
			var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			var charactersLength = characters.length;
			for (var i = 0; i < length; i++) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}
			return result.toUpperCase();
		}
	}
});


