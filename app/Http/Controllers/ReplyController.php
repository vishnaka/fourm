<?php
/* ----------------------------------------------------------------------------
 * Simple Forum System - by Amila
 *
 * @author      Amila Tilakarathna<vishnaka23@gmail.com>
 * @copyright   Copyright (c) 2017, Amila
 * @link        http://forum.local/
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

namespace SimpleForum\Http\Controllers;

use Illuminate\Http\Request;
use SimpleForum\Http\Controllers\Controller;
use SimpleForum\Http\Requests\ReplyPostRequest;
use SimpleForum\Forum as Forum;
use SimpleForum\Reply as Reply;
use SimpleForum\User as User;
use Session;
use Auth;
use DB;
use Log;

class ReplyController extends Controller {
 
    /**
     * Create a constructor instance.
     * This will check auth of user and set it to session
     */
    public function __construct() {
        try {
            $this->middleware(function (Request $request, $next) {
                        if (!\Auth::check()) {
                            return redirect('/login');
                        }
                        $this->userId = \Auth::id(); // you can access user id here
                        $user_model = new User();
                        $user=$user_model->getUser($this->userId);//get log user
                        Session::flash('group', $user->group_id); // asign to session variable
                        return $next($request);
                    });
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Display a comment view list.
     * @param  $id  forum id
     * @return comment view
     */
    public function comment($id) {
        try {
            $forum_model = new Forum();
            $reply_model = new Reply();
            $forumId = $id; // get forum id
            $forum=$forum_model->getPostEditRecord($id);//get edit question information
            $comments=$reply_model->getReplyAll($id);//get all reply information
            return view('reply.comment', compact('forum', 'comments', 'forumId')); // set comments view
        } catch (\Exception $e) {
            //exception handling
            Log::error($e->getMessage()); // log error
            return view('error.500'); // set the error page
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created comment to table
     *
     * @param  ReplyPostRequest  $request
     * @return Reply view
     */
    public function store(ReplyPostRequest $request) {
        
        try {
            $reply_model = new Reply();
            $reply_model->saveReplyRecord($request);//save reply record
            return redirect("reply/{$request->forum_id}/comment")->with('success', __('messages.insert')); // load the comment reply view
        } catch (\Exception $e) {
            //exception handling
            Log::error($e->getMessage()); // log error
            return view('error.500'); // set the error page
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
