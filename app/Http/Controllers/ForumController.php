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
use SimpleForum\Http\Requests\ForumPostRequest;
use SimpleForum\User as User;
use SimpleForum\Forum as Forum;
use Session;
use Auth;
use DB;
use Log;

class ForumController extends Controller {

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
     * Display a question listing to admin.
     *
     * @return forum list view
     */
    public function index() {
        try {
            $forum_model = new Forum();
            $forum = $forum_model->getPostAll(); //get questions post
            return view('forum.index', compact('forum')); // set the view of dashbaord
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

    /**
     * Display a create new question to admin.
     *
     * @return forum create form
     */
    public function create() {
        return view('forum.create');
    }

    /**
     * Store a newly created question to table
     *
     * @param  ForumPostRequest  $request
     * @return Question list view
     */
    public function store(ForumPostRequest $request) {
        try {
            $forum_model = new Forum();
            $forum = $forum_model->savePostRecord($request); //save questions post
            return redirect()->route('forum.index')
                    ->with('success', __('messages.insert')); // load the admin question list view
        } catch (\Exception $e) {
            //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Edit question in admin
     *
     * @param  int  $id
     * @return question edit view
     */
    public function edit($id) {
        try {
            $forum_model = new Forum();
            $forum=$forum_model->getPostEditRecord($id);//get edit information
            return view('forum.edit', compact('forum')); // load the edit question view
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

    /**
     * Update the question edit to table.
     *
     * @param  ForumPostRequest  $request
     * @param  int  $id
     * @return question list view
     */
    public function update(ForumPostRequest $request, $id) {

        try {
            $forum_model = new Forum();
            $forum = $forum_model->savePostRecord($request,$id); //update questions post
            return redirect()->route('forum.index')
                    ->with('success', __('messages.update')); // load the question list view in admin
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

    /**
     * Delete question in admin
     *
     * @param  int  $id
     * @return question list view
     */
    public function destroy($id) {
        try {
            $forum_model = new Forum();
            $forum = $forum_model->deletePostRecord($id);// delete record from table
            return redirect()->route('forum.index')
                    ->with('success', __('messages.delete')); // load the question list view in admin
        } catch (\Exception $e) {
            //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

}
