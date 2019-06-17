<?php 

   /**
    * 
    */
   class DbOperations 
   {
   	private $con;
   	
   	function __construct()
   	{
   		require_once dirname(__FILE__).'/DbConnect.php';
   		$db = new DbConnect();
   		$this->con = $db->connect();
   	}

     	public function createUser($username, $pass, $email, $cpassword){  
     	 if($this->getUserByUsername($username)){
          return 4;}

       if($this->isUserExist($username, $email)){

         if ($pass == $cpassword){
     			  $password = md5($pass);
            $stmt = $this->con->prepare("INSERT INTO users(id, username, password, email) VALUES(NULL, ?, ?, ?) ");
            $stmt->bind_param("sss", $username,$password,$email);
            if($stmt->execute()){
              return 1;
            }else{
              return 2;
              } 

     		}else{

     		return 3;
      }

   	}else{
      return 0;
    }
   }
   

public function patientAppointment($username, $speciality, $doctor, $appdate, $apptime, $symptoms){  
          if($this->duplicateappointment($doctor, $appdate, $apptime)){
          return 3;
      }else{ 
        $stmt = $this->con->prepare("INSERT INTO appointment(id, patient_no, doctor_speciality, doctor_name, appdate, apptime, symptoms) VALUES(NULL, ?, ?, ?,?,?,?) ");
            $stmt->bind_param("ssssss", $username,$speciality,$doctor,$appdate,$apptime,$symptoms);
            if($stmt->execute()){
              return 1;
            }else{
              return 2;
              }
      }
  }

    


public function duplicateappointment($doctor, $appdate, $apptime){
   		
   		$stmt = $this->con->prepare("SELECT * FROM appointment WHERE doctor_name = ?  AND appdate = ? AND apptime = ? ");
   		$stmt->bind_param("sss", $doctor,$appdate,$apptime);
   		$stmt->execute();
   		$stmt->store_result();
   		return $stmt->num_rows > 0;
   	}

   

   	public function userLogin($username, $pass){
   		$password = md5($pass);
   		$stmt = $this->con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
   		$stmt->bind_param("ss", $username, $password);
   		$stmt->execute();
   		$stmt->store_result();
   		return $stmt->num_rows > 0;
   	}

   	  public function getUserByUsername($username){
        $stmt = $this->con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

     private function IsNullOrEmptyString($str){
       if(!isset($str) || trim($str) === ''){
        return true;
       }else{
        return false;
       }
}

   	private function isUserExist($username, $email){
   		$stmt = $this->con->prepare("SELECT * FROM patient WHERE rak_no = ? AND email = ?");
        $stmt->bind_param("ss", $username,$email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
   	}
   
   }
?>