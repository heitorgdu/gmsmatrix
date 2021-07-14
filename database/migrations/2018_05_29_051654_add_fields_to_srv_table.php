<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSrvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('srv', function (Blueprint $table) {
            $table->float('pay_p')->default(0.20);
            $table->float('pay_g')->default(0.35);
            $table->float('pay_t')->default(0.35);
            $table->float('pay_r')->default(0.10);
            $table->string('tax')->default('y');
            $table->float('setup_p')->nullable();
            $table->float('setup_t')->nullable();
            $table->float('setup_r')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('srv', function (Blueprint $table) {
            $table->float('pay_p');
            $table->float('pay_g');
            $table->float('pay_t');
            $table->float('pay_r');
            $table->string('tax');
            $table->float('setup_p');
            $table->float('setup_t');
            $table->float('setup_r');
            $table->string('note');
        });
    }
}
