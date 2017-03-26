/*
 *  File Name: Assignment5.js
 *  Author: Gonzalo Ramos Zúñiga
 */

function validateVendorsForm()
{
    var number = document.getElementById("txtNumber").value.trim();
    var name = document.getElementById("txtName").value.trim();
    var address = document.getElementById("txtAddress").value.trim();
    var city = document.getElementById("txtCity").value.trim();
    var country = document.getElementById("lstCountry").value.trim();
    var province;
    if (country == "Canada")
    {
        province = document.getElementById("lstProvince").value.trim();
    }
    else if (country == "U.S.A.")
    {
        province = document.getElementById("lstState").value.trim();
    }
    var postalCode = document.getElementById("txtPostalCode").value.trim().toUpperCase();
    var phone = document.getElementById("txtPhone").value.trim();
    var fax = document.getElementById("txtFax").value.trim();
    var formOkay = true;

    if (number == null || number == "")
    {
        document.getElementById("numberError").innerHTML = "Vendor Number is required.";
        formOkay = false;
    }
    else if (isNaN(number))
    {
        document.getElementById("numberError").innerHTML = "Vendor Number must be a number.";
        formOkay = false;
    }
    else
    {
        document.getElementById("numberError").innerHTML = "";
    }

    if (name == null || name == "")
    {
        document.getElementById("nameError").innerHTML = "Vendor Name is required.";
        formOkay = false;
    }
    else if (name.length > 30)
    {
        document.getElementById("nameError").innerHTML = "Vendor Name must not be longer than 30" +
            " characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("nameError").innerHTML = "";
    }

    if (address == null || address == "")
    {
        document.getElementById("addressError").innerHTML = "Address is required.";
        formOkay = false;
    }
    else if (address.length > 30)
    {
        document.getElementById("addressError").innerHTML = "Address must not be longer than 30" +
            " characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("addressError").innerHTML = "";
    }

    if (city == null || city == "")
    {
        document.getElementById("cityError").innerHTML = "City is required.";
        formOkay = false;
    }
    else if (city.length > 20)
    {
        document.getElementById("cityError").innerHTML = "City must not be longer than 20 characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("cityError").innerHTML = "";
    }

    if (province == null || province == "")
    {
        document.getElementById("provinceError").innerHTML = "Province/State is required.";
        formOkay = false;
    }
    else if (province.length > 2)
    {
        document.getElementById("provinceError").innerHTML = "Province/State must not be longer than" +
            " 2 characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("provinceError").innerHTML = "";
    }

    var rePostalCode;
    if (country == "Canada")
    {
        rePostalCode = /^[A-Z][0-9][A-Z][0-9][A-Z][0-9]$/;
    }
    else if (country == "U.S.A.")
    {
        rePostalCode = /^[0-9]{5}$/;
    }
    if (postalCode == null || postalCode == "")
    {
        document.getElementById("postalCodeError").innerHTML = "Postal/Zip Code is required.";
        formOkay = false;
    }
    else if (postalCode.length > 9)
    {
        document.getElementById("postalCodeError").innerHTML = "Postal/Zip Code must not be longer than" +
            " 9 characters.";
        formOkay = false;
    }
    else if (rePostalCode != null && !rePostalCode.test(postalCode))
    {
        document.getElementById("postalCodeError").innerHTML = "Postal/Zip must be in format A1A1A1" +
            " for Canada and 11111 for U.S.A.";
        formOkay = false;
    }
    else
    {
        document.getElementById("postalCodeError").innerHTML = "";
    }

    if (country == null || country == "")
    {
        document.getElementById("countryError").innerHTML = "Country is required.";
        formOkay = false;
    }
    else if (country.length > 15)
    {
        document.getElementById("countryError").innerHTML = "Country must not be longer than 15" +
            " characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("countryError").innerHTML = "";
    }

    if ((phone != null && phone != "") && phone.length > 15)
    {
        document.getElementById("phoneError").innerHTML = "Phone must not be longer than 15 characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("phoneError").innerHTML = "";
    }


    if ((fax != null && fax != "") && fax.length > 15)
    {
        document.getElementById("faxError").innerHTML = "Fax must not be longer than 15 characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("faxError").innerHTML = "";
    }

    return formOkay;
}

