<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\OtpMailJob;
use App\Mail\OtpMail;
use Illuminate\Http\Request;

class OtpMailJobController extends Controller
{
    public function processQueue($email, OtpMail $otp_mail)
    {
        dispatch(new OtpMailJob($email, $otp_mail));
    }
}
