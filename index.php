  <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: login.php");
  exit;
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MMR Engr Dashboard</title>
    <!--

    Template 2108 Dashboard

	http://www.tooplate.com/view/2108-dashboard

    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <!-- https://fullcalendar.io/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="reportsPage">
    <div class="" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light">
                        <a class="navbar-brand" href="#">
						
						
                            <img src="img/nlc.png" width="150px" height="" />
                            &nbsp;<h4>Monthly Monitoring System</h1>
                        </a>
                        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" id="btn1_dashboard" href="#">Dashboard
                                        <!--<span class="sr-only">(kcurrent)</span>-->
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" id="btn1_welcome" href="#">Project Monitoring</a>
                                        <a class="dropdown-item" href="#">Daily Report</a>
                                        <a class="dropdown-item" href="#">Weekly Report</a>
                                        <a class="dropdown-item" href="#">Yearly Report</a>
                                    </div>
                                </li>
                                <!--<li class="nav-item" >
                                    <a class="nav-link" id="btn1_welcome" href="#">Project Monitoring</a>
                                </li>-->

                                <li class="nav-item">
                                    <a class="nav-link" id="btn1_account" href="#">Accounts</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle nw_prj" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Project Settings
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" id="configurations">Project Progress</a>
                                        <a class="dropdown-item" id="new_project">New Project</a>
                                       <!-- <a class="dropdown-item" href="#">Add Features</a>
										<a class="dropdown-item" href="#">Add Clients</a>-->
                                    </div>
                                </li>
								
								
								
                            </ul>
                            <ul class="navbar-nav">
								<li class="nav-item">	
										<br /><u>
											<a id="btn1_account" href="#"><span><?php echo($_SESSION['user']); ?> is logged In</span></a>
										</u>
                                </li>
								
                                <li class="nav-item">
                                    <a class="nav-link d-flex" href="logout.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row tm-mt-big" id="main-content" >
                
            </div>
            <footer class="row tm-mt-small">
                <div class="col-12 font-weight-light">
                    <p class="d-inline-block tm-bg-black text-white py-2 px-4">
                       Copyright &copy; 2018. Created by
                        <a href="http://www.nlc.com.pk" class="text-white tm-footer-link">NLC</a> |  Distributed by <a href="" class="text-white tm-footer-link">Software Section</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
	
	<script src="js/jquery-3.3.1.min.js"></script>
   
	
	
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/utils.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/fullcalendar.min.js"></script>
    <!-- https://fullcalendar.io/ -->
	<script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    
	<link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />	
	
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
   
	
	<script>
    $(document).ready(function() {
		
		$("#main-content").load('dashboard.php');
		
			$('#btn1_dashboard').addClass("active");
			$('#btn1_welcome').removeClass("active");
			$('#btn1_account').removeClass("active");
			$('.nw_prj').removeClass("active");
			$('#configurations').removeClass("active");
			$('#new_project').removeClass("active");
		
		$('#btn1_dashboard').click(function() {
			$("#main-content").load('dashboard.php');
			$('#btn1_dashboard').addClass("active");
			$('#btn1_welcome').removeClass("active");
			$('#btn1_account').removeClass("active");
			$('.nw_prj').removeClass("active");
			$('#configurations').removeClass("active");
			$('#new_project').removeClass("active");
			
			
		});
		
		$('#btn1_welcome').click(function() {
			$("#main-content").load('project_status.php');
			$('#btn1_dashboard').removeClass("active");
			$('#btn1_account').removeClass("active");
			$('#btn1_welcome').addClass("active");
			$('.nw_prj').removeClass("active");
			$('#configurations').removeClass("active");
			$('#new_project').removeClass("active");
		});
		
		$('#btn1_account').click(function() {
			$("#main-content").load('accounts.php');
			$('#btn1_dashboard').removeClass("active");
			$('#btn1_welcome').removeClass("active");
			$('#btn1_account').addClass("active");
			$('.nw_prj').removeClass("active");
			$('#configurations').removeClass("active");
			$('#new_project').removeClass("active");
			
		});
		
		$('#configurations').click(function() {
			$("#main-content").load('configurations.php');
			$('#btn1_dashboard').removeClass("active");
			$('#btn1_welcome').removeClass("active");
			$('#btn1_account').removeClass("active");
			$('.nw_prj').addClass("active");
			$('#configurations').addClass("active");
			$('#new_project').removeClass("active");			
		});
		
		$('#new_project').click(function() {
			$("#main-content").load('add_project.php');
			$('#btn1_dashboard').removeClass("active");
			$('#btn1_welcome').removeClass("active");
			$('#btn1_account').removeClass("active");
			$('#configurations').removeClass("active");
			$('#new_project').addClass("active");	
			$('.nw_prj').addClass("active");
		});
		
		
		
	});		    
		
    </script>
	
	
</body>
</html>