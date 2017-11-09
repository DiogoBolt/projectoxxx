<?php
/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 13/07/2016
 * Time: 10:27
 */

namespace App\Lib\Helpers;


use Carbon\Carbon;

class GitHelpers
{
    public static function convertDate($date){
        $t = date_parse($date);
        return Carbon::create($t['year'], $t['month'],$t['day'],$t['hour'],$t['minute'],$t['second'])->addMinutes($t['zone']);
    }
}