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
use SimpleForum\Http\Requests\MemberRequest;
use SimpleForum\User as User;
use SimpleForum\Groups as Groups;
use Auth;
use Session;
use DB;
use Log;

class MemberController extends Controller {
    // defined private table variables
    private $usertbl = 'users';
    private $grouptbl = 'groups';

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
     * Display a listing of users.
     *
     * @return user list view
     */
    public function index() {

        try {
            $user_model = new User();
            $member=$user_model->getUserAll();//get all users list
            return view('member.index', compact('member')); // load the user list view
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500');// set the error page
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
     * Show edit form for user.
     *
     * @param  int  $id
     * @return user edit form view
     */
    public function edit($id) {
        try {
            $user_model = new User();
            $group_model = new Groups();
            $member=$user_model->getUser($id);//get user details
            $groups=$group_model->getGroupAll();//get user group details
            return view('member.edit', compact('member', 'groups'));// load the user edit view
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage());// log error to file
            return view('error.500');// set the error page
        }
    }

    /**
     * Update user information to table.
     *
     * @param  MemberRequest  $request
     * @param  int  $id
     * @return user list view
     */
    public function update(MemberRequest $request, $id) {

        try {
            $user_model = new User();
            $user_model->saveUserRecord($request,$id);//get user details
            return redirect()->route('member.index')
                    ->with('success', __('messages.update'));
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage());// log error to file
            return view('error.500');// set the error page
        }
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
