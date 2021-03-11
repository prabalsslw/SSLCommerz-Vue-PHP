<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Vue JS</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<style type="text/css">
  		.tfdl{
  			border-radius: 0px;
  			height: 40px;
  		}
  	</style>
  	
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body>

<div class="container" id="app">
	<br><br>
  	<div class="panel panel-default col-md-6 col-md-offset-3">
	  	<div class="panel-body">
	  		<img src="assets/sslcommerzsp.png" height="43" width="180" style="display: block;margin-left: auto;margin-right: auto;"><hr>

	  		<div class="form-group">
			  	<input type="text" class="form-control tfdl" v-model="cus_name" placeholder="Customer Name">
			</div>
			<div class="form-group">
			  	<input type="text" class="form-control tfdl" v-model="cus_email" placeholder="Customer Email">
			</div>
			<div class="form-group">
			  	<input type="text" class="form-control tfdl" v-model="cus_phone" placeholder="Phone">
			</div>
			<div class="form-group">
			  	<input type="number" class="form-control tfdl" v-model="cus_amount" placeholder="Amount">
			</div>
			<h5 style="color: green;" v-if="validator">Ok</h5>
			<h5 style="color: red;" v-else>Input data missing!</h5>

			<button type="button" id="sslczPayBtn" v-on:click ="showdata" class="btn btn-sm btn-primary pull-right">Pay Now</button>
		</div>
	</div>
</div>

</body>

	<script src="assets/js/app.js"></script>
</html>