function validatePartsForm()
{
    var vendor = document.getElementById("lstVendors").value.trim();
    var description = document.getElementById("txtDescription").value.trim();
    var hand = document.getElementById("txtHand").value.trim();
    var order = document.getElementById("txtOrder").value.trim();
    var cost = document.getElementById("txtCost").value.trim();
    var price = document.getElementById("txtPrice").value.trim();
    var formOkay = true;

    if (vendor == null || vendor == "")
    {
        document.getElementById("vendorError").innerHTML = "Vendor is required.";
        formOkay = false;
    }
    else
    {
        document.getElementById("vendorError").innerHTML = "";
    }

    if (description == null || description == "")
    {
        document.getElementById("descriptionError").innerHTML = "Description is required.";
        formOkay = false;
    }
    else if (description.length > 30)
    {
        document.getElementById("descriptionError").innerHTML = "Description must not be longer than" +
            " 30 characters.";
        formOkay = false;
    }
    else
    {
        document.getElementById("descriptionError").innerHTML = "";
    }

    if (hand == null || hand == "")
    {
        document.getElementById("handError").innerHTML = "On Hand is required.";
        formOkay = false;
    }
    else if (isNaN(hand))
    {
        document.getElementById("handError").innerHTML = "On Hand must be a number.";
        formOkay = false;
    }
    else if (hand < 0)
    {
        document.getElementById("handError").innerHTML = "On Hand must be greater or equal than 0.";
        formOkay = false;
    }
    else
    {
        document.getElementById("handError").innerHTML = "";
    }

    if (order == null || order == "")
    {
        document.getElementById("orderError").innerHTML = "On Order is required.";
        formOkay = false;
    }
    else if (isNaN(order))
    {
        document.getElementById("orderError").innerHTML = "On Order must be a number.";
        formOkay = false;
    }
    else if (order < 0)
    {
        document.getElementById("orderError").innerHTML = "On Order must be greater or equal than 0.";
        formOkay = false;
    }
    else
    {
        document.getElementById("orderError").innerHTML = "";
    }

    if (cost == null || cost == "")
    {
        document.getElementById("costError").innerHTML = "Cost is required.";
        formOkay = false;
    }
    else if (isNaN(cost))
    {
        document.getElementById("costError").innerHTML = "Cost must be a number.";
        formOkay = false;
    }
    else if (cost < 0)
    {
        document.getElementById("costError").innerHTML = "Cost must be greater or equal than 0.";
        formOkay = false;
    }
    else
    {
        document.getElementById("costError").innerHTML = "";
    }

    if (price == null || price == "")
    {
        document.getElementById("priceError").innerHTML = "List Price is required.";
        formOkay = false;
    }
    else if (isNaN(price))
    {
        document.getElementById("priceError").innerHTML = "List Price must be a number.";
        formOkay = false;
    }
    else if (price < 0)
    {
        document.getElementById("priceError").innerHTML = "List Price must be greater or equal than 0.";
        formOkay = false;
    }
    else if (price < cost)
    {
        document.getElementById("priceError").innerHTML = "List Price must be equal or greater than Cost.";
        formOkay = false;
    }
    else
    {
        document.getElementById("priceError").innerHTML = "";
    }

    return formOkay;
}

function validateQueryForm()
{
    var number = document.getElementById("txtNumber").value.trim();
    var formOkay = true;

    if (number == null || number == "")
    {
        document.getElementById("numberError").innerHTML = "Vendor Number is required.";
        formOkay = false;
    }
    else if (isNaN(number))
    {
        document.getElementById("numberError").innerHTML = "Vendor Number must be a number.";
        formOkay = false;
    }
    else
    {
        document.getElementById("numberError").innerHTML = "";
    }

    return formOkay;
}

function getProvinces()
{
    var country = document.getElementById("lstCountry").value.trim();

    if (country == "Canada")
    {
        document.getElementById("lstDefault").style.display = 'none';
        document.getElementById("lstDefault").disabled = true;
        document.getElementById("lstProvince").style.display = 'inline';
        document.getElementById("lstProvince").disabled = false;
        document.getElementById("lstState").style.display = 'none';
        document.getElementById("lstState").disabled = true;
    }
    else if (country == "U.S.A.")
    {
        document.getElementById("lstDefault").style.display = 'none';
        document.getElementById("lstDefault").disabled = true;
        document.getElementById("lstProvince").style.display = 'none';
        document.getElementById("lstProvince").disabled = true;
        document.getElementById("lstState").style.display = 'inline';
        document.getElementById("lstState").disabled = false;
    }
    else if (country == "")
    {
        document.getElementById("lstDefault").style.display = 'inline';
        document.getElementById("lstDefault").disabled = false;
        document.getElementById("lstState").style.display = 'none';
        document.getElementById("lstProvince").disabled = true;
        document.getElementById("lstProvince").style.display = 'none';
        document.getElementById("lstState").disabled = true;
    }
}