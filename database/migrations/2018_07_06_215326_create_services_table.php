<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            
            $table->datetime("made_at");
            $table->float("volume_consumed")->nullable();
            $table->time("duration_consumed")->nullable();
            $table->float("volume_billed")->nullable();
            $table->time("duration_billed")->nullable();
            
            $table->unsignedInteger('service_type_id');
            $table->foreign('service_type_id')->references('id')->on('service_types');

            $table->unsignedInteger('suscriber');
            $table->foreign('suscriber')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
