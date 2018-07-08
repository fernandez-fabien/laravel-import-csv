<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Csv extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'csv';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'filepath',
        'extension',
        'processed'
    ];
}