<?php
require("dbconnect.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])!="" ) {
	//you are already logged in
  header("Location: index.php");
 }
 
 $error = false;
 
if(isset($_POST['sub']))
{
	//$nme = mysql_real_escape_string($_POST['usrnme']);
	//$psd = mysql_real_escape_string($_POST['usrpwd']);
	//var_dump($_POST);
	
	$name = trim($_POST['user_n']);
	$name = strip_tags($name);
	$name = addslashes($name);
	$name = htmlspecialchars($name);
	
	$pass = trim($_POST['password']);
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
	
   $query = "SELECT * FROM MMR_USERS cu WHERE UPPER(cu.USER_NAME) = UPPER('".$name."') AND cu.USER_PASS = '".$pass."' AND  cu.user_Active = '1'";
	
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
			
			if(!empty($row['USER_EMAIL']))
			{
					 $_SESSION['user'] 	 = $row['USER_NAME'];
					 $_SESSION['userid'] = $row['USER_ID'];
					 //$_SESSION['groups'] = $row['GROUP_ID'];//OP_CREATE OP_DEL OP_EDIT OP_READ 
					 //$_SESSION['roles']  = $row['ROLE'];
					 header("Location: index.php");
			} else {
					$errMSG = "Incorrect Credentials, Try again...";
				   
				}
			
		}
		
		}
		else;
            //print "\$stmt is [$stmt]&lt;br /&gt;";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - Dashboard Admin Template</title>
    <!--

    Template 2108 Dashboard

	http://www.tooplate.com/view/2108-dashboard

    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body class="bg03">
    <div class="container">
       
		 <nav class="navbar-light bg-light" style="opacity: 0.8; border-radius: 25px; border: 2px solid #73AD21;">
							<form action="#" method="post" class="tm-login-form">
							
							<table align="center">
									<tr>
										<td><b>Username :</b></td>
										<td>
											 <input  type="text" id="user_n" name="user_n" placeholder="User Name">
									    </td>
										<td><b>Password :</b></td>
										<td>
										<input   type="password" id="password" name="password" placeholder="Password">
										</td>
										<td>
											<button type="submit" name="sub"  class="btn btn-primary d-inline-block mx-auto">Sign In</button>
											<button type="submit" name="sub"  class="btn btn-primary d-inline-block mx-auto">Sign Up</button>
											<a href="#">Forgot Password ?</a>
									   </td>
									</tr>
							</table>
						</form>
		</nav>
		
		 <div class="row tm-content-row tm-mt-big" id="main-content" >
		 
		   <div class="col-lg-12">
                   
		   <div class="row" >
                 <div class="col-lg-4 p-1">
                    <div class="tm-block h-100"  style="opacity: 0.7;">
                       <!-- <h2 class="tm-block-title">Overview</h2>-->
						<iframe id="ifrm1" src="graphs/project_chart_SV.php" scrolling="no" style="overflow-y: hidden;" width="100%" height="370px"></iframe>                        
                    </div>
                </div>
                <div class="col-lg-4 p-1">
                    <div class="tm-block h-100" style="opacity: 0.7;">
                       <!--  <h2 class="tm-block-title">Project Performance Summary</h2>-->
						<iframe id="ifrm1" src="graphs/project_chart_CPI.php" scrolling="no" style="overflow-y: hidden;" height="371px" width="100%" ></iframe>
                    </div>
                </div>
				
				
				  <div class="col-lg-4 p-1">
                    <div class="tm-block h-100" style="opacity: 0.7;">
                          <!--  <h2 class="tm-block-title">Project Performance </h2>-->
							<iframe id="ifrm1" src="graphs/project_chart_CPI.php" scrolling="no" style="overflow-y: hidden;" height="370px" width="100%" ></iframe>
                    </div>
                </div>
				
			 <div  class="tm-col col-lg-4 p-1">
                <div class="tm-block h-100" style="opacity: 0.7;">
				<!-- <h2 class="tm-block-title">Schedule Performance Index</h2>-->
					<iframe id="ifrm_spi" src="graphs/project_chart_SPI.php" scrolling="no" style="overflow-y: hidden;" height="370px" width="100%"></iframe>
				</div>
              </div>
			  
			   <div class="tm-col col-lg-4 p-1">
                <div class="tm-block h-100" style="opacity: 0.7;">
			  			<!-- <h2 class="tm-block-title">Cost Performance Index</h2>-->
						<iframe id="ifrm_cpi"  src="graphs/project_chart_CPI.php" scrolling="no" style="overflow-y: hidden;" height="370px" width="100%"></iframe>
				</div>
              </div>
			  
			   <div class="tm-col col-lg-4 p-1">
                <div class="tm-block h-100" style="opacity: 0.7;">
			  			<!-- <h2 class="tm-block-title">Cost Performance Index</h2>-->
						<iframe id="ifrm_cpi" src="graphs/project_chart_CV.php" scrolling="no" style="overflow-y: hidden;" height="370px" width="100%"></iframe>
				</div>
              </div>
			  
			 
			  
				
			</div>
			
			</div>
          </div>
		
               
		
        <footer class="row tm-mt-big">
		 <div class="col-12 font-weight-light text-center">
                    <p class="d-inline-block tm-bg-black text-white py-2 px-4">
                        Copyright &copy; 2018. Created by
                        <a href="http://www.nlc.com.pk" class="text-white tm-footer-link">NLC</a> |  Distributed by <a href="" class="text-white tm-footer-link">Software Section</a>
                    </p>
                </div>
        </footer>
    </div>
</body>

</html>