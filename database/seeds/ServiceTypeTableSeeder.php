<?php

use Illuminate\Database\Seeder;
use App\Models\ServiceType;

class ServiceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::firstOrCreate(['title' => ServiceType::SERVICE_TYPE_CALL]);
        ServiceType::firstOrCreate(['title' => ServiceType::SERVICE_TYPE_CONNECTION]);
        ServiceType::firstOrCreate(['title' => ServiceType::SERVICE_TYPE_MESSAGE]);
    }
}
