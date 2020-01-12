<?PHP
	function sendMessage(){
		$content = array(
			"en" => 'A new booking has been made!'
			);
		
		
		//Note: for matching ID of lender with vehicle from SESSION variable 
		$fields = array(
			'app_id' => "2e1738f0-3d6a-46c4-9513-cb95ebf3e894",
			'filters' => array(array("field" => "tag", "key" => "user_type", "relation" => "=", "value" => "0"),array("operator" => "AND"),array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => $_SESSION['lenderid'])),
			'data' => array("user_type" => "1"),
			'url' => 'https://ezrent.online/manage-bookings.php',
			'contents' => $content,
				
		);
		
		$fields = json_encode($fields);
		
		//for sending responses to Onesignal API(?)
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic OGI2YmI2YzctYjAyYy00NDM1LTlmMGYtYmU2NjY4Y2E3MzAx'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
		
	}
	
$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);

?>