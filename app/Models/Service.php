<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 
        'time', 
        'real_volume', 
        'real_duration', 
        'billed_volume', 
        'billed_duration',
        'service_type_id',
    ];

    /**
     * Get the Service type of that service.
     */
    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType');
    }

    /**
     * Scope a query to only include service after a date in parameter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOlderThan($query, $date)
    {
        return $query->where('date', '>=',  $date);
    }

    /**
     * Scope a query to only include service after a date in parameter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $startTime
     * @param $endTime
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotBetween($query, $startTime, $endTime)
    {
        return $query->where('time', '<',  $startTime)->orWhere('time', '>', $endTime);
    }
}
