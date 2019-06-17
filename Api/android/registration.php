<?php 

  require_once'../includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(
		isset($_POST['username']) and
	    isset($_POST['password']) and
	    isset($_POST['email'])and 
	    isset($_POST['cpassword']))
	{

		/*$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		*/
		if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['cpassword']) ){


		//execute further
		$db = new DbOperations();
		$result = $db->createUser(//$username, $password, $email);
		                 $_POST['username'],
					     $_POST['password'],
					     $_POST['email'],
		                 $_POST['cpassword']);
                      
					 
		if($result == 1)
	      {
			$response['error'] = false;
	        $response['message'] = "User Registered";
		}elseif($result == 2) {
			$response['error']=true;
	        $response['message']="try again an error occurs";
		}
	    elseif($result == 3){
			$response['error'] = true;
	        $response['message'] = "Password do not match";
	}
	 elseif($result == 0){
			$response['error']=true;
	        $response['message']="Enter your valid RAK Number and Email";
	}
	elseif($result == 4){
			$response['error']=true;
	        $response['message']="You are already registered, Please log in";
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