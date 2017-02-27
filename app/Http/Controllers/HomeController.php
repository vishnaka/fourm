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
use Log;

class HomeController extends Controller {

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
     * Show the application dashboard.
     * This willl load the all the questions to dashbord view
     * @return post view 
     */
    public function index() {
            try {
                $forum_model = new Forum();
                $posts=$forum_model->getPostAll(true);//get questions post
                return view('home', compact('posts')); // set the view of dashbaord
            } catch (\Exception $e) { //exception handling
                Log::error($e->getMessage()); // log error to file
                return view('error.500'); // set the error page
            }
    }

}
