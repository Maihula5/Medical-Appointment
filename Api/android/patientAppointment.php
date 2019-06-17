<?php 

  require_once'../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(
		isset($_POST['username']) and
	    isset($_POST['speciality']) and
	    isset($_POST['doctor'])and
	    isset($_POST['appdate'])and
        isset($_POST['apptime'])and
        isset($_POST['symptoms']))
	{

		/*$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		*/
		if(!empty($_POST['username']) && !empty($_POST['speciality']) && !empty($_POST['doctor']) && !empty($_POST['appdate']) && !empty($_POST['apptime']) && !empty($_POST['symptoms'])){


		//execute further
		$db = new DbOperations();
		$result = $db->patientAppointment(//$username, $password, $email);
		                 $_POST['username'],
					     $_POST['speciality'],
					     $_POST['doctor'],
					     $_POST['appdate'],
					     $_POST['apptime'],
					     $_POST['symptoms']);
                      
					 
		if($result == 1)
	      {
			$response['error'] = false;
	        $response['message'] = "Appontment Registered Succesfully";
		}elseif($result == 2) {
			$response['error']=true;
	        $response['message']="try again an error occurs";
		}
	  elseif($result == 3) {
			$response['error']=true;
	        $response['message']="Sorry The Doctor isnt free this time, try selecting a different date or time ";
		}
	  

	}else{
		$response['error'] = true;
	    $response['message'] = "required filled missing";
}
	 

	}
		else{
			$response['error']=true;
			$response['message']="invalid request ";
}
}
		else{
			$response['error']=true;
			$response['message']="invalid request y";
}
  echo json_encode($response);

?>