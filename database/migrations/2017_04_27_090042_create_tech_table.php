<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech', function (Blueprint $table) {

            $table->increments('tcid')->comment = "	Tech company record id";
            $table->string('logo')->comment = "Logo image or url";
            $table->string('url')->nullable()->comment = "Website";
            $table->string('since')->nullable()->comment = "Started Business Year";
            $table->char('store')->nullable()->comment = "Repair Center";
            $table->char('remote')->nullable()->comment = "Remote assistance";
            $table->char('on_site')->nullable()->comment = "On Site Service";
            $table->string('usp')->nullable()->comment = "Unique selling proposition (240 max char)";
            $table->longText('description')->nullable()->comment = "Detailed business info";
            $table->string('tax_id')->nullable()->comment = "Sales tax id";
            $table->string('tax_id_image')->nullable()->comment = "Image of sales tax permit";
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
        Schema::drop('tech');
    }
}
