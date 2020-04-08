<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentPaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('agent_payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txn_type')->nullable();
            $table->float('any_fees', 15, 2)->nullable();
            $table->float('any_charges', 15, 2)->nullable();
            $table->float('final_amount', 15, 2)->nullable();
            $table->string('txn_for')->nullable();
            $table->string('txn_info')->nullable();
            $table->string('status')->nullable();
            $table->string('proccesed_by')->nullable();
            $table->timestamps();
        });

    }
}
