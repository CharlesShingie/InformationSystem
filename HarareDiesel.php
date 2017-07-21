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




$maxRows_dieselDisplayHarare = 10;
$pageNum_dieselDisplayHarare = 0;
if (isset($_GET['pageNum_dieselDisplayHarare'])) {
  $pageNum_dieselDisplayHarare = $_GET['pageNum_dieselDisplayHarare'];
}
	

$startRow_dieselDisplayHarare = $pageNum_dieselDisplayHarare * $maxRows_dieselDisplayHarare;

mysql_select_db($database_connect, $connect);
$query_dieselDisplayHarare = "SELECT * FROM harare_diesel";
$query_limit_dieselDisplayHarare = sprintf("%s LIMIT %d, %d", $query_dieselDisplayHarare, $startRow_dieselDisplayHarare, $maxRows_dieselDisplayHarare);
$dieselDisplayHarare = mysql_query($query_limit_dieselDisplayHarare, $connect) or die(mysql_error());
$row_dieselDisplayHarare = mysql_fetch_assoc($dieselDisplayHarare);

if (isset($_GET['totalRows_dieselDisplayHarare'])) {
  $totalRows_dieselDisplayHarare = $_GET['totalRows_dieselDisplayHarare'];
} else {
  $all_dieselDisplayHarare = mysql_query($query_dieselDisplayHarare);
  $totalRows_dieselDisplayHarare = mysql_num_rows($all_dieselDisplayHarare);
}
$totalPages_dieselDisplayHarare = ceil($totalRows_dieselDisplayHarare/$maxRows_dieselDisplayHarare)-1;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Harare Depot Diesel | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
<div id="header"></div>
	  <p>
<div class="col-sm-11">
   	  <table class="table table-hover" id="task-table">
      <h3>Harare Depot Diesel phone: Mr XXX 0776786971</h3>
      	<thead>
        	<th>Date Received</th>
            <th>Diesel Received</th>
            <th>Supplier</th>
            <th>VehicleReg</th>
            <th>Trailer</th>
            <th>Meter Reading <br />Initial</th>
            <th>Meter Reading <br/> After Delivery</th>
            <th>Remaining Diesel</th>
            <th>ReceivedBy </th>
        </thead>
        
        <tbody>
          <?php if ($totalRows_dieselDisplayHarare > 0) { // Show if recordset not empty ?>
            <?php do { ?>
            <tr>
                <td><?php echo $row_dieselDisplayHarare['TimeStamp']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['DieselReceived']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['Supplier']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['Vehicle']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['Trailer']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['MeterReadingInitial']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['MeterdingAfter']; ?></td>
                <td><?php echo $row_dieselDisplayHarare['AvailableDiesel']; ?> </td>
                <td><?php echo $row_dieselDisplayHarare['ReceivedBy']; ?></td>
                
            </tr>
          <?php } while ($row_dieselDisplayHarare = mysql_fetch_assoc($dieselDisplayHarare)); ?>
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
mysql_free_result($dieselDisplayHarare);
?>
