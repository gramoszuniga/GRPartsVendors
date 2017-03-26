<!--
    File Name: Vendors.php
    Author: Gonzalo Ramos Zúñiga
-->

<?php
if (!empty($_POST["btnCreateVendor"]))
{
    $conn = new COM("ADODB.Connection") or die("Cannot start ADO.");
    $db = "htdocs\as4.mdb";
    $conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=$db");

    $number = trim($_POST["txtNumber"]);
    $name = trim($_POST["txtName"]);
    $address = trim($_POST["txtAddress"]);
    $city = trim($_POST["txtCity"]);
    $country = trim($_POST["lstCountry"]);
    $province = "";
    if ($country == "Canada")
    {
        $province = trim($_POST["lstProvince"]);
    }
    else if ($country == "U.S.A.")
    {
        $province = trim($_POST["lstState"]);
    }
    $postalCode = strtoupper(trim($_POST["txtPostalCode"]));
    $phone = trim($_POST["txtPhone"]);
    $fax = trim($_POST["txtFax"]);
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

    if ($name == null || $name == "")
    {
        $nameError = "Vendor Name is required.";
        $formOkay = false;
    }
    else if (strlen($name) > 30)
    {
        $nameError = "Vendor Name must not be longer than 30 characters.";
        $formOkay = false;
    }
    else
    {
        $nameError = "";
    }

    if ($address == null || $address == "")
    {
        $addressError = "Address is required.";
        $formOkay = false;
    }
    else if (strlen($address) > 30)
    {
        $addressError = "Address must not be longer than 30 characters.";
        $formOkay = false;
    }
    else
    {
        $addressError = "";
    }

    if ($city == null || $city == "")
    {
        $cityError = "City is required.";
        $formOkay = false;
    }
    else if (strlen($city) > 20)
    {
        $cityError = "City must not be longer than 20 characters.";
        $formOkay = false;
    }
    else
    {
        $cityError = "";
    }

    if ($province == null || $province == "")
    {
        $provinceError = "Province/State is required.";
        $formOkay = false;
    }
    else if (strlen($province) > 2)
    {
        $provinceError = "Province/State must not be longer than 2 characters.";
        $formOkay = false;
    }
    else
    {
        $provinceError = "";
    }

    if ($country == "Canada")
    {
        $rePostalCode = "/^[A-Z][0-9][A-Z][0-9][A-Z][0-9]$/";
    }
    else if ($country == "U.S.A.")
    {
        $rePostalCode = "/^[0-9]{5}$/";
    }
    if ($postalCode == null || $postalCode == "")
    {
        $postalCodeError = "Postal/Zip Code is required.";
        $formOkay = false;
    }
    else if (strlen($postalCode) > 9)
    {
        $postalCodeError = "Postal/Zip Code must not be longer than 9 characters.";
        $formOkay = false;
    }
    else if (!empty($rePostalCode) && !preg_match($rePostalCode, $postalCode))
    {
        $postalCodeError = "Postal/Zip must be in format A1A1A1 for Canada and 11111 for U.S.A.";
        $formOkay = false;
    }
    else
    {
        $postalCodeError = "";
    }

    if ($country == null || $country == "")
    {
        $countryError = "Country is required.";
        $formOkay = false;
    }
    else if (strlen($country) > 15)
    {
        $countryError = "Country must not be longer than 15 characters.";
        $formOkay = false;
    }
    else
    {
        $countryError = "";
    }

    if (($phone != null && $phone != "") && strlen($phone) > 15)
    {
        $phoneError = "Phone must not be longer than 15 characters.";
        $formOkay = false;
    }
    else
    {
        $phoneError = "";
    }


    if (($fax != null && $fax != "") && strlen($fax) > 15)
    {
        $faxError = "Fax must not be longer than 15 characters.";
        $formOkay = false;
    }
    else
    {
        $faxError = "";
    }

    if ($formOkay)
    {
        if ($phone == "" && $fax == "")
        {
            $sql = "INSERT INTO vendor (vendorNo, vendorName, address1, city, provState, postalZip," . 
            " country) VALUES($number, '$name', '$address', '$city', '$province'," . 
            " '$postalCode', '$country')";
        }
        elseif ($phone == "")
        {
            $sql = "INSERT INTO vendor (vendorNo, vendorName, address1, city, provState, postalZip," . 
            " country, FAX) VALUES($number, '$name', '$address', '$city', '$province'," . 
            " '$postalCode', '$country', '$fax')";
        }
        elseif ($fax == "")
        {
            $sql = "INSERT INTO vendor (vendorNo, vendorName, address1, city, provState, postalZip," . 
            " country, phone) VALUES($number, '$name', '$address', '$city', '$province'," . 
            " '$postalCode', '$country', '$phone')";
        }
        else
        {
            $sql = "INSERT INTO vendor (vendorNo, vendorName, address1, city, provState, postalZip," . 
            " country, phone, FAX) VALUES($number, '$name', '$address', '$city'," . 
            " '$province', '$postalCode', '$country', '$phone', '$fax')";
        }
        $conn->Execute($sql);
        $isCreated = true;
        unset($_POST["txtNumber"]);
        unset($_POST["txtName"]);
        unset($_POST["txtAddress"]);
        unset($_POST["txtCity"]);
        unset($_POST["lstProvince"]);
        unset($_POST["txtPostalCode"]);
        unset($_POST["lstCountry"]);
        unset($_POST["txtPhone"]);
        unset($_POST["txtFax"]);
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
            <h1 class="text-center">ADD INFORMATION TO VENDORS</h1>
        </div>
    </div>
</div>
<div class="container">
    <form class="form-horizontal" role="form" action="Vendors.php" method="post"
          onsubmit="return validateVendorsForm()">
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
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtName">Vendor Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtName" name="txtName"
                       value="<?php 
                              if (!empty($_POST["txtName"])) 
                              {
                                  echo $_POST["txtName"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="nameError">
                <?php 
                if (!empty($nameError)) 
                {
                    echo $nameError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtAddress">Address</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtAddress" name="txtAddress"
                       value="<?php 
                              if (!empty($_POST["txtAddress"])) 
                              {
                                  echo $_POST["txtAddress"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="addressError">
                <?php 
                if (!empty($addressError)) 
                {
                    echo $addressError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtCity">City</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtCity" name="txtCity"
                       value="<?php 
                              if (!empty($_POST["txtCity"])) 
                              {
                                  echo $_POST["txtCity"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="cityError">
                <?php 
                if (!empty($cityError)) 
                {
                    echo $cityError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="lstProvince">Province/State</label>
            <div class="col-sm-10">
                <select class="form-control" id="lstDefault" name="lstDefault">
                    <option value="">Select:</option>
                </select>
                <select class="form-control" id="lstProvince" name="lstProvince" style="display: none">
                    <option value="">Select:</option>
                    <option value="AB" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "AB") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Alberta</option>
                    <option value="BC" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "BC") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >British Columbia</option>
                    <option value="MB" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "MB") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Manitoba</option>
                    <option value="NB" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "NB") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >New Brunswick</option>
                    <option value="NL" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "NL") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Newfoundland and Labrador</option>
                    <option value="NT" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "NT") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Northwest Territories</option>
                    <option value="NS" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "NS") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Nova Scotia</option>
                    <option value="NU" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "NU") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Nunavut</option>
                    <option value="ON" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "ON") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Ontario</option>
                    <option value="PE" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "PE") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Prince Edward Island</option>
                    <option value="QC" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "QC") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Quebec</option>
                    <option value="SK" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "SK") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Saskatchewan</option>
                    <option value="YT" 
                    <?php 
                    if (!empty($_POST["lstProvince"]) && $_POST["lstProvince"] == "YT") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Yukon</option>
                </select>
                <select class="form-control" id="lstState" name="lstState" style="display: none">
                    <option value="">Select:</option>
                    <option value="AL" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "AL") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Alabama</option>
                    <option value="AK" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "AK") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Alaska</option>
                    <option value="AZ" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "AZ") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Arizona</option>
                    <option value="AR" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "AR") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Arkansas</option>
                    <option value="CA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "CA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >California</option>
                    <option value="CO" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "CO") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Colorado</option>
                    <option value="CT" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "CT") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Connecticut</option>
                    <option value="DE" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "DE") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Delaware</option>
                    <option value="DC" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "DC") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >District Of Columbia</option>
                    <option value="FL" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "FL") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Florida</option>
                    <option value="GA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "GA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Georgia</option>
                    <option value="HI" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "HI") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Hawaii</option>
                    <option value="ID" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "ID") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Idaho</option>
                    <option value="IL" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "IL") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Illinois</option>
                    <option value="IN" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "IN") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Indiana</option>
                    <option value="IA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "IA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Iowa</option>
                    <option value="KS" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "KS") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Kansas</option>
                    <option value="KY" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "KY") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Kentucky</option>
                    <option value="LA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "LA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Louisiana</option>
                    <option value="ME" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "ME") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Maine</option>
                    <option value="MD" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MD") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Maryland</option>
                    <option value="MA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Massachusetts</option>
                    <option value="MI" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MI") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Michigan</option>
                    <option value="MN" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MN") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Minnesota</option>
                    <option value="MS" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MS") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Mississippi</option>
                    <option value="MO" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MO") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Missouri</option>
                    <option value="MT" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "MT") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Montana</option>
                    <option value="NE" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NE") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Nebraska</option>
                    <option value="NV" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NV") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Nevada</option>
                    <option value="NH" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NH") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >New Hampshire</option>
                    <option value="NJ" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NJ") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >New Jersey</option>
                    <option value="NM" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NM") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >New Mexico</option>
                    <option value="NY" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NY") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >New York</option>
                    <option value="NC" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "NC") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >North Carolina</option>
                    <option value="ND" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "ND") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >North Dakota</option>
                    <option value="OH" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "OH") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Ohio</option>
                    <option value="OK" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "OK") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Oklahoma</option>
                    <option value="OR" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "OR") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Oregon</option>
                    <option value="PA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "PA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Pennsylvania</option>
                    <option value="RI" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "RI") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Rhode Island</option>
                    <option value="SC" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "SC") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >South Carolina</option>
                    <option value="SD" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "SD") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >South Dakota</option>
                    <option value="TN" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "TN") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Tennessee</option>
                    <option value="TX" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "TX") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Texas</option>
                    <option value="UT" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "UT") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Utah</option>
                    <option value="VT" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "VT") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Vermont</option>
                    <option value="VA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "VA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Virginia</option>
                    <option value="WA" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "WA") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Washington</option>
                    <option value="WV" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "WV") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >West Virginia</option>
                    <option value="WI" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "WI") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Wisconsin</option>
                    <option value="WY" 
                    <?php 
                    if (!empty($_POST["lstState"]) && $_POST["lstState"] == "WY") 
                    {
                        echo "selected";
                    } 
                    ?>
                    >Wyoming</option>
                </select>
                <p class="text-danger" id="provinceError">
                <?php 
                if (!empty($provinceError)) 
                {
                    echo $provinceError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPostalCode">Postal/Zip Code</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtPostalCode" name="txtPostalCode"
                       value="<?php 
                              if (!empty($_POST["txtPostalCode"])) 
                              {
                                  echo $_POST["txtPostalCode"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="postalCodeError">
                <?php 
                if (!empty($postalCodeError)) 
                {
                    echo $postalCodeError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="lstCountry">Country</label>
            <div class="col-sm-10">
                <select class="form-control" id="lstCountry" name="lstCountry" onChange="getProvinces()">
                    <option value="">Select:</option>
                    <option value="Canada" 
                    <?php 
                        if (!empty($_POST["lstCountry"]) && $_POST["lstCountry"] == "Canada") 
                        {
                            echo "selected";
                        } 
                    ?>
                    >Canada</option>
                    <option value="U.S.A." 
                    <?php 
                        if (!empty($_POST["lstCountry"]) && $_POST["lstCountry"] == "U.S.A.") 
                        {
                            echo "selected";
                        } 
                    ?>
                    >U.S.A.</option>
                </select>
                <p class="text-danger" id="countryError">
                <?php 
                if (!empty($countryError)) 
                {
                    echo $countryError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPhone">Phone</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtPhone" name="txtPhone"
                       value="<?php 
                              if (!empty($_POST["txtPhone"])) 
                              {
                                  echo $_POST["txtPhone"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="phoneError">
                <?php 
                if (!empty($phoneError)) 
                {
                    echo $phoneError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtFax">Fax</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="txtFax" name="txtFax"
                       value="<?php 
                              if (!empty($_POST["txtFax"])) 
                              {
                                  echo $_POST["txtFax"];
                              } 
                              ?>"
                />
                <p class="text-danger" id="faxError">
                <?php 
                if (!empty($faxError)) 
                {
                    echo $faxError;
                } 
                ?>
                </p>
            </div>
        </div>
        <div class="form-group text-center">
            <input class="btn btn-default" type="submit" name="btnCreateVendor" value="Create"/>
            <input class="btn btn-default" type="reset" name="btnReset" value="Reset"/>
        </div>
    </form>
</div>
<?php
if (!empty($isCreated) && $isCreated)
{
    echo '<div class="container"><div class="table-responsive"><table class="table">' . 
    '<tr><th class="text-center" colspan="2">Created Vendor:</th></tr>';
    echo '<tr><td>Vendor Number:</td><td>' . $number . '</td></tr>';
    echo '<tr><td>Vendor Name:</td><td>' . $name . '</td></tr>';
    echo '<tr><td>Address:</td><td>' . $address . '</td></tr>';
    echo '<tr><td>City:</td><td>' . $city . '</td></tr>';
    echo '<tr><td>Province:</td><td>' . $province . '</td></tr>';
    echo '<tr><td>Postal Code:</td><td>' . $postalCode . '</td></tr>';
    echo '<tr><td>Country:</td><td>' . $country . '</td></tr>';
    echo '<tr><td>Phone:</td><td>' . $phone . '</td></tr>';
    echo '<tr><td>Fax:</td><td>' . $fax . '</td></tr>';
    echo '</table></div></div>';
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