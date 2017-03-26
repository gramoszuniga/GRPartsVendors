<!--
    File Name: Index.php
    Author: Gonzalo Ramos Zúñiga
-->

<?php
if (!empty($_POST["btnVendors"]))
{
    $button = $_POST["btnVendors"];
    header("Location: /vendors.php");
} 
elseif (!empty($_POST["btnParts"]))
{
    $button = $_POST["btnParts"];
    header("Location: /parts.php");
} 
elseif (!empty($_POST["btnQuery"]))
{
    $button = $_POST["btnQuery"];
    header("Location: /query.php");
}
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link href="bootstrap.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-left">LOGO</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center">MENU PAGE</h1>
        </div>
    </div>
</div>
<div class="container">
    <form class="form-horizontal" role="form" action="Index.php" method="post">
        <div class="form-group">
            <input class="btn btn-default btn-block" type="submit" name="btnVendors" 
                   value="Add Info to Vendors"/>
        </div>
        <div class="form-group">
            <input class="btn btn-default btn-block" type="submit" name="btnParts" 
                   value="Add Info to Parts"/>
        </div>
        <div class="form-group">
            <input class="btn btn-default btn-block" type="submit" name="btnQuery" 
                   value="Query Vendor Table"/>
        </div>
    </form>
</div>
</body>
</html>