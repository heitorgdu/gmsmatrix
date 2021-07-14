<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocate', function (Blueprint $table) {

            $table->increments('recnum')->comment = "record number";
            $table->float('portal')->comment = "portal %";
            $table->float('gp')->comment = "guardian  %";
            $table->float('tech')->comment = "tech %";
            $table->float('referral')->comment = "referral %";
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
        Schema::drop('allocate');
    }
}
