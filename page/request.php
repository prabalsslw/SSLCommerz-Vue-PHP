<?php 
	require_once("../lib/SslCommerzNotification.php");

	include("../config/db_connection.php");
	include("../config/OrderTransaction.php");

	use SslCommerz\SslCommerzNotification;

	$requestData = (array) json_decode($_POST['cart_json']);

	$post_data['total_amount'] = isset($requestData['cus_amount']) ? $requestData['cus_amount'] : "";
	$post_data['currency'] = "BDT";
	$post_data['tran_id'] = isset($_REQUEST['order']) ? $_REQUEST['order'] : "";
	//
	//# CUSTOMER INFORMATION
	$post_data['cus_name'] = isset($requestData['cus_name']) ? $requestData['cus_name'] : "John Doe";
	$post_data['cus_email'] = isset($requestData['cus_email']) ? $requestData['cus_email'] : "john.doe@email.com";
	$post_data['cus_add1'] = "Dhaka";
	$post_data['cus_add2'] = "Dhaka";
	$post_data['cus_city'] = "Dhaka";
	$post_data['cus_state'] = "Dhaka";
	$post_data['cus_postcode'] = "1000";
	$post_data['cus_country'] = "Bangladesh";
	$post_data['cus_phone'] = isset($requestData['cus_phone']) ? $requestData['cus_phone'] : "01711111111";
	$post_data['cus_fax'] = "01711111111";
	//
	//# SHIPMENT INFORMATION
	$post_data['ship_name'] = "Store Test";
	$post_data['ship_add1'] = "Dhaka";
	$post_data['ship_add2'] = "Dhaka";
	$post_data['ship_city'] = "Dhaka";
	$post_data['ship_state'] = "Dhaka";
	$post_data['ship_postcode'] = "1000";
	$post_data['ship_phone'] = "";
	$post_data['ship_country'] = "Bangladesh";
	//
	//# OPTIONAL PARAMETERS
	$post_data['value_a'] = "Regent Air";
	$post_data['value_b'] = "ref002";
	$post_data['value_c'] = "ref003";
	$post_data['value_d'] = "ref004";

	$post_data['shipping_method'] = 'NO';
	$post_data['num_of_item'] = '1';
	$post_data['product_name'] = 'Shirt';
	$post_data['product_profile'] = 'physical-goods';
	$post_data['product_category'] = 'clothing';

	# MANAGED TRANS -- NOT NEEDED
	//$post_data['multi_card_name'] = "brac_visa,dbbl_visa,city_visa,ebl_visa,brac_master,dbbl_master,city_master,ebl_master,city_amex,qcash,dbbl_nexus,bankasia,abbank,ibbl,mtbl,city";
	//$post_data['allowed_bin'] = "371598,371599,376947,376948,376949";
	//$post_data['multi_card_name'] = "bankasia,mtbl,city";


	# CART PARAMETERS
	$post_data['cart'] = json_encode(array(
	    array("sku" => "REF0001", "product" => "DHK TO BRS AC A1", "quantity" => "1", "amount" => "200.00"),
	    array("sku" => "REF0002", "product" => "DHK TO BRS AC A2", "quantity" => "1", "amount" => "200.00"),
	    array("sku" => "REF0003", "product" => "DHK TO BRS AC A3", "quantity" => "1", "amount" => "200.00"),
	    array("sku" => "REF0004", "product" => "DHK TO BRS AC A4", "quantity" => "2", "amount" => "200.00")
	));

	// $post_data['emi_option'] = "1";
	//$post_data['emi_max_inst_option'] = "9";
	//$post_data['emi_selected_inst'] = "24";


	//$post_data['product_amount'] = "0";
	//$post_data['discount_amount'] = "5";

	//$post_data['product_amount'] = "100";
	//$post_data['vat'] = "5";
	//$post_data['discount_amount'] = "5";
	//$post_data['convenience_fee'] = "3";

	//$post_data['discount_amount'] = "5";

	//$post_data['multi_card_name'] = "brac_visa,brac_master";
	//$post_data['allowed_bin'] = "408860,458763,489035,432147,432145,548895,545610,545538,432149,484096,484097,464573,539932,436475";

	# RECURRING DATA
	// $schedule = array(
	//     "refer" => "5B90BA91AA3F2", # Subscriber id which generated in Merchant Admin panel
	//     "acct_no" => "01730671731",
	//     "type" => "daily", # Recurring Schedule - monthly,weekly,daily
	//     //"dayofmonth"	=>	"24", 	# 1st day of every month
	//     //"month"		=>	"8",	# 1st day of January for Yearly Recurring
	//     //"week"	=>	"sat",	# In case, weekly recurring

	// );


	# First, save the input data into local database table `orders`
	if(!empty($requestData['cus_amount']) && !empty($_REQUEST['order'])) {
		$query = new OrderTransaction();
		$sql = $query->saveTransactionQuery($post_data);

		if ($conn_integration->query($sql) === TRUE) {

		    # Call the Payment Gateway Library
		    $sslcomz = new SslCommerzNotification();
		    $sslcomz->makePayment($post_data, 'checkout', 'plain');
		} else {
		    echo "Error: " . $sql . "<br>" . $conn_integration->error;
		}
	}
	else {
		echo "Invalid Parameter!";
	}