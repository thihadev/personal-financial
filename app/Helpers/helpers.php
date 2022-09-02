<?php

use Googlei18n\MyanmarTools\ZawgyiDetector;
use Carbon\Carbon;

if (! function_exists('image_path')) {

    function image_path($value, $default = 1) 
    {
        $expired_time = config('app.temp_url_expire_time');

        if (env('FILESYSTEM_DISK') != 's3') {
            return Storage::url($value);
        } 

        // if (is_object($value)) {
        //     return is_null($value)
        //         ? ( is_null($default) ? $value : asset("/img/no-profile.jpg")) 
        //         : Storage::temporaryUrl($value, now()->addMinutes($expired_time));
        // }
        
        if ($value == "") {
            return asset("/img/no-image.jpg");
        }

        return is_null($value)
            ? (is_null($default) ? $value : asset("/img/no-profile.jpg"))
            : Storage::temporaryUrl($value, now()->addMinutes($expired_time));
    }
}

// if (! function_exists('image_path')) {

//     function image_path($value, $default = 1) 
//     {
//         if (is_null($value)) { 
//             return is_null($default) ? $value : asset("img/default.png");
//         }

//         return Storage::url($value);
//     }
// }

if (! function_exists('open_segment')) {

    function open_segment($index, $path) 
    {
        return request()->segment($index) == $path ? 'menu-open' : '';
    }
    
}


if (! function_exists('active_segment')) {

    function active_segment($index, $path) 
    {
        return request()->segment($index) == $path ? 'active' : '';
    }
}

if (! function_exists('active_path')) {

	function active_path($path = null) 
	{
		$path = is_null($path) 
        ? config('app.admin_prefix')
        : config('app.admin_prefix').'/'.$path;

        return request()->is($path) ? 'active' : '';
    }

}

/**
* Validate Phone number
*/
if(!function_exists('is_valid_phone')){
    function is_valid_phone($phone){
        return
        (mytel_check($phone) || mpt_check($phone)
            || telenor_check($phone) || ooredoo_check($phone)
            || mectel_check($phone));
    }
}

if(! function_exists('mytel_check')){
    function mytel_check($number)
    {
        return preg_match(
            '/^(096|\+?9596)(9|8|7|6|5|)\d{7}$/',
            $number
        ) ? true : false;
    }
}

if(!function_exists('mpt_check')){
    function mpt_check($number)
    {
        return preg_match(
            '/^(09|\+?959)(2[0-4]\d{5}|5[0-6]\d{5}|8[13-7]\d{5}|3[0-369]\d{6}|34\d{7}|4[1379]\d{6}|73\d{6}|91\d{6}|25\d{7}|26\d{7}|40\d{7}|42\d{7}|44\d{7}|45\d{7}||88\d{7}|89\d{7})$/',
            $number
        ) ? true : false;
    }
}

if(! function_exists('telenor_check')){
    function telenor_check($number)
    {
        return preg_match(
            '/^(097|\+?9597)(9|8|7|6|5|4|3)\d{7}$/',
            $number
        ) ? true : false;
    }
}

if(! function_exists('ooredoo_check')){
    function ooredoo_check($number)
    {
        return preg_match(
            '/^(099|\+?9599)(9|8|7|6|5|4|3)\d{7}$/',
            $number
        ) ? true : false;
    }
}

if(! function_exists('mectel_check')){
    function mectel_check($number)
    {
        return preg_match(
            '/^(093|\+?9593)(0|1|2|3|4|5|6)(\d{6}|\d{7})$/',
            $number
        ) ? true : false;
    }
}

if(! function_exists('phoneNumberSantinize')){
    function phoneNumberSantinize($number)
    {
        return preg_replace('/^(\+?959|\+?9509)/', '09', $number);
    }
}


if (! function_exists('empty_string_to_null')) {
    /**
     *
     * @return string
     */
    function empty_string_to_null($value)
    {
        return trim($value) === "" ? null : $value;
    }
}

/**
 * Character 3 Number 6 random string
 */
if (! function_exists('chr3n6_random')) {
    
    function chr3n6_random()
    {
        return chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100000, 999999);
    }
}


/**
 * Upload with Laravel Storage
 */

if (! function_exists('storage_upload')) {

    function storage_upload($image, $image_path, $driver = null)
    {
        $image_ex = $image->getClientOriginalExtension();

        $imageName = time().Str::random(6).".".$image_ex;

        return $image->storeAs($image_path, $imageName, $driver ?? config('filesystems.default'));
    }

}

if (! function_exists('generateRandomString')) {

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


if (! function_exists('isZawGyi')) {

    function isZawGyi($text = "") {

        $detector = new ZawgyiDetector();

        if (!$text) {
            return;
        }

        $score = $detector->getZawgyiProbability($text);

        if ($score >= 0.95) { 
            return true;
        } else if ($score <= 0.05) {
            return false;
        }
    }
}

/**
 * CSV to array
 */
if (! function_exists('csv_to_array')) {

    function csv_to_array($CSVFile)
    {
        if (! file_exists($CSVFile) || ! is_readable($CSVFile))
            return false;

        $header = null;
        $data = [];

        if (($handle = fopen($CSVFile,'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (! $header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}

/**
 * CSV to array
 */
if (! function_exists('csv_to_array_space')) {

    function csv_to_array_space($CSVFile)
    {
        if (! file_exists($CSVFile) || ! is_readable($CSVFile))
            return false;

        $header = null;
        $data = [];

        if (($handle = fopen($CSVFile,'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ' ')) !== false) {
                if (! $header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}

/**
* Get base64 image and save in storage.
*/
if(!function_exists('getBase64Image'))
{
    function getBase64Image($image, $path)
    {
        $extension = 'png';
        
        $imageName = $path . '/' . time().Str::random(6) . '.' . $extension;

        \Storage::put($imageName, base64_decode($image));

        return $imageName;
    }
}

if (! function_exists('decimal_format')) {

    function decimal_format($value)
    {
        return number_format($value, 2, '.', '');
    }

}

if (! function_exists('split_daterange')) {

    function split_daterange($date)
    {
        if (! $date) return null;

        $date = explode(' - ', $date);
        $from = $date[0];
        $to = $date[1];
        $from = str_replace('/', '-', $from);
        $to = str_replace('/', '-', $to);
        
        return ['from' => $from, 'to' => $to];
    }
}



if (! function_exists('carbon_parse')) {

    function carbon_parse($value)
    {
        return \Carbon\Carbon::parse($value);
    }

}

if (! function_exists('mm_to_eng_number')) {

    function mm_to_eng_number($numberInput) {

    $numbers_1 = ["၀" => 0,"၁" => 1,"၂" => 2,"၃" => 3,"၄" => 4,"၅" => 5,"၆" => 6,"၇" => 7,"၈" => 8,"၉" => 9];
    $numbers_2 = [0=>"၀",1=>"၁",2=>"၂",3=>"၃",4=>"၄",5=>"၅",6=>"၆",7=>"၇",8=>"၈",9=>"၉"];
    $change = str_replace($numbers_2, $numbers_1, $numberInput);
    return $change;
    }
}

if (! function_exists('eng_to_mm_number')) {

    function eng_to_mm_number($numberInput) {

    $numbers_1 = [0=>"၀",1=>"၁",2=>"၂",3=>"၃",4=>"၄",5=>"၅",6=>"၆",7=>"၇",8=>"၈",9=>"၉"];
    $numbers_2 = ["၀" => 0,"၁" => 1,"၂" => 2,"၃" => 3,"၄" => 4,"၅" => 5,"၆" => 6,"၇" => 7,"၈" => 8,"၉" => 9];
    $change = str_replace($numbers_2, $numbers_1, $numberInput);
    return $change;
    }
}


