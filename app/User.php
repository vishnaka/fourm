<?php

namespace SimpleForum;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Log;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    
    // defined private table variables
    private $forumtbl = 'forums';
    private $replytbl = 'replies';
    private $usertbl = 'users';
    private $grouptbl = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * get all user information
     *
     * @return $memeber object
     */
    public function getUserAll() {
        try {
            $member = DB::table($this->usertbl)
                            ->join($this->grouptbl, 'users.group_id', '=', 'groups.group_id')
                            ->orderBy('id', 'desc')
                            ->get();
            return $member;
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }

    /**
     * get filter user information
     *
     * @param  user_id  $id
     * @return $id object
     */
    public function getUser($id) {
        try {
            $user = Auth::user();
            $member = $user::where('id', '=', $id)->firstOrFail();
            return $member;
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }

    /**
     * get save/update user records
     *
     * @param  Post object  $objRequest
     * @return void
     */
    public function saveUserRecord($objRequest,$id=-1){
        try {
            if($id>0){
                //update user information
                $user = Auth::user();
                $member = $user::where('id', '=', $id)->firstOrFail();

                DB::table($this->usertbl)
                ->where('id', $id)
                ->update(['name' => $objRequest->name,
                'group_id' => $objRequest->group_id
                ]);
            }else{
                //todo
            }
            $member->save();
        } catch (\Exception $e) { //exception handling
            Log::error($e->getMessage()); // log error to file
        }
    }
}
