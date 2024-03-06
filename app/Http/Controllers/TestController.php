<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Byteplus\Service\Iam;
use Byteplus\Service\Live;
use Byteplus\Service\Livesaas;
use Byteplus\Service\Rtc;

class TestController extends Controller
{
    public function liveApi2()
    {
        $live = Rtc::getInstance();
        return $live->GetRecordTask([]);
    }
}
