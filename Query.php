<!--
    File Name: Query.php
    Author: Gonzalo Ramos Zúñiga
-->

<?php
$conn = new COM("ADODB.Connection") or die("Cannot start ADO.");
$db = "htdocs\as4.mdb";
$conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=$db");

if (!empty($_POST["btnQuery"]))
{
    $number = trim($_POST["txtNumber"]);
    $formOkay = true;

    if ($number == null || $number == "")
    {
        $numberError = "Vendor Number is required.";
        $formOkay = false;
    }
    else if (!is_numeric($number))
    {
        $numberError = "Vendor Number must be a number.";
        $formOkay = false;
    }
    else
    {
        $numberError = "";
    }

    if ($formOkay)
    {
        unset($_POST["txtNumber"]);
    }
}
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link href="bootstrap.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="Assignment5.js"></script>
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
            <h1 class="text-center">Query Vendor Table</h1>
        </div>
    </div>
</div>
<div class="container">
    <form class="form-horizontal" role="form" action="Query.php" method="post" 
    onsubmit="return validateQueryForm()">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtNumber">Vendor Number</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtNumber" name="txtNumber"
                       value="<?php
                              if (!empty($_POST["txtNumber"])) 
                              {
                                  echo $_POST["txtNumber"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="numberError">
                <?php 
                if (!empty($numberError)) 
                {
                    echo $numberError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group text-center">
            <input class="btn btn-default" type="submit" name="btnQuery" value="Query"/>
            <input class="btn btn-default" type="reset" name="btnReset" value="Reset"/>
        </div>
    </form>
</div>
<?php
if (!empty($formOkay))
{
    $rs = new COM("ADODB.Recordset");
    $rs->Open("SELECT * FROM vendor WHERE vendorNo = " . $number, $conn, "3", "1");

    echo '<div class="container"><div class="table-responsive"><table class="table">';
    echo '<tr><th>Number</th><th>Name</th><th>Address</th><th>City</th><th>Province/State</th>' . 
    '<th>Postal/Zip Code</th><th>Country</th><th>Phone</th><th>Fax</th></tr>';
    while (!$rs->EOF)
    {
        echo '<tr>';
        for ($i = 0; $i < ($rs->Fields->Count); $i++)
        {
            echo '<td>';
            echo $rs->Fields[$i]->Value . '<br />';
            echo '</td>';
        }
        $rs->MoveNext();
        echo '</tr>';
    }
    echo '</table><p class="text-center">(' . $rs->RecordCount() . ' row(s) returned)</p></div></div>';
    $rs->Close();
    $conn->Close();
}
?>
<div class="container">
    <form class="form-horizontal" role="form" action="Index.php" method="post">
        <div class="form-group">
            <input class="btn btn-default" type="submit" name="btnBack" 
                   value="Back to Index"/>
        </div>
    </form>
</div>
</body>
</html>