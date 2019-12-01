<?php

namespace poi\EntityClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    use Notifiable;
    protected $table='users';
    protected $primaryKey='id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick', 'email', 'password',
    ];
    public $timestamps = false;
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded=[];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function receivesBroadcastNotificationsOn() { return 'users.'.$this->id; }
   
}
