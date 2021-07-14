<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub', function (Blueprint $table) {

            $table->increments('sid')->comment = "Subscription ID";

            $table->integer('srv_id')->unsigned()->comment = "Service ID";
            $table->foreign('srv_id')
                ->references('srv_id')
                ->on('srv')
                ->onDelete('cascade');

            $table->string('guid')->index('GUID')->nullable()->comment = "Unique Computer ID";
            $table->string('device')->comment = "Device name";

            $table->integer('lid')->unsigned()->nullable()->comment = "Links to location -> lid";
            $table->foreign('lid')
                ->references('lid')
                ->on('location')
                ->onDelete('cascade');

            $table->integer('cid')->unsigned()->comment = "Company ID";
            $table->foreign('cid')
                ->references('cid')
                ->on('cmpny')
                ->onDelete('cascade');

            $table->integer('mod_by')->unsigned()->nullable()->comment = "Modified by user id";
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
        Schema::drop('sub');
    }
}
