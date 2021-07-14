<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {

            $table->increments('trns_#')->comment = "Transaction record #";

            $table->integer('cid')->unsigned()->comment = "Links to cmpny -> cid";
            $table->foreign('cid')
                ->references('cid')
                ->on('cmpny')
                ->onDelete('cascade');

            $table->timestamp('date')->index('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('txn_type')->comment = "Transaction Type";
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
        Schema::drop('transaction');
    }
}
