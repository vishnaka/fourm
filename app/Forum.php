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

/*
 * This is Model class for Question
*/

class Forum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'id',
    ];

    
}
