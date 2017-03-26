<!--
    File Name: Parts.php
    Author: Gonzalo Ramos Zúñiga
-->

<?php
$conn = new COM("ADODB.Connection") or die("Cannot start ADO.");
$db = "htdocs\as4.mdb";
$conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=$db");

if (!empty($_POST["btnCreatePart"]))
{
    $vendor = trim($_POST["lstVendors"]);
    $description = trim($_POST["txtDescription"]);
    $onHand = trim($_POST["txtHand"]);
    $onOrder = trim($_POST["txtOrder"]);
    $cost = trim($_POST["txtCost"]);
    $price = trim($_POST["txtPrice"]);
    $formOkay = true;

    if ($vendor == null || $vendor == "")
    {
        $vendorError = "Vendor is required.";
        $formOkay = false;
    }
    else
    {
        $vendorError = "";
    }

    if ($description == null || $description == "")
    {
        $descriptionError = "Description is required.";
        $formOkay = false;
    }
    else if (strlen($description) > 30)
    {
        $descriptionError = "Description must not be longer than 30 characters.";
        $formOkay = false;
    }
    else
    {
        $descriptionError = "";
    }

    if ($onHand == null || $onHand == "")
    {
        $handError = "On Hand is required.";
        $formOkay = false;
    }
    else if (!is_numeric($onHand))
    {
        $handError = "On Hand must be a number.";
        $formOkay = false;
    }
    else if ($onHand < 0)
    {
        $handError = "On Hand must be greater or equal than 0.";
        $formOkay = false;
    }
    else
    {
        $handError = "";
    }

    if ($onOrder == null || $onOrder == "")
    {
        $orderError = "On Order is required.";
        $formOkay = false;
    }
    else if (!is_numeric($onOrder))
    {
        $orderError = "On Order must be a number.";
        $formOkay = false;
    }
    else if ($onOrder < 0)
    {
        $orderError = "On Order must be greater or equal than 0.";
        $formOkay = false;
    }
    else
    {
        $orderError = "";
    }

    if ($cost == null || $cost == "")
    {
        $costError = "Cost is required.";
        $formOkay = false;
    }
    else if (!is_numeric($cost))
    {
        $costError = "Cost must be a number.";
        $formOkay = false;
    }
    else if ($cost < 0)
    {
        $costError = "Cost must be greater or equal than 0.";
        $formOkay = false;
    }
    else
    {
        $costError = "";
    }

    if ($price == null || $price == "")
    {
        $priceError = "List Price is required.";
        $formOkay = false;
    }
    else if (!is_numeric($price))
    {
        $priceError = "List Price must be a number.";
        $formOkay = false;
    }
    else if ($price < 0)
    {
        $priceError = "List Price must be greater or equal than 0.";
        $formOkay = false;
    }
    else if ($price < $cost)
    {
        $priceError = "List Price must be equal or greater than Cost.";
        $formOkay = false;
    }
    else
    {
        $priceError = "";
    }

    if ($formOkay)
    {
        $sql = "INSERT INTO part (vendorNo, description, onHand, onOrder, cost, listPrice)" . 
        " VALUES($vendor, '$description', $onHand, $onOrder," . 
        " $cost, $price)";
        $conn->Execute($sql);
        $isCreated = true;
        unset($_POST["lstVendors"]);
        unset($_POST["txtDescription"]);
        unset($_POST["txtHand"]);
        unset($_POST["txtOrder"]);
        unset($_POST["txtCost"]);
        unset($_POST["txtPrice"]);
        unset($_POST["txtPrice"]);
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
            <h1 class="text-center">ADD INFORMATION TO PARTS</h1>
        </div>
    </div>
</div>
<div class="container">
    <form class="form-horizontal" role="form" action="Parts.php" method="post" 
          onsubmit="return validatePartsForm()">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="lstVendors">Vendor</label>
            <div class="col-sm-10">
                <select class="form-control" id="lstVendors" name="lstVendors">
                    <option value="">Select:</option>
                    <?php
                    $rs = $conn->Execute("SELECT vendorNo, vendorName FROM vendor");
                    while (!$rs->EOF)
                    {
                        if (!empty($_POST["lstVendors"]) && $_POST["lstVendors"] == $rs->Fields[0]->Value)
                        {
                            echo '<option value="' . $rs->Fields[0]->Value . '" selected>' . 
                            $rs->Fields[1]->Value . '</option>';
                        }
                        else
                        {
                            echo '<option value="' . $rs->Fields[0]->Value . '">' . 
                            $rs->Fields[1]->Value . '</option>';
                        }
                        $rs->MoveNext();
                    }
                    $rs->Close();
                    ?>
                </select>
                <p class="text-danger" id="vendorError">
                <?php 
                if (!empty($vendorError)) 
                {
                    echo $vendorError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtDescription">Description</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtDescription" name="txtDescription"
                       value="<?php 
                              if (!empty($_POST["txtDescription"])) 
                              {
                                  echo $_POST["txtDescription"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="descriptionError">
                <?php 
                if (!empty($descriptionError)) 
                {
                    echo $descriptionError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtHand">On Hand</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtHand" name="txtHand"
                       value="<?php 
                              if (!empty($_POST["txtHand"])) 
                              {
                                  echo $_POST["txtHand"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="handError">
                <?php 
                if (!empty($handError)) 
                {
                    echo $handError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtOrder">On Order</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtOrder" name="txtOrder"
                       value="<?php 
                              if (!empty($_POST["txtOrder"])) 
                              {
                                  echo $_POST["txtOrder"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="orderError">
                <?php 
                if (!empty($orderError)) 
                {
                    echo $orderError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtCost">Cost</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtCost" name="txtCost"
                       value="<?php 
                              if (!empty($_POST["txtCost"])) 
                              {
                                  echo $_POST["txtCost"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="costError">
                <?php 
                if (!empty($costError)) 
                {
                    echo $costError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPrice">List Price</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtPrice" name="txtPrice"
                       value="<?php
                              if (!empty($_POST["txtPrice"]))
                              {
                                  echo $_POST["txtPrice"];
                              }
                              ?>"
                />
                <p class="text-danger" id="priceError">
                <?php 
                if (!empty($priceError)) 
                {
                    echo $priceError;
                }
                ?>
                </p>
            </div>
        </div>
        <div class="form-group text-center">
            <input class="btn btn-default" type="submit" name="btnCreatePart" value="Create"/>
            <input class="btn btn-default" type="reset" name="btnReset" value="Reset"/>
        </div>
    </form>
</div>
<?php
if (!empty($isCreated) && $isCreated)
{
    $rs = $conn->Execute("SELECT vendorName FROM vendor WHERE vendorNo = " . $vendor);
    echo '<div class="container"><div class="table-responsive"><table class="table">' . 
    '<tr><th class="text-center" colspan="2">Created Part:</th></tr>';
    echo '<tr><td>Vendor Name:</td><td>' . $rs->Fields[0]->Value . '</td></tr>';
    echo '<tr><td>Description:</td><td>' . $description . '</td></tr>';
    echo '<tr><td>On Hand:</td><td>' . $onHand . '</td></tr>';
    echo '<tr><td>On Order:</td><td>' . $onOrder . '</td></tr>';
    echo '<tr><td>Cost:</td><td>' . $cost . '</td></tr>';
    echo '<tr><td>List Price:</td><td>' . $price . '</td></tr>';
    echo '</table></div></div>';
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