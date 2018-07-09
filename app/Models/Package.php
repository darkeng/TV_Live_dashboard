<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];
    
    /**
     * A line belongs to a many lines.
     *
     * @return mixed
     */
    public function lines()
    {
        return $this->belongsToMany('App\Models\Line', 'package_id', 'id');
    }
}
