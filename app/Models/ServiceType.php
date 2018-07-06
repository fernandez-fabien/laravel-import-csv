<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    const SERVICE_TYPE_CALL = 'call';
    const SERVICE_TYPE_MESSAGE = 'message';
    const SERVICE_TYPE_CONNECTION = 'connection';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Get the services of this service type.
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    /**
     * Constructor to get the Service Type object from the title.
     *
     * @param String $title
     * @var   ServiceType
     */
    public static function getServiceType($title)
    {
        return self::where('title', $title)->first();
    }

    /**
     * Method to retrieve Call Service Type
     *
     * @return Role
     */
    public static function call()
    {
        return self::getServiceType(self::SERVICE_TYPE_CALL);
    }

    /**
     * Method to retrieve Message Service Type
     *
     * @return Role
     */
    public static function message()
    {
        return self::getServiceType(self::SERVICE_TYPE_MESSAGE);
    }

    /**
     * Method to retrieve Call Service Type
     *
     * @return Role
     */
    public static function connection()
    {
        return self::getServiceType(self::SERVICE_TYPE_CONNECTION);
    }
}
