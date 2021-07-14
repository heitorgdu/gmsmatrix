<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srv', function (Blueprint $table) {

            $table->increments('srv_id')->comment = "Service ID";
            $table->string('name')->index('name')->comment = "Name of service";
            $table->string('type')->comment = "Type of service";
            $table->float('price')->comment = "Cost per month";
            $table->float('setup')->comment = "Setup fee";
            $table->timestamp('date_mod')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = "Date modified";
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
        Schema::drop('srv');
    }
}
