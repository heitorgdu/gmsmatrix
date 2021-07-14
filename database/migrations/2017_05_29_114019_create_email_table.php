<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email', function (Blueprint $table) {

            $table->string('e_addr')->primary()->comment = "email address";

            $table->integer('pid')->unsigned();
            $table->foreign('pid')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('type')->default('primary')->comment = "primary, home, work, other, alert, paypal";
            $table->integer('mod_by')->comment = "Date modified";
            $table->timestamp('mod_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = "Modified by pid";
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
        Schema::drop('email');
    }
}
