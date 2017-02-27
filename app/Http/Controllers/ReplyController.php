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
    // defined private table variables
    private $replytbl = 'replies';
    
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
                        $user = User::where('id', '=', $this->userId)->first(); // get user id
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
            $forumId = $id; // get forum id
            $forum = Forum::where('forum_id', $id) // fetch requird information
                            ->first();

            $comments = DB::table($this->replytbl) // get commeents for relevant forum question
                            ->join('users', 'users.id', '=', 'replies.id')
                            ->where('forum_id', $id)
                            ->orderBy('reply_id', 'desc')
                            ->get();

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
            $reply = new Reply;
            // take all parameters from $request
            $reply->reply = $request->reply;
            $reply->forum_id = $request->forum_id;
            $reply->id = $this->userId;
            $reply->save(); // save it
            return redirect("reply/{$reply->forum_id}/comment")->with('success', __('messages.insert')); // load the comment reply view
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
