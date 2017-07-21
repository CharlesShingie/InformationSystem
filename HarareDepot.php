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
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "3";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "adminLogin.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

$maxRows_HarareRecordsForm = 10;
$pageNum_HarareRecordsForm = 0;
if (isset($_GET['pageNum_HarareRecordsForm'])) {
  $pageNum_HarareRecordsForm = $_GET['pageNum_HarareRecordsForm'];
}
$startRow_HarareRecordsForm = $pageNum_HarareRecordsForm * $maxRows_HarareRecordsForm;

mysql_select_db($database_connect, $connect);
$query_HarareRecordsForm = "SELECT * FROM harare ORDER BY `Time` DESC";
$query_limit_HarareRecordsForm = sprintf("%s LIMIT %d, %d", $query_HarareRecordsForm, $startRow_HarareRecordsForm, $maxRows_HarareRecordsForm);
$HarareRecordsForm = mysql_query($query_limit_HarareRecordsForm, $connect) or die(mysql_error());
$row_HarareRecordsForm = mysql_fetch_assoc($HarareRecordsForm);

if (isset($_GET['totalRows_HarareRecordsForm'])) {
  $totalRows_HarareRecordsForm = $_GET['totalRows_HarareRecordsForm'];
} else {
  $all_HarareRecordsForm = mysql_query($query_HarareRecordsForm);
  $totalRows_HarareRecordsForm = mysql_num_rows($all_HarareRecordsForm);
}
$totalPages_HarareRecordsForm = ceil($totalRows_HarareRecordsForm/$maxRows_HarareRecordsForm)-1;

$queryString_HarareRecordsForm = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_HarareRecordsForm") == false && 
        stristr($param, "totalRows_HarareRecordsForm") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_HarareRecordsForm = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_HarareRecordsForm = sprintf("&totalRows_HarareRecordsForm=%d%s", $totalRows_HarareRecordsForm, $queryString_HarareRecordsForm);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Harare Depot | Inter-Africa</title>
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
        <p><a href="HarareDiesel.php">Diesel Records</a></p>
        <p><a href="DeleteUsers.php">Delete User</a></p>
        <p><a href="NewUser.php"> Register New User </a></p>
        <p><a href="#">Edit User Accounts</a></p>
        <p><a href="adminPage.php">Admin Home Page</a></p>
        <p><a href="<?php echo $logoutAction ?>">Log out</a></p>
    </div>
    <div class="col-sm-9">
   	  <table class="table table-hover" id="task-table">
      <h3>Harare Depot(MAIN)</h3> Showing <?php echo ($startRow_HarareRecordsForm + 1) ?> to <?php echo min($startRow_HarareRecordsForm + $maxRows_HarareRecordsForm, $totalRows_HarareRecordsForm) ?> of <?php echo $totalRows_HarareRecordsForm ?>  Bus  Records  Today 
      
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
      <?php if ($totalRows_HarareRecordsForm > 0) { // Show if recordset not empty ?>
        <?php do { ?>
          <tr>
            <td><?php echo $row_HarareRecordsForm['Time']; ?></td>
            <td><?php echo $row_HarareRecordsForm['RegNumber']; ?></td>
            <td><?php echo $row_HarareRecordsForm['Route']; ?> </td>
            <td><?php echo $row_HarareRecordsForm['DriverName']; ?> </td>
            <td> <?php echo $row_HarareRecordsForm['Cash']; ?></td>
            <td><?php echo $row_HarareRecordsForm['Diesel']; ?> </td>
            
            <td> <?php echo $row_HarareRecordsForm['Expenses']; ?></td>
            <td bgcolor="#6666FF"><?php echo $row_HarareRecordsForm['NetCash']; ?> </td>
            <td><?php echo $row_HarareRecordsForm['auditor']; ?> </td>
          </tr>
          <?php } while ($row_HarareRecordsForm = mysql_fetch_assoc($HarareRecordsForm)); ?>
        <?php } // Show if recordset not empty ?>
        <tr>
        <td><a href="<?php printf("%s?pageNum_HarareRecordsForm=%d%s", $currentPage, max(0, $pageNum_HarareRecordsForm - 1), $queryString_HarareRecordsForm); ?>">Previous</a></td>
        <td><a href="<?php printf("%s?pageNum_HarareRecordsForm=%d%s", $currentPage, min($totalPages_HarareRecordsForm, $pageNum_HarareRecordsForm + 1), $queryString_HarareRecordsForm); ?>">Next</a></td>
        
        <td><a class = "btn btn-success btn-print" href = "" onclick = "window.print()"> Print</a></td>
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
mysql_free_result($HarareRecordsForm);
?>
