<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }
include("page_access.php");
?>

<html>
<title>SMS-GW Grouping</title>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="dist/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="dist/style.min.css" />
    <script src="dist/jquery-2.2.4.js"></script>
    <script src="dist/jstree.min.js"></script>
	<link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>


<body>

<div id="wrapper">
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Communication & Alerts</a>
            </div>
			<div style="float:right;color:white;padding-right:10px;"><dt>You are Logged in as:</dt>
			<kbd>
			<?php echo($_SESSION['user']); ?>
			</kbd>&nbsp
			
			
			
			<button type="submit" class="btn btn-danger btn-xs" id="sublg" name="sublg" onclick="window.location.href = 'sms_LgOut.php'; ">
			<span class="glyphicon glyphicon-log-out" aria-hidden="true" ><span style="font-family: Menlo,Monaco,Consolas,\"Courier New\",monospace; ">&nbsp LogOut &nbsp</span></span>
			</button>
			</div>
			
			
			
			<div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php include("sms_menu.php"); ?>
            </div>
			
 </nav>
 
 
	<div id="page-wrapper" style="background-image: url('images/smsback.png');">
    <!-- YOUR CONTENT GOES HERE -->
		<div class="container-fluid">
			  <div class="row">
                    <div class="col-lg-12">
                        
                           <img src="images/gateway1.jpg" height="140px" width="100%" />
                        
                    </div>
                </div>
			
			<div class="table-responsive">
				<div class="container">
				<h3> Audit Trail </h3>

<?php

require("dbconnect.php");

$query = "SELECT l.LOG_ID,l.ACTION,l.U_ID,u.USER_NAME,l.A_DATE,u.USER_EMAIL FROM CFG_GROUP_LOG l LEFT JOIN CFG_USERS u ON l.U_ID = u.USER_ID ORDER BY log_id DESC";
$stmt = oci_parse($db, $query);
if (!is_null($stmt))
{
oci_execute($stmt);

echo '<div class="form-group input-group"><input type="text" class="form-control"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div>';
echo "<div ><table class='table table-bordered table-hover table-striped' style='overflow-y:scroll;' width='100%' border='1'>";
echo "<th>LOG ID</th>";
echo "<th>ACTION</th>";
echo "<th>User ID</th>";
echo "<th>Username</th>";
echo "<th>Action DATE</th>";

$imgc = 0;
while($row=oci_fetch_array($stmt))
{
$imgc++;
echo "<tr>";
echo '<td>'.$row[0].'</td>';
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "</tr>";
}
echo "</table></div>";
}

?>

				
           
				</div>
		</div>
	</div>

	</div>
	
</div>

</body>

</html>