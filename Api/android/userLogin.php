<?php 

	require_once'../includes/DbOperations.php';
	$response = array();
	if($_SERVER['REQUEST_METHOD']=='POST'){
      if(
		isset($_POST['username']) and
	    isset($_POST['password'])){

      	if(!empty($_POST['username']) && !empty($_POST['password']) ){


      	
      	 $db =  new DbOperations();

      	  if($db->userLogin($_POST['username'], $_POST['password']))  {
      	  	 $user = $db->getUserByUsername($_POST['username']);
      	  	   $response['error'] = false;
			   $response['id'] = $user['id'];
			   $response['username']= $user['username'];
			   $response['email'] = $user['email'];

      	  }else{
      	  	$response['error']= true;
			$response['message']= "incorrect details ";
      	  }
      }else{

            $response['error']= true;
			$response['message']= "Please fill all fields ";
}      
	}
	else{
		    $response['error']= true;
			$response['message']= "Some Error Occured ";

	}
	}
	else{
		    $response['error']= true;
			$response['message']= "invalid request ";

	}

	echo json_encode($response);

?>