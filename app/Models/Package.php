<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package_id', 'name'
    ];
    
    /**
     * A line belongs to a many lines.
     *
     * @return mixed
     */
    public function lines()
    {
        return $this->belongsToMany('App\Models\Line', 'package_id', 'package_id');
    }
}
