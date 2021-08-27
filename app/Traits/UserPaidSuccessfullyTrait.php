<?php

namespace App\Traits;

use App\Models\User;

trait UserPaidSuccessfullyTrait{
    function paid($pay){
        User::where('id',$pay->user_id)->increment('minutes', $pay->minutes);
    }
}