<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
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
        'name', 'email', 'password','role_id','assigned_doctor_id',
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

    protected $dates = ['deleted_at'];

    public function scopeSearch($query, $search){
        return $query
            ->where('name','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->orWhereHas('role',function($q)use($search){
                $q->where('name','like','%'.$search.'%');
            });
            
    }

    public function role()
    {
        return $this->belongsTo(\App\Role::class);
    }


    public function appointments()
    {
        return $this->hasMany(\App\Appointment::class);
    }

    public function assigned_doctor(){
        return $this->belongsTo(\App\User::class)->withTrashed();
    }

    public function assigned_doctors(){
        return $this->hasMany(\App\User::class);
    }
}
