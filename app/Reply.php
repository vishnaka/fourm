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

/*
 * This is Model class for comments
*/

class Reply extends Model {
    // defined private table variables
    private $forumtbl = 'forums';
    private $replytbl = 'replies';
    private $usertbl = 'users';

    /**
     * get all reply information
     *
     * @param  forum id  $id
     * @return $comments object
     */
    public function getReplyAll($id) {
        try {
            $comments = DB::table($this->replytbl) // get commeents for relevant forum question
                                ->join($this->usertbl, 'users.id', '=', 'replies.id')
                                ->where('forum_id', $id)
                                ->orderBy('reply_id', 'desc')
                                ->get();
            return $comments;
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }

    /**
     * get save/update reply records
     *
     * @param  Post object  $objRequest
     * @return void
     */
    public function saveReplyRecord($objRequest,$id=-1){
        try {
            $reply = new Reply;
            if($id>0){
                // todo
            }else{
                // take all parameters from $request
                $reply->reply = $objRequest->reply;
                $reply->forum_id = $objRequest->forum_id;
                $reply->id = \Auth::id();
            }
            $reply->save(); // save it
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }
    
}
