<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swaps', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code');
            $table->integer('order_no')->nullable();
            $table->foreignId('wallet_id')->constrained();
            $table->float('quantity');
            $table->float('outstanding')->nullable();
            $table->foreignId('currency_id')->constrained();
            $table->float('rate', 8, 2);
            $table->datetime('activated_at')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->char('status', 10);
            $table->boolean('published');
            //$table->foreignId('beneficiary_id')->nullable()->constrained();
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
        Schema::dropIfExists('swaps');
    }
}
