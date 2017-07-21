<?php @session_start(); ?>
<?php require_once('Connections/connect.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "adminLogin.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_masvingo = 10;
$pageNum_masvingo = 0;
if (isset($_GET['pageNum_masvingo'])) {
  $pageNum_masvingo = $_GET['pageNum_masvingo'];
}
$startRow_masvingo = $pageNum_masvingo * $maxRows_masvingo;

mysql_select_db($database_connect, $connect);
$query_masvingo = "SELECT * FROM masvingo ORDER BY `Time` DESC";
$query_limit_masvingo = sprintf("%s LIMIT %d, %d", $query_masvingo, $startRow_masvingo, $maxRows_masvingo);
$masvingo = mysql_query($query_limit_masvingo, $connect) or die(mysql_error());
$row_masvingo = mysql_fetch_assoc($masvingo);

if (isset($_GET['totalRows_masvingo'])) {
  $totalRows_masvingo = $_GET['totalRows_masvingo'];
} else {
  $all_masvingo = mysql_query($query_masvingo);
  $totalRows_masvingo = mysql_num_rows($all_masvingo);
}
$totalPages_masvingo = ceil($totalRows_masvingo/$maxRows_masvingo)-1;

$queryString_masvingo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_masvingo") == false && 
        stristr($param, "totalRows_masvingo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_masvingo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_masvingo = sprintf("&totalRows_masvingo=%d%s", $totalRows_masvingo, $queryString_masvingo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Masvingo Depot | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
	<div id="header">
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
    	
    </div>
     <div class="contentLeft col-md-2">
    	<h3>Admin Actions</h3>
        <p><a href="MasvingoDiesel.php">Diesel Records</a></p>
        <p><a href="DeleteUsers.php">Delete User</a></p>
        <p><a href="NewUser.php"> Register New User </a></p>
        <p><a href="#">Edit User Accounts</a></p>
        <p><a href="adminPage.php">Admin Home Page</a></p>
        <p><a href="<?php echo $logoutAction ?>">Log out</a></p>
    </div>
    <div class="col-sm-9">
   	  <table class="table table-hover" id="task-table">
      <h3>Masvingo Depot phone: Mr XXX 0776786971</h3> Showing <?php echo ($startRow_masvingo + 1) ?> to <?php echo min($startRow_masvingo + $maxRows_masvingo, $totalRows_masvingo) ?> of <?php echo $totalRows_masvingo ?> Bus  Records  Today
<thead>
   	  <th> Time</th>
    	<th>Bus</th>
        <th>Route</th>
        <th>Driver</th>
        <th>Cash</th>
        <th>Fuel</th>
        <th>Expenses</th>
        <th>Net Cash</th>
        <th  >Auditor(s)</th>
    </thead>
    
    <tbody>
      <?php if ($totalRows_masvingo > 0) { // Show if recordset not empty ?>
        <?php do { ?>
          <tr>
            <td><?php echo $row_masvingo['Time']; ?></td>
            <td><?php echo $row_masvingo['RegNumber']; ?></td>
            <td><?php echo $row_masvingo['Route']; ?></td>
            <td><?php echo $row_masvingo['DriverName']; ?></td>
            <td><?php echo $row_masvingo['Cash']; ?></td>
            <td><?php echo $row_masvingo['Diesel']; ?></td>
            <td><?php echo $row_masvingo['Expenses']; ?></td>
            <td bgcolor="#6666FF"><?php echo $row_masvingo['NetCash']; ?></td>
            <td><?php echo $row_masvingo['Auditor']; ?></td>
          </tr>
          <?php } while ($row_masvingo = mysql_fetch_assoc($masvingo)); ?>
        <?php } // Show if recordset not empty ?>
<tr>
        <td><a href="<?php printf("%s?pageNum_masvingo=%d%s", $currentPage, max(0, $pageNum_masvingo - 1), $queryString_masvingo); ?>">Previous</a></td>
        <td><a href="<?php printf("%s?pageNum_masvingo=%d%s", $currentPage, min($totalPages_masvingo, $pageNum_masvingo + 1), $queryString_masvingo); ?>">Next</a></td>
        
        <td><a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a></td>
        </tr>
    </tbody>
    </table>
    
    </div>
    
<footer>
    copyright &copy; 2017 Inter-Africa Internal Records System designed by | Mr C Dziruni
    </footer>
</body>
</html>
<?php
mysql_free_result($masvingo);
?>
