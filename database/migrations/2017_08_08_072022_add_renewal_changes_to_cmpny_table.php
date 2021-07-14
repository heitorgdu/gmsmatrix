<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRenewalChangesToCmpnyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cmpny', function (Blueprint $table) {
            $table->integer('renewal_diff')->nullable();
            $table->date('new_expiry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cmpny', function (Blueprint $table) {
            $table->integer('renewal_diff');
            $table->date('new_expiry');
        });
    }
}
