<?php

$con = mysqli_connect('localhost','root','','taxi_share');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

?>

<?php




 $sql ="SELECT * FROM tbl_price ORDER BY `tbl_price`.`id` DESC
LIMIT 0 ,50" ;

//$sql = "SELECT *
//FROM share_hapnn  INNER JOIN  share_pin on share_hapnn.id=share_pin.pin_id WHERE newsid = ".$_GET['id'];

$result = mysqli_query($con,$sql);



		//$data = array();
		$dataArray = array();
while($row = mysqli_fetch_array($result)) {
							$yellow_taxi = $row['yellow_taxi'];
							$private_taxi = $row['private_taxi'];
							
							
	
		
		$data=array("yellow_taxi"=>$yellow_taxi,"private_taxi"=>$private_taxi);
		array_push($dataArray,$data);
		/*$data['what']=$what;
		$data['date']=$date;
		$data['detail']=$detail;
		$data['img']=$path;*/
	}
		
		
		echo json_encode($dataArray);
	
	
		//echo "kjkhkjshfdslhlk";	
		//}
		//else
		//{
			//echo "Error Invalid Input";

		//}


?>