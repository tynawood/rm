
<?php 
		error_reporting(0);
		ini_set("max_execution_time","300000");
		require_once("mpower.php"); 
		require_once("../script/config.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST['submit'])){
	
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	//die;
	}else{
		
		//echo "No data Posted";
		//die;
		}
		echo "<img src='final.gif' width='100%' height='780' />";
		sleep(3);
		//die;
		$live =  !false;
		if($live == false)	{
		MPower_Setup::setMasterKey("90a2f8a1-7f7b-471f-bdb4-268a270985d4");
		MPower_Setup::setPublicKey("test_public_rg2qugm3CWU2J-xvi14KE4-AYGY");
		MPower_Setup::setPrivateKey("test_private_eBw1XNZOWtx8XTvDMuZCDZot8I4");
		MPower_Setup::setMode("test");
		MPower_Setup::setToken("0b8275226b2ec2da5458");
		}else{
		MPower_Setup::setMasterKey("90a2f8a1-7f7b-471f-bdb4-268a270985d4");
		MPower_Setup::setPublicKey("live_public_qj5brK9VO3LbA8xSPE8IPtyExf4");
		MPower_Setup::setPrivateKey("live_private_b1wT60n7jXB4zlMaC67gIjNDC3s");
		MPower_Setup::setMode("live");
		MPower_Setup::setToken("314891080ac32d5c94de");
		}
		// Configure Checkout Store
		MPower_Checkout_Store::setName("CND GLOBAL FASHION");
		MPower_Checkout_Store::setTagline("A Touch Of African Fashion");
		MPower_Checkout_Store::setPhoneNumber("+3361877452626/+336752517819");
		MPower_Checkout_Store::setPostalAddress("130 Grande Rue 92310 \n Paris Servres");
		//$invoice = new MPower_Checkout();
		$invoice = new MPower_Checkout_Invoice();
		
		$invoice->setCancelUrl("http://www.cndglobalfashion.com/Mpower/Cancel.php");
		$invoice->setReturnUrl("http://www.cndglobalfashion.com/Mpower/Success.php");
		
		/* Adding items to your invoice is very basic, the parameters expected are
		name_of_item, quantity, unit_price, total_price and optional item
		description. */
			@session_start();
		//@session_destroy();
	  	$i=0;
		$ids="";
		$q=0;
		$total=0.00;
		$tax=2.00;
	  	for(;$i<count($_SESSION['cartid']);$i++){
			$ids.=" id =".$_SESSION['cartid'][$i];
			if($i+1<count($_SESSION['cartid']))
			$ids.=" OR ";
			}
	  	
	  	$sql="SELECT * FROM product where ".$ids;
		
		$query=mysql_query( $sql );
		/*
		if(mysql_num_rows($query)){}
		print_r($sql.$ids);
		die;
		*/
	    	while($row=mysql_fetch_assoc($query)){
			$total+=$row['product_price']*$_SESSION['qty'][$q];
			 $tax=/*$row['tax']+*/2/100*$row['product_price']*$_SESSION['qty'][$q];
		   
			
		$invoice->addItem(
		$row['product_name'],
		$_SESSION['qty'][$q],
		$row['product_price'],
		$row['product_price']*$_SESSION['qty'][$q]);
			}
			
		//$invoice->addItem("Case Logic laptop Bag",2,100.50,201,"Optional description");
		//$invoice->addItem("Philips electric shaver",2,50.50,101.00);
		 
		/* You can optionally set a general invoice description text which can
		be used in cases where your invoice does not need an items list or in cases
		where you need to include some extra descriptive information to your invoice */
		$invoice->setDescription("Please Confirm Your Order");
		$invoice->setTotalAmount($total);
		
		
		
		
		if($invoice->create()) {
		//header("Location: ".getDirectCreditcardChargeUrl();
		header("Location: ".$invoice->getInvoiceUrl()."#debitcard");
		}else{
		echo $invoice->response_text;
		
		}
		
		
		/*if($invoice->confirm($invoice->token)){
			
			echo $invoice->token;
			}*/
		
		
		
		
		
		


?>
</body>
</html>