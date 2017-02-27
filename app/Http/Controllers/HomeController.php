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
use SimpleForum\Forum as Forum;
use SimpleForum\User as User;
use Session;
use Auth;
use DB;
use Log;

class HomeController extends Controller {

    // defined private table variables
    private $forumtbl = 'forums';
    private $replytbl = 'replies';
    private $usertbl = 'users';

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
     * Show the application dashboard.
     * This willl load the all the questions to dashbord view
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            //get questions post
            $posts = DB::table($this->forumtbl)
                            ->join($this->usertbl, 'users.id', '=', 'forums.id')
                            ->orderBy('forum_id', 'desc')
                            ->get();


            // check count of reply for question
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
            return view('home', compact('posts')); // set the view of dashbaord
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
            return view('error.500'); // set the error page
        }
    }

}
