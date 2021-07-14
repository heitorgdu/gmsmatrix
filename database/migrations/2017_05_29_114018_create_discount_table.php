<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->increments('id')->comment = "Record #";
            $table->string('code')->index('code')->comment = "Discount code";
            $table->string('service')->comment = "Valid for service";
            $table->float('amount')->comment = "Amount";
            $table->integer('nbr_available')->comment = "# available, 0=unlimited";
            $table->date('expires')->comment = "Expires";
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
        Schema::drop('discount');
    }
}
