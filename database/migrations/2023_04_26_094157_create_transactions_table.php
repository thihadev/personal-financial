<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('wallet_id')->index();
            $table->unsignedInteger('transfer_wallet_id')->index()->nullable();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->string('user')->index()->nullable();
            $table->unsignedInteger('category_id')->index()->nullable();
            $table->unsignedInteger('sub_category_id')->index()->nullable();
            $table->unsignedInteger('type')->index()->nullable();
            $table->bigInteger('amount')->index();
            $table->bigInteger('transaction_amount')->index();
            $table->bigInteger('payback_amount')->nullable()->default(0)->index();
            $table->integer('fees')->index()->default(0);
            $table->date('date')->index();
            $table->bigInteger('last_balance')->index();
            $table->longText('description')->nullable();
            $table->boolean('status')->index()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
