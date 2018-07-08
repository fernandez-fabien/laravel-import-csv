<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
    ];

    /**
     * Get the services of this service type.
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service', 'suscriber');
    }
}
