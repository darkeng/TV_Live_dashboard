<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'lines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['line_id', 'status', 'username', 'password', 'expire', 'package_id', 'line_type', 'reseller_notes', 'user_id'];
    
    /**
     * A line belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Line Package Relationships.
     *
     * @return mixed
     */
    public function package()
    {
        return $this->hasOne('App\Models\Package', 'package_id', 'id');
    }
}
