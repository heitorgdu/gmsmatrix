<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {

            $table->increments('lid');

            $table->integer('cid')->unsigned()->comment = "	Links to cmpny -> cid";
            $table->foreign('cid')
                ->references('cid')
                ->on('cmpny')
                ->onDelete('cascade');

            $table->string('name')->comment = "	Location nick name";
            $table->string('addr1');
            $table->string('addr2')->nullable();
            $table->string('city');
            $table->char('st', 5);
            $table->string('postal')->index('Postal Code Lookup');
            $table->string('cntry');
            $table->timestamp('mod_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = "Last modified date";

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
        Schema::drop('location');
    }
}
