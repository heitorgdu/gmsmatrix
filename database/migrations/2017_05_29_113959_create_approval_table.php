<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval', function (Blueprint $table) {
            $table->increments('apprvl_id')->comment = "Approval record id";

            $table->integer('cid')->unsigned()->comment = "Client's cid";
            $table->foreign('cid')
                ->references('cid')
                ->on('cmpny')
                ->onDelete('cascade');

            $table->string('preapprovalKey');
            $table->text('ack')->comment = "Acknowledgment code";
            $table->string('build')->comment = "PayPal's build number";
            $table->string('correlationId')->comment = "Correlation identifier";
            $table->string('error')->comment = "Error info";
            $table->string('category')->comment = "Sys / App / Req";
            $table->string('domain')->comment = "Domain";
            $table->integer('errorId')->comment = "Unique error id";
            $table->string('message')->comment = "Description of error";
            $table->string('parameter')->comment = "Error parameter";
            $table->string('severity')->comment = "Error severity";
            $table->dateTime('timestamp')->comment = "PayPal's timestamp";
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
        Schema::drop('approval');
    }
}
