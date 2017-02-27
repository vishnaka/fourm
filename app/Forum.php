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
 * This is Model class for Question
 */

class Forum extends Model
{
    // defined private table variables
    private $forumtbl = 'forums';
    private $replytbl = 'replies';
    private $usertbl = 'users';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['question', 'id'];

/**
 * get all post information
 *
 * @param  count  $count
 * @return $post object
 */
public function getPostAll($count=false) {
    try {
        $posts = DB::table($this->forumtbl)
                        ->join($this->usertbl, 'users.id', '=', 'forums.id')
                        ->orderBy('forum_id', 'desc')
                        ->get();

        if ($count) {
            if ($posts->count()) {
                foreach ($posts as $value) {
                    $count = DB::table($this->replytbl)->select(DB::raw('count(*) as count'))
                                    ->where('forum_id', $value->forum_id)
                                    ->get();
                    foreach ($count as $val) {
                        $value->count = $val->count; // set the count
                    }
                }
            }
        }
        return $posts;
    } catch (\Exception $e) { //exception handling
        Log::error($e->getMessage()); // log error to file
    }
 }

 /**
 * get edit post information
 *
 * @param  post id  $id
 * @return $postrecord object
 */
  public function getPostEditRecord($id) {
        try {
            $forumRec = Forum::where('forum_id', '=', $id)->firstOrFail();
            return $forumRec;
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }

    /**
     * get save/update post records
     *
     * @param  Post object  $objRequest
     * @return void
     */
    public function savePostRecord($objRequest,$id=-1){
        try {
            $forum = new Forum;
            if($id>0){
                $forum = Forum::where('forum_id', '=', $id)->firstOrFail();
                DB::table($this->forumtbl)
                ->where('forum_id', $id)
                ->update(['question' => $objRequest->question,
                'id' => \Auth::id()
                ]);
            }else{
                $forum->question = $objRequest->question;
                $forum->id = \Auth::id();
            }

            $forum->save();
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }

    /**
     * get delete post records
     *
     * @param  post id  $id
     * @return void
     */
    public function deletePostRecord($id) {
        try {
            DB::table($this->forumtbl)->where('forum_id', $id)->delete();
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }
    
}
