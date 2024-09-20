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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable()->index();
            // $table->unsignedInteger('bank_id')->nullable()->index();
            $table->string('wallet_name')->index();
            $table->bigInteger('initial_amount')->index();
            $table->bigInteger('balance')->default(0)->index();
            $table->text('note')->nullable();
            $table->boolean('active')->index()->default(0);
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
        Schema::dropIfExists('wallets');
    }
};
