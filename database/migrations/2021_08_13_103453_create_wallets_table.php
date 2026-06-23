<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
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
            $table->foreignId('profile_id')->constrained();
            $table->foreignId('bank_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('payment_gateway_id')->constrained()->nullable();
            $table->string('reference_token');
            $table->string('account_name')->nullable();
            $table->integer('account_number')->nullable();
            $table->double('balance', 8, 2);
            $table->double('blocked', 8, 2);
            $table->datetime('activated_at')->nullable();
            $table->boolean('published');
            $table->string('status',20);
            $table->boolean('main');
            $table->foreignId('user_id')->constrained();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
}
