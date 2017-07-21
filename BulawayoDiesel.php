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

mysql_select_db($database_connect, $connect);
$query_BulawayoDiesel = "SELECT * FROM bulawayo_diesel";
$BulawayoDiesel = mysql_query($query_BulawayoDiesel, $connect) or die(mysql_error());
$row_BulawayoDiesel = mysql_fetch_assoc($BulawayoDiesel);
$totalRows_BulawayoDiesel = mysql_num_rows($BulawayoDiesel);
 @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bulawayo Depot Diesel | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
<div id="header"></div>
	  <p>
<div class="col-sm-12">
   	  <table class="table table-hover" id="task-table">
      <h4>Bulawayo Depot Diesel Depot Head: 0776786971 email: mrxxx@interafrica.co.zw</h4>
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
          <?php if ($totalRows_BulawayoDiesel > 0) { // Show if recordset not empty ?>
            <?php do { ?>
            <tr>
                <td> <?php echo $row_BulawayoDiesel['Timestamp']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['Diesel']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['Supplier']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['DeliverNote']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['Vehicle']; ?></td>
                <td><?php echo $row_BulawayoDiesel['Trailer']; ?></td>
                <td><?php echo $row_BulawayoDiesel['MeterStart']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['MeterEnd']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['AvailableDiesel']; ?> </td>
                <td><?php echo $row_BulawayoDiesel['ReceivedBy']; ?> </td>
              </tr>
          <?php } while ($row_BulawayoDiesel = mysql_fetch_assoc($BulawayoDiesel)); ?>
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
mysql_free_result($BulawayoDiesel);
?>
