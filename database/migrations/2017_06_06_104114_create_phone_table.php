<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone', function (Blueprint $table) {

            $table->string('nbr')->comment = "Phone number";
            $table->string('type')->default('primary')->comment = "Type: primary, home, work etc";

            $table->integer('pid')->unsigned()->comment = "Links to people -> pid";
            $table->primary(['nbr', 'pid']);
            $table->foreign('pid')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table->timestamp('mod_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = "Date last modified";

            $table->integer('mod_by')->unsigned()->nullable()->comment = "Modified by pid";
            $table->foreign('mod_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::drop('phone');
    }
}
