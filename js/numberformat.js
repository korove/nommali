var numberformat = new Object ();

numberformat.keyPressIntegerOnly = function (myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event) key = window.event.keyCode;
    else if (e) key = e.which;
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) )
       return true;

    else if ((("0123456789").indexOf(keychar) > -1))
       return true;

    else if (dec && (keychar == "."))
    {
    myfield.form.elements[dec].focus();
    return false;
    }
    else return false;
}

numberformat.keyPressIntegerAndStar = function (myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event) key = window.event.keyCode;
    else if (e) key = e.which;
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) )
       return true;

    else if ((("0123456789*%").indexOf(keychar) > -1))
       return true;

    else if (dec && (keychar == "."))
    {
    myfield.form.elements[dec].focus();
    return false;
    }
    else return false;
}

numberformat.keyPressIntegerOnlyIncludeMinus = function (myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event) key = window.event.keyCode;
    else if (e) key = e.which;
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) ||(key==45) )
       return true;

    else if ((("0123456789").indexOf(keychar) > -1))
       return true;

    else if (dec && (keychar == "."))
    {
    myfield.form.elements[dec].focus();
    return false;
    }
    else return false;
}

numberformat.keyPressDecimalOnly = function (myfield, e, dec)
{
    var key;
    var keychar;
    
    if (window.event) key = window.event.keyCode;
    else if (e) key = e.which;
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) ) {
       return true;

    } else if ((("0123456789.").indexOf(keychar) > -1)) {
    	if (keychar == "." && myfield.value.indexOf(".") > -1) {
    		return false; 
    	} else {
       		return true;
       	}

    } else if (dec && (keychar == ".")) {
	    myfield.form.elements[dec].focus();
	    return false;
    } else return false;
}

numberformat.keyPressBuddhismYear = function (myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event) key = window.event.keyCode;
    else if (e) key = e.which;
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) )
       return true;

    else if ((("0123456789").indexOf(keychar) > -1))
       return true;

    else if (dec && (keychar == "."))
    {
    myfield.form.elements[dec].focus();
    return false;
    }
    else return false;
}

numberformat.addCommas = function (nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

numberformat.removeComma = function (str) 
{
    return str.replace(/,/gi,"");
}

numberformat.removeUntilLastDot = function(str)
{
    var isFoundDot = false;
    var newString = "";
    for (var i = (str.length - 1); i >= 0; i--)
    {
        if (str.charAt(i) == '.')
        {
            if (!isFoundDot)
            {
                newString = str.charAt(i) + newString;
                isFoundDot = true;
            }
        }
        else
        {
            newString = str.charAt(i) + newString;
        }
    }
    
    return newString;
}

numberformat.formatDecimal = function (str)
{
    var tmpStr = numberformat.removeUntilLastDot(str);
    tmpStr = numberformat.removeComma(tmpStr);
    tmpNumber = new Number(tmpStr).valueOf();
    tmpNumber = tmpNumber.toFixed(2);
    tmpStr = tmpNumber.toString();
    tmpStr = numberformat.addCommas(tmpStr);
    
    return tmpStr;
}

numberformat.formatInteger = function (str)
{
    var tmpStr = numberformat.removeUntilLastDot(str);
    tmpStr = numberformat.removeComma(tmpStr);
    tmpNumber = new Number(tmpStr).valueOf();
    tmpNumber = tmpNumber.toFixed(0);
    tmpStr = tmpNumber.toString();
    tmpStr = numberformat.addCommas(tmpStr);
    
    return tmpStr;
}

numberformat.formatDecimalObject = function (obj)
{
    if (commonfunction.isBlankValue(obj.value))
    {
        obj.value = '0.00';
    }
    else
    {
        obj.value = numberformat.formatDecimal(obj.value);
    }
}

numberformat.removeCommasObject = function (obj)
{
    obj.value = numberformat.removeComma(obj.value);
}

numberformat.formatIntegerObject = function (obj)
{
    if (commonfunction.isBlankValue(obj.value))
    {
        obj.value = '0';
    }
    else
    {
        obj.value = numberformat.formatInteger(obj.value);
    }
}
