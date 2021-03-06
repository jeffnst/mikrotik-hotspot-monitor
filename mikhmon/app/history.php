<?php session_start(); ?>
<?php
if(!isset($_SESSION['usermikhmon'])){
	header("Location:login.php");
}
?>
<?php
error_reporting(0);
require('./lib/api.php');
include('./config.php');
$API = new RouterosAPI();
$API->debug = false;
if ($API->connect( $iphost, $userhost, $passwdhost )) {
	$API->write('/system/history/print', false);
	$API->write('?=by=');
	$ARRAY = $API->read();
	$API->disconnect();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mikrotik Hotspot Monitor</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
		<link rel="icon" href="./img/favicon.png" />
		<link rel="stylesheet" href="css/style.css" media="screen">
		<script>
			function Reload() {
				location.reload();
			}
			function goBack() {
				window.history.back();
			}
		</script>
	</head>
	<body>
	<div class="main">
	<table class="tnav">
		<tr>
			<td style="text-align: center;" colspan=2>Mikrotik Hotspot Monitor</td>
		</tr>
		<tr>
			<td>History</td>
			<td>
				<button class="material-icons" onclick="Reload()" title="Reload">autorenew</button>
				<button class="material-icons"	onclick="location.href='./hotspotlog.php';" 	title="Log Hotspot">subject</button>
				<button class="material-icons" onclick="location.href='./';" title="Dashboard">dashboard</button>
				<button class="material-icons" onclick="goBack()" title="Back">arrow_back</button>
			</td>
		</tr>
	</table>
		<div style="overflow-x:auto;">
			<table style="white-space: nowrap;" class="zebra" >
				<tr>
					<th >Time</th>
					<th >Action</th>
				</tr>
				<?php
					$TotalReg = count($ARRAY);

						for ($i=0; $i<$TotalReg; $i++){
							$regtable = $ARRAY[$i];echo "<tr><td>" . $regtable['time'];echo "</td>";
							$regtable = $ARRAY[$i];echo "<td>" . $regtable['action'];echo "</td> </tr>";
							}
				?>
			</table>
		</div>
	</div>
	</body>
</html>
