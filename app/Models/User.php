<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use App\Traits\DatesTranslator;

class User extends Authenticatable
{
    use Notifiable;
    use Messagable;
    use HasRoleAndPermission;
    use DatesTranslator;

    Protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password', 'temp_password', 'avatar', 'activated', 'confirmed'
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
     * Build line Relationships.
     *
     * @var array
     */
    public function lines()
    {
        return $this->hasMany('App\Models\Line', 'user_id', 'id');
    }

    public function isActivated()
    {
        return $this->activated;
    }
    public function isConfirmed()
    {
        return $this->confirmed;
    }
}
