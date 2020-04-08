<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('user_wallet_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txn_type')->nullable();
            $table->float('amount', 15, 2)->nullable();
            $table->string('txn_info')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

    }
}
