<?php @session_start(); ?>
<?php require_once('Connections/connect.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_masvingoDiesel = 10;
$pageNum_masvingoDiesel = 0;
if (isset($_GET['pageNum_masvingoDiesel'])) {
  $pageNum_masvingoDiesel = $_GET['pageNum_masvingoDiesel'];
}
$startRow_masvingoDiesel = $pageNum_masvingoDiesel * $maxRows_masvingoDiesel;

mysql_select_db($database_connect, $connect);
$query_masvingoDiesel = "SELECT * FROM masvingo_diesel";
$query_limit_masvingoDiesel = sprintf("%s LIMIT %d, %d", $query_masvingoDiesel, $startRow_masvingoDiesel, $maxRows_masvingoDiesel);
$masvingoDiesel = mysql_query($query_limit_masvingoDiesel, $connect) or die(mysql_error());
$row_masvingoDiesel = mysql_fetch_assoc($masvingoDiesel);

if (isset($_GET['totalRows_masvingoDiesel'])) {
  $totalRows_masvingoDiesel = $_GET['totalRows_masvingoDiesel'];
} else {
  $all_masvingoDiesel = mysql_query($query_masvingoDiesel);
  $totalRows_masvingoDiesel = mysql_num_rows($all_masvingoDiesel);
}
$totalPages_masvingoDiesel = ceil($totalRows_masvingoDiesel/$maxRows_masvingoDiesel)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Masvingo Depot Diesel | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
<div id="header"></div>
	  <p>
<div class="col-sm-12">
   	  <table class="table table-hover" id="task-table">
      <h4>Masvingo Depot Diesel Depot Head: 0776786971 email: mrxxx@interafrica.co.zw</h4>
      	<thead>
        	<th>Date Received</th>
            <th>Diesel Received</th>
            <th>Supplier</th>
            <th>Delivery Note</th>
            <th>VehicleReg</th>
            <th>Trailer</th>
            <th>Meter Reading <br />Initial</th>
            <th>Meter Reading <br/> After Delivery</th>
            <th>Remaining Diesel</th>
            <th>ReceivedBy </th>
        </thead>
        
        <tbody>
          <?php if ($totalRows_masvingoDiesel > 0) { // Show if recordset not empty ?>
            <?php do { ?>
          <tr>
            <td><?php echo $row_masvingoDiesel['Timestamp']; ?> </td>
            <td><?php echo $row_masvingoDiesel['Diesel']; ?> </td>
            <td> <?php echo $row_masvingoDiesel['Supplier']; ?></td>
            <td><?php echo $row_masvingoDiesel['DeliveryNote']; ?> </td>
            <td><?php echo $row_masvingoDiesel['Vehicle']; ?> </td>
            <td><?php echo $row_masvingoDiesel['Trailer']; ?> </td>
            <td><?php echo $row_masvingoDiesel['MeterStart']; ?> </td>
            <td><?php echo $row_masvingoDiesel['MeterEnd']; ?> </td>
            <td><?php echo $row_masvingoDiesel['AvailableDiesel']; ?> </td>
            <td><?php echo $row_masvingoDiesel['ReceivedBy']; ?> </td>
          </tr>
          <?php } while ($row_masvingoDiesel = mysql_fetch_assoc($masvingoDiesel)); ?>
            <?php } // Show if recordset not empty ?>
        </tbody>
  </table>
        </div>
      </p>
	  
<a class = "btn btn-success btn-print" href = "" onclick = "window.print()">Print</a>
    	
    </div>
    <div class="content">
    </div>
    <footer>
    copyright &copy; 2017 Inter-Africa Internal Records System designed by | Mr C Dziruni
    </footer>
</body>
</html>
<?php
mysql_free_result($masvingoDiesel);
?>
