<?php require_once('Connections/connect.php'); ?>
<?php require_once('Connections/connect.php'); ?>
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

$MM_restrictGoTo = "login.php";
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

$currentPage = $_SERVER["PHP_SELF"];

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

if ((isset($_POST['DeletehiddenField'])) && ($_POST['DeletehiddenField'] != "")) {
  $deleteSQL = sprintf("DELETE FROM adminusers WHERE userID=%s",
                       GetSQLValueString($_POST['DeletehiddenField'], "int"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($deleteSQL, $connect) or die(mysql_error());

  $deleteGoTo = "DeleteUsers.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_deleteUsers = 10;
$pageNum_deleteUsers = 0;
if (isset($_GET['pageNum_deleteUsers'])) {
  $pageNum_deleteUsers = $_GET['pageNum_deleteUsers'];
}
$startRow_deleteUsers = $pageNum_deleteUsers * $maxRows_deleteUsers;

mysql_select_db($database_connect, $connect);
$query_deleteUsers = "SELECT * FROM adminusers ORDER BY `timeStamp` DESC";
$query_limit_deleteUsers = sprintf("%s LIMIT %d, %d", $query_deleteUsers, $startRow_deleteUsers, $maxRows_deleteUsers);
$deleteUsers = mysql_query($query_limit_deleteUsers, $connect) or die(mysql_error());
$row_deleteUsers = mysql_fetch_assoc($deleteUsers);

if (isset($_GET['totalRows_deleteUsers'])) {
  $totalRows_deleteUsers = $_GET['totalRows_deleteUsers'];
} else {
  $all_deleteUsers = mysql_query($query_deleteUsers);
  $totalRows_deleteUsers = mysql_num_rows($all_deleteUsers);
}
$totalPages_deleteUsers = ceil($totalRows_deleteUsers/$maxRows_deleteUsers)-1;

$queryString_deleteUsers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_deleteUsers") == false && 
        stristr($param, "totalRows_deleteUsers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_deleteUsers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_deleteUsers = sprintf("&totalRows_deleteUsers=%d%s", $totalRows_deleteUsers, $queryString_deleteUsers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
	<div id="header">
    	
    </div>
    <div class="col-md-3">
    <h3>Admin Actions</h3>
        <p><a href="DeleteUsers.php"Delete Users>Delete User</a></p>
        <p><a href="NewUser.php"> Register New User </a></p>
        <p><a href="#">Edit User Accounts</a></p>
        <p><a href="adminPage.php">Admin Home Page</a></p>
    </div>
    <div class="col-sm-7">
    <table class="table table-hover" id="task-table">
    <thead>
    <tr>
    	<th>userID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Username</th>
        <th>User Level</th>
        <th>Depot</th>
        <th>Action</th>
    </tr>
    </thead>
    	<tbody>
          <?php if ($totalRows_deleteUsers > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <tr>
                <td><?php echo $row_deleteUsers['userID']; ?></td>
                <td><?php echo $row_deleteUsers['name']; ?></td>
                <td><?php echo $row_deleteUsers['surname']; ?> </td>
                <td><?php echo $row_deleteUsers['username']; ?> </td>
                <td><?php echo $row_deleteUsers['userLevel']; ?></td>
                <td><?php echo $row_deleteUsers['depot']; ?></td>
                <td></td>
                <td><form action="" method="POST">
                  <input name="DeletehiddenField" type="hidden" id="DeletehiddenField" value="<?php echo $row_deleteUsers['userID']; ?>" />
                  <input type="submit" class="btn btn-danger" name="DeleteUserButton" id="DeleteUserButton" value="Delete User" />
                </form></td>
              </tr>
            <?php } while ($row_deleteUsers = mysql_fetch_assoc($deleteUsers)); ?>
          <?php } // Show if recordset not empty ?>
      </tbody>
      <tr>
            showing 
  </tr>
    </table>
    <p>&nbsp;<a href="<?php printf("%s?pageNum_deleteUsers=%d%s", $currentPage, min($totalPages_deleteUsers, $pageNum_deleteUsers + 1), $queryString_deleteUsers); ?>">Next Page </a></p>
    </table>
    </div>
    </div>
<footer>
    copyright &copy; 2017 Inter-Africa Internal Records System designed by | <a href="www.mrcdziruni.tech">Mr C Dziruni</a>
    </footer>
</body>
</html>
<?php
mysql_free_result($deleteUsers);

mysql_free_result($deleteUsers);
?>
