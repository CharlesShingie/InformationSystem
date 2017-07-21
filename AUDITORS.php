<?php @session_start(); ?>
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
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php @session_start() ; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AUDITORS | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
	<div id="header">
    	
    </div>
    <div class="content">
    <div class="row">
      <div class="col-lg-5">
        <p><a href="harareDaily.php"> <input type="button" value="Record Harare Depot Bus Proceeds" class="btn btn-primary btn-block" id="harare"/> </a></p>
        
   <p><a href="bulawayoDaily.php"> <input type="button" value="Record Bulawayo Depot Bus Proceeds" class="btn btn-info btn-block" id="bulawayoButton"/> </a></p>
   
      <p><a href="mutareDaily.php">
        <input type="button" value="Record Mutare Depot Bus Proceeds" class="btn btn-default btn-block" id="mutareButton"/>
      </a></p>
      
         <p><a href="masvingoDaily2.php"> <input type="button" value="Record Masvingo Depot Bus Proceeds" class="btn btn-success btn-block" id="masvingoButton"/> </a></p>
         
         <p><a href="deiselHarare.php"> <input type="button" value="Record Diesel Delivery" class="btn btn-danger btn-block" id="masvingoButton"/> </a></p>
    
    </div>
    </div>
    
</div>
    <a href="<?php echo $logoutAction ?>">Log out</a>
<footer>
  copyright &copy; 2017 Inter-Africa Internal Records System designed by | Mr C Dziruni
    </footer>
</body>
</html>
