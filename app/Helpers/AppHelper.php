<?php
namespace App\Helpers;

use App\Models\Logdata;

class AppHelper
{

    /**
     * Manthabill v.2.0
     * Date: 18-12-2021
     * Author:AlexisDev
     * Email: alexistdev@gmail.com
     * Phone: 0813-7982-3241
     */

    public static function logData($msg,$userid)
    {
        $log = new Logdata();
        $log->user_id = $userid;
        $log->name = $msg;
        $log->save();
    }

}
