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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO masvingo (RegNumber, DriverName, Route, Cash, Diesel, Expenses, NetCash, Auditor) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['busReg'], "text"),
                       GetSQLValueString($_POST['driverName'], "text"),
                       GetSQLValueString($_POST['route'], "text"),
                       GetSQLValueString($_POST['cash'], "int"),
                       GetSQLValueString($_POST['diesel'], "int"),
                       GetSQLValueString($_POST['expenses'], "int"),
                       GetSQLValueString($_POST['netCash'], "int"),
                       GetSQLValueString($_POST['Auditor'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());
}

mysql_select_db($database_connect, $connect);
$query_masvingo = "SELECT * FROM masvingo";
$masvingo = mysql_query($query_masvingo, $connect) or die(mysql_error());
$row_masvingo = mysql_fetch_assoc($masvingo);
$totalRows_masvingo = mysql_num_rows($masvingo);
 @session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Masvingo | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
</head>

<body class="container">
	
    <div class="container">
    	<div class="row">
        	<div class="col-sm-6 col-md-4 col-md-offset-4">
            	<div class="panel panel-default">
                <div id="header"></div>
                <div class="panel-heading">Enter The Logsheet Values | Masvingo</div>
                <div class="panel-body">
                  <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
                    <span id="sprytextfield1">
                    <label for="driverName"></label>
                    <input type="text" class="form-control" name="driverName" id="driverName" placeholder="enter Driver Name"/>
                    <span class="textfieldRequiredMsg">A value is required.</span></span>
                    
                    
                    <span id="sprytextfield3">
                    <label for="busReg"></label>
                    <span id="sprytextfield4">
                    <input type="text" class="form-control" name="busReg" id="busReg" placeholder="enter Bus Reg Number"/>
                    <span class="textfieldRequiredMsg">A value is required.</span></span><span class="textfieldRequiredMsg">A value is required.</span></span>
                    <p id="textField" class="form-group">
                      Select Route
                      <label for="route"></label>
                      <select name="route" class="dropDown" id="route">
                        <option value="Masvingo-Bulawayo" <?php if (!(strcmp("Masvingo-Bulawayo", $row_masvingo['Route']))) {echo "selected=\"selected\"";} ?>>Masvingo-Bulawayo</option>
                        <option value="Masvingo-Chiredzi" <?php if (!(strcmp("Masvingo-Chiredzi", $row_masvingo['Route']))) {echo "selected=\"selected\"";} ?>>Masvingo-Chiredzi</option>
                        <option value="Masvingo-Harare" <?php if (!(strcmp("Masvingo-Harare", $row_masvingo['Route']))) {echo "selected=\"selected\"";} ?>>Masvingo-Harare</option>
                        <option value="Masvingo-Mutare" <?php if (!(strcmp("Masvingo-Mutare", $row_masvingo['Route']))) {echo "selected=\"selected\"";} ?>>Masvingo-Mutare</option>
</select>
                      <label for="cash"></label>
                      <input type="number" class="form-control" name="cash" id="cash" placeholder="enter Bus Cash"/>
                      <label for="expenses"></label>
                      <input type="number" class="form-control" name="expenses" id= "expenses" placeholder="enter Total Expenses"/>
<label for="diesel"></label>
<input type="number" class="form-control" name="diesel" id="diesel" placeholder=" enter diesel"/>                    
                    
                    <p class="form-group"><span id="netCashValidation">
                      <label for="netCash"></label>
                      <input class="form-control" placeholder="enter Net Cash" type="number" name="netCash" id="netCash" />
                      <span class="textfieldRequiredMsg">A value is required.</span></span>                    
                    <p class="form-group"><span id="sprytextfield5">
                      <label for="Auditor"></label>
                      <input class="form-control" placeholder="auditor" type="text" name="Auditor" id="Auditor" />
                      <span class="textfieldRequiredMsg">A value is required.</span></span>
  <span id="sprytextfield12">
    <label for="dieselValidation"></label>
    <span class="textfieldRequiredMsg">A value is required.</span></span>
                      <label for="auditor"></label>
                    <p>
                      <input type="submit" class="btn btn-lg btn-primary btn-block" name="login" id="login" value="enter records" />
                    </p>
<input name="auditorName" id="auditor" type="hidden" />
<input type="hidden" name="MM_insert" value="form1" />
                  </form>
                	<div class="panel-footer ">Inter Africa Internal Records System </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "integer");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "integer");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "integer");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield8 = new Spry.Widget.ValidationTextField("netCashValidation");
</script>
</body>
</html>
<?php
mysql_free_result($masvingo);
?>
