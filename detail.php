<?php 
	session_start();
	date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Detail</title>
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
<script type="text/javascript" src="style/jquery-2.1.4.min.js"></script>
<style type="text/css">
	.hide {display: none;}
</style>
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
					<a href="home.php">
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
				<li>
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
			<?php
				if(isset($_SESSION['mylogin_username'])) {
					$mysqli = new mysqli("localhost", "root", "mysql", "mtt_lelangonline");

					$iditem = $_GET['iditem'];
					$iduser = $_GET['iduser_owner'];
					$idoffer = $_SESSION['mylogin_userid'];
					$is_winner = 0;
					$price = $_GET['price_initial'];
					
					$msg = "";
					if (isset($_POST['submit'])) {
						$offer = $_POST['bid'];
						if($offer >= $price) {
							if($offer >= $priceBefore) {

							}
							$sql = "insert into biddings values(?,?,?,?)";
							$stmt = $mysqli->prepare($sql);
							$stmt->bind_param("sidi", $idoffer, $iditem, $offer, $is_winner);
							$stmt->execute();
						} else {
							$msg = "Tawaran tidak boleh lebih rendah dari nilai awal bid!";
						}
					}

						// $sql = "select * from items where iditem=?";
						$sql = "select items.iditem, items.iduser_owner, users.name as owner, items.name, items.date_posting, items.price_initial, items.status, items.image_extension from items INNER JOIN users on items.iduser_owner = users.iduser where iditem=?";
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $iditem);
						$stmt->execute();
						$result = $stmt->get_result();
						
						if($row = $result->fetch_assoc()) 
						{
							echo "<h3>".$row['name']."</h3>";
							echo "Pemilik : <b>".$row['owner']."</b>";
							echo "<br>";
							echo "Nilai Awal Bid : Rp. ".number_format($row['price_initial']);
							echo "<br>";
							echo "Tanggal Postingan : ".$row['date_posting'];
							echo "<br>";
							echo "Status : ".$row['status'];
							echo "<p><img style='height:400px; width:400px;' src='folder_item/".$row['name'].".".$row['image_extension']."'' alt='".$row['name']."'></p>";

							$sql2 = "select * from biddings where iditem=? ORDER BY price_offer ASC";
							$stmt = $mysqli->prepare($sql2);
							$stmt->bind_param("i", $iditem);
							$stmt->execute();
							$result2 = $stmt->get_result();
							
							echo "<br><br>";
							echo "<h1>List Bidding</h1>";
							echo "<table class='table'>";
							echo "<thead><tr><th>Nama</th><th>Bid</th><th>Winner</th></tr></thead>";
							while ($row2 = $result2->fetch_assoc())
							{
								echo "<tbody><tr>";
								echo "<td>".$row2['iduser']."</td>";
								echo "<td>".number_format($row2['price_offer'])."</td>";
								if($row['iduser_owner'] == $_SESSION['mylogin_userid']) {
									if($row['status'] == "SOLD") {
										if($row2['is_winner'] == 1) {
											echo "<td>Winner</td>";
										} else {
											echo "<td></td>";
										}
									} else {
										echo "<td><form id='frmWin' method='POST' action='process/detail_process.php?iditem=".$row['iditem']."&iduser_owner=".$row2['iduser']."&price_initial=".$row['price_initial']."'><input class='btn btn-info btn-xs' type='submit' name='btnWin' value='Win'></form></td>";
									}
								} else {
									if($row['status'] == "SOLD") {
										if($row2['is_winner'] == 1) {
											echo "<td>Winner</td>";
										}
										else {
											echo "<td></td>";
										}
									} else {
										echo "<td>Waiting for result</td>";
									}
								}
								echo "</tr>";
							}
							echo "</tbody></table>";
						}
						$mysqli->close();
				} else {
					header("location: login.php");
				}
					
			?>
		<form class="form-group" id="frmBid" method="POST" action="detail.php?iditem=<?=$_GET['iditem']?>&iduser_owner=<?=$_GET['iduser_owner']?>&price_initial=<?=$_GET['price_initial']?>">
		<div>
			<label>Penawaran :</label>
			<div class="input-icon left input-large margin-top-10">
				<i class="fa fa-money"></i>
				<input class="form-control input-large" type="number" name="bid" min="1" max="1000000000" placeholder="Place your bid"><br>
			</div>
		</div>
		<?php echo "<p style='color:red; font-weight: bold;'>".$msg."</p>"; ?>
		<input class="btn btn-info" type="submit" name="submit" value="Bid">
		</form>
		<a class="btn btn-default" href="home.php">Back To Home</a>

	<?php 
		if($_GET['iduser_owner'] == $_SESSION['mylogin_userid'] or $row['status'] == "SOLD")
		{
			echo "<script type='text/javascript'>";
			echo "$(document).ready(function(){";
			echo "$('#frmBid').addClass('hide');";
			echo "});";
			echo "</script>";
		}
	?>
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
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
