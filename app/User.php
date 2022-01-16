<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



      public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Model\Task');
    }

    public function hasRole($role)
    {
        if($role != null){
            if($this != null){
                $roles = $this->roles()->where('name', $role)->count();
                if($roles >= 1){
                    return true;
                }
                return false;
            }
            else{
                return redirect()->route('/home');
            }
        }
        else{
            return redirect()->route('/home');
        }
    }

    public function hasTask($role)
    {
        if($role != null){
            if($this != null){
                $roles = $this->tasks()->where('name', $role)->count();
                if($roles >= 1){
                    return true;
                }
                return false;
            }
            else{
                return redirect()->route('/home');
            }
        }
        else{
            return redirect()->route('/home');
        }
    }

    /* public function hasRole($role)
     {
         if($role != null){
             if($this != null){
                 $roles = $this->roles()->where('name', $role)->count();
                 if($roles >= 1){
                     return true;
                 }
                 return false;
             }
             else{
                 return redirect()->route('/home');
             }
         }
         else{
             return redirect()->route('/home');
         }
     }*/

    public static function hasPermission($role, $user_id){
        $user = User::find($user_id);

        $roles = $user->roles()->where('name', $role)->count();
        if($roles >= 1){
            return true;
        }
        return false;
    }

    public static function hasTaskPermission($task, $user_id){
        $user = User::find($user_id);

        $tasks = $user->tasks()->where('name', $task)->count();
        if($tasks >= 1){
            return true;
        }
        return false;
    }

    public function getProfilePicture($id){
        $userImage = User::find($id)->profile_picture;
        if($userImage == null){
            return 'imageFolder/user/user.png';
        }
        else{
            return $userImage;
        }
    }
}
