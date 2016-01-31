<?php

$con = mysqli_connect('localhost','root','','taxi_share');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

?>

<?php

$lat1 = $_GET['latitude'];
							$lon1 = $_GET['longitude'];
							$d =10;
							$r = 3959;
							
							//compute max and min latitudes / longitudes for search square
							$latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
							$latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
							$lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
							$lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));


 	$query = "SELECT * FROM driver_info WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND (latitude != $lat1 AND longitude != $lon1) AND driver_status = 'online' ORDER BY id";
//$sql = "SELECT *
//FROM share_hapnn  INNER JOIN  share_pin on share_hapnn.id=share_pin.pin_id WHERE newsid = ".$_GET['id'];

$result = mysqli_query($con,$query);



		//$data = array();
		$dataArray = array();
while($row = mysqli_fetch_array($result)) {
							$name = $row['driver_name'];
							$mobile = $row['driver_number'];
							$car_number = $row['vehicle_number'];
								$nationality = $row['driver_nationality'];
									$car_model = $row['car_model'];
							//$private_taxi = $row['private_taxi'];
							
							
	
		
		$data=array("name"=>$name,"mobile"=>$mobile,"car_number"=>$car_number,"nationality"=>$nationality,"car_model"=>$car_model);
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