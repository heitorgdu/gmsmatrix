<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmpny', function (Blueprint $table) {

            $table->increments('cid')->comment = "Record id for company";
            $table->string('name')->comment = "Name of the business";
            $table->integer('contact')->comment = "The users.id of the company's primary contact";
            $table->char('type')->default('p')->comment = "a-admin; c-customer; p-prospect; s-sales; t-tech";

            $table->integer('tcid')->unsigned()->nullable()->default(120)->comment = "Links to tech.tcid to assign customers to tech";
            $table->foreign('tcid')
                ->references('tcid')
                ->on('tech')
                ->onDelete('cascade');

            $table->integer('tpid')->nullable()->default(120)->comment = "The users.id of the technician assigned to the company";
            $table->integer('rcid')->comment = "company.cid of referral company";
            $table->integer('number_of_computers')->comment = "# business computers";
            $table->float('cost')->comment = "Monthly cost of all subscriptions";
            $table->integer('mod_by')->comment = "Modified by pid";
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
        Schema::drop('cmpny');
    }
}
