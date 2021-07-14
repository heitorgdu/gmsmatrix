<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $table = 'users';
	protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'last_name','password','cid','username','activated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function getInformation($request)
	{
		$user_data=$request->user();
		return array("name"=>$user_data['name']);
	}

	public function getNonAdminUsers()
	{
		return User::where('is_admin','=','0')->orderBy('name')->get();
	}
}
