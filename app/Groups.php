<?php

/* ----------------------------------------------------------------------------
 * Simple Forum System - by Amila
 *
 * @author      Amila Tilakarathna<vishnaka23@gmail.com>
 * @copyright   Copyright (c) 2017, Amila
 * @link        http://forum.local/
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

namespace SimpleForum;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;
use Auth;

class Groups extends Model
{
    private $usertbl = 'users';
    private $grouptbl = 'groups';

    /**
     * get all user group information
     *
     * @return $groups object
     */
    public function getGroupAll() {
        try {
             $groups = DB::table($this->grouptbl)
                            ->get();
            return $groups;
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }
}
