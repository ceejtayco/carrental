<?PHP
	function sendMessage(){
		$content = array(
			"en" => 'A new booking request has been made!'
			);
		
		
		//Note: for matching ID of lender with vehicle from SESSION variable 
		$fields = array(
			'app_id' => "03243a75-a927-4b5c-bcbd-0554406044e0",
			'filters' => array(array("field" => "tag", "key" => "userType", "relation" => "=", "value" => "landlord"),array("operator" => "AND"),array("field" => "tag", "key" => "userId", "relation" => "=", "value" => $_SESSION['lenderid'])),
			'url' => 'https://ezrent.online/manage-bookings.php',
			'data' => array("user_type" => "landlord"),
			'contents' => $content,
				
		);
		
		$fields = json_encode($fields);
		
		//for sending responses to Onesignal API(?)
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NTg4NGExYzctY2I0ZS00ZTdiLTg5OWYtYWM0NjgxZWVkYTQw'));
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