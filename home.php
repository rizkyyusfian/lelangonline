<?php 
	session_start();
	if(!isset($_SESSION['mylogin_username']))
	{
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>AuksienOnline | Home</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href=""/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->

		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<form class="search-form" role="form" action="index.html" method="get">
						<div class="input-icon right">
							<i class="icon-magnifier"></i>
							<input type="text" class="form-control" name="query" placeholder="Search...">
						</div>
					</form>
				</li>
				<li class="start active ">
					<a href="#">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>
				<li >
					<a href="add.php">
					<i class="fa fa-plus"></i>
					<span class="title">Add Item</span>
					</a>
				</li>
				<li >
					<a href="process/login_process.php?action=logout">
					<i class="fa fa-level-down"></i>
					<span class="title">Log Out</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
		<h1>Welcome <b><?php echo $_SESSION['mylogin_username'] ?></b></h1>
		<p>
		<?php
				if(isset($_SESSION['statusAdd'])) 
				{
					echo $_SESSION['statusAdd'];
					unset($_SESSION['statusAdd']);
				}
			?>
		</p>
		<h3><b>List Items</b></h3>
<table class="table" id="tes1">
	<thead>
		<tr>
			<th>Id Item</th>
			<th>Owner</th>
			<th>Item Name</th>
			<th>Date Posted</th>
			<th>Initial Price</th>
			<th>Status</th>
			<th>Image</th>
			<th>Detail</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$mysqli = new mysqli("localhost", "root", "", "mtt_lelangonline");

		$sql = "select items.iditem, items.iduser_owner, users.name as owner, items.name, items.date_posting, items.price_initial, items.status, items.image_extension from items INNER JOIN users on items.iduser_owner = users.iduser";
		$stmt = $mysqli->prepare($sql);

		$stmt->execute();
		$result = $stmt->get_result();
		$hasil = "";
		while($row = $result->fetch_assoc())
		{
			$hasil = $hasil."<tr>";
			$hasil .= "<td>".$row['iditem']."</td>";
			$hasil .= "<td>".$row['owner']."</td>";
			if($row['status'] == "OPEN")
			{
				$url    = "detail.php?iditem=".$row['iditem']."&iduser_owner=".$row['iduser_owner']."&price_initial=".$row['price_initial'];
				$hasil .= "<td><b><a style='color:blue; text-decoration:none;' href='$url'>".$row['name']."</a></b></td>";
			}
			else if($row['iduser_owner'] == $_SESSION['mylogin_username'])
			{
				$url    = "detail.php?iditem=".$row['iditem']."&iduser_owner=".$row['iduser_owner']."&price_initial=".$row['price_initial'];
				$hasil .= "<td><b><a href='$url'>".$row['name']."</a></b></td>";
			}
			else if($row['status'] == "SOLD")
			{
				$url    = "detail.php?iditem=".$row['iditem']."&iduser_owner=".$row['iduser_owner']."&price_initial=".$row['price_initial'];
				$hasil .= "<td><b><a href='$url'>".$row['name']."</a></b></td>";
			}
			else
			{
				$hasil .= "<td><b>".$row['name']."</b></td>";
			}
			$hasil .= "<td>".$row['date_posting']."</td>";
			$hasil .= "<td>Rp. ".number_format($row['price_initial'])."</td>";
			$hasil .= "<td>".$row['status']."</td>";
			$foto   = "folder_item/".$row['name'].".".$row['image_extension'];
			$hasil .= "<td><img style='width:250px; height:200px;' src='$foto'></td>";
			if($row['iduser_owner'] == $_SESSION['mylogin_userid']) 
			{
				if($row['status'] == "OPEN")
				{
					$hasil .= "<td>Item is <b>OPEN</b> for bid.<br>To cancel click :<br><form method='POST' action='process/home_process.php?iditem=".$row['iditem']."&iduser_owner=".$row['iduser_owner']."'><input class='btn btn-warning' type='submit' name='btnCancel' value='Cancel'></form></td>";
				}
				elseif ($row['status'] == "CANCEL") 
				{
					$hasil .= "<td>Item is <b>CLOSE</b> for bid.<br>To open click :<br><form method='POST' action='process/home_process.php?iditem=".$row['iditem']."&iduser_owner=".$row['iduser_owner']."'><input class='btn btn-info' type='submit' name='btnOpen' value='Open'></form></td>";
				}
				elseif ($row['status'] == "SOLD")
				{
					$hasil .= "<td>Item is <b>SOLD</b></td>";
				}
			}
			else
			{
				$hasil .= "<td></td>";
			}
			$hasil .= "</tr>";
		}
		echo $hasil;
		$mysqli->close();
		?>
	</tbody>
</table>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 2020 &copy; Template By MRYY.
	</div>
	<div class="footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script type="text/javascript" src="style/jquery-2.1.4.min.js"></script>
<script src="assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.peity.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>
<script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js" type="text/javascript"></script>
<script src="assets/scripts/index.js" type="text/javascript"></script>
<script src="assets/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initPeityElements();
   Index.initKnowElements();
   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
   $('#tes1').DataTable();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>