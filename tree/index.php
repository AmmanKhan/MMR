<?php
 //include("ECP_ERR_MSG.php");
require("dbconnect.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( isset($_SESSION['user'])!="" ) {
	//you are already logged in
  header("Location: home.php");
}
 
 $error = false;
 
if(isset($_POST['sub']))
{
	//$nme = mysql_real_escape_string($_POST['usrnme']);
	//$psd = mysql_real_escape_string($_POST['usrpwd']);
	//var_dump($_POST);
	
	
	$name = trim($_POST['usrnme']);
	$name = strip_tags($name);
	$name = addslashes($name);
	$name = htmlspecialchars($name);
	
	$pass = trim($_POST['usrpwd']);
	$pass = strip_tags($pass);
	$pass = addslashes($pass);
    $pass = htmlspecialchars($pass);
	
	if(empty($name)){
	   $error = true;
	   $nameError = "Please enter your Name.";
	}	  
	elseif(strlen($name) < 3){
		$error = true;
		$nameError = "Please enter your Name.";
	}

	if(empty($pass)){
	   $error = true;
	   $passError = "Please enter your password.";
	  }
	  elseif(strlen($pass) < 3){
	   $error = true;
	   $passError = "Please enter your password.";
	  }
	  
  
	if (!$error) {
	
    //$query = "SELECT USER_NAME,USER_ID,USER_EMAIL FROM CFG_USERS WHERE UPPER(USER_NAME) = UPPER('".$name."') AND USER_PASS = '".$pass."' AND MIS_ID = '5' " ;
	$query = "SELECT cu.USER_NAME,cu.USER_ID,cu.USER_EMAIL,ga.GROUP_ID,ga.OP_CREATE,ga.OP_DEL,ga.OP_EDIT,ga.OP_READ,cu.ROLE 
				FROM MMR_USERS cu LEFT JOIN CFG_GROUP_ACCESS ga ON cu.USER_ID = ga.USER_ID  
				WHERE UPPER(cu.USER_NAME) = UPPER('".$name."') AND cu.USER_PASS = '".$pass."' AND cu.MIS_ID = '5'  AND cu.status_id = '1'";
	
	
	//echo $query;
	//exit;
	require_once("dbconnect.php");
	
	
	try {
        $stmt = oci_parse($db, $query);
		//echo $stmt; exit();
        if (!is_null($stmt))
        {
        oci_execute($stmt);
		
		
		
	
   	while($row=oci_fetch_array($stmt))
		{
			//echo($row['U_NAME']);
			//var_dump($row);
			if(!empty($row['USER_EMAIL']))
			{
					 $_SESSION['user'] 	 = $row['USER_NAME'];
					 $_SESSION['userid'] = $row['USER_ID'];
					 $_SESSION['groups'] = $row['GROUP_ID'];//OP_CREATE OP_DEL OP_EDIT OP_READ 
					 $_SESSION['roles']  = $row['ROLE'];
					 header("Location: admin.php");
			} else {
					$errMSG = "Incorrect Credentials, Try again...";
				   
				}
			
			
		}
		
		}
		else
            //print "\$stmt is [$stmt]&lt;br /&gt;";
				;
	
	
	}
	catch (PDOException $ex) {
        // For testing, you could use a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one:
        $response["success"] = 0;
        $response["message"] = "Database Error2. Please Try Again!";
        die(json_encode($response));
    }
	oci_free_statement($stmt);
	oci_close($db);
	
    
        
}


}




?>
<!-- DOCTYPE -->
<html lang="en">
<head>
  <title>SMS-GW Grouping</title>
  <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Viewport Meta Tag -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bs/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
 
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="IE_8/html5shiv.js"></script>
            <script src="IE_8/respond.min.js"></script>
        <![endif]-->
 
</head>
<body>
	
  <!-- YOUR CONTENT GOES HERE -->
  <div class="container-fluid">
	<div class="row" style="padding:0 10%;">
		 <img src="images/gateway1.jpg" height="150px" width="100%"  alt="logo" />
	</div>
	</br></br></br>
	<div class="row" >
		<div class = "col-lg-5 col-lg-offset-1">
			<img src="images/sms.png" class="img-responsive" style="margin-left: auto; margin-right: auto; display: block;" alt="logo">
		</div>
		<div class = "col-lg-3 col-lg-offset-1" style="background: rgba(0,0,0,0.4);">
		
				
				
			<p class="h1 text-center"><kbd>&nbsp;<img src="images/login.png" style="width:5%;" />&nbsp; Login &nbsp;</kbd></p>
			</br>
			
				<form action="#" class=".form-horizontal" method="post">
					<div class="form-group ">
						<label for="usrnme">User Name</label>
						<input type="text" class="form-control" id="usrnme" name="usrnme">
					</div>
					<div class="form-group ">
						<label for="usrpwd">Password</label>
						<input type="password" class="form-control" id="usrpwd" name="usrpwd">
					</div>
					
						<button type="submit" class="btn btn-success" name="sub">Submit</button>
				</form>
			
				<br />
		</div>
		<div class = "col-lg-2"></div>
		
	</div>
	</br>

	
    </div>   <!-- Container Div -->

  <!-- JavaScript: placed at the end of the document so the pages load faster -->
  <!-- JQuery -->
  <script src="bs/js/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="bs/js/bootstrap.min.js"></script>
</body>
</html>