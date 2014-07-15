<?php
class CustomValidator extends Illuminate\Validation\Validator
 {


    public function validatePostcode($attribute, $value, $parameters = null) 
    {
        $regex = "/^((GIR 0AA)|((([A-PR-UWYZ][0-9][0-9]?)|(([A-PR-UWYZ][A-HK-Y][0-9][0-9]?)|(([A-PR-UWYZ][0-9][A-HJKSTUW])|([A-PR-UWYZ][A-HK-Y][0-9][ABEHMNPRVWXY])))) [0-9][ABD-HJLNP-UW-Z]{2}))$/i";
        if (preg_match($regex, $value)) {
            return true;
        }
        return false;
    }

    /* allow spaces and some special characters */
    public function validateAlphaCustom($attribute, $value, $parameters = null) 
    {
    	$regex = "/^[a-zA-Zéèàçùú.\,-\/:\' ]+$/";
    	if (preg_match($regex, $value)) {
            return true;
        }
        return false;
    }

    public function validateAlphaNumCustom($attribute, $value, $parameters = null) 
    {
        $regex = "/^[a-zA-Z0-9éèàçùú&.\,-\/:\'_ !?();]+$/";
        if (preg_match($regex, $value)) {
            return true;
        }
        return false;
    }


}