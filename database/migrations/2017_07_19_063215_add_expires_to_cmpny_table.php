<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpiresToCmpnyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cmpny', function (Blueprint $table) {
            $table->float('new_cost')->nullable()->comment = "Pending new cost of subscription";
            $table->date('expires')->index('date')->nullable()->comment = "Expiration Date";
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
            $table->float('new_cost');
            $table->date('expires');
        });
    }
}
