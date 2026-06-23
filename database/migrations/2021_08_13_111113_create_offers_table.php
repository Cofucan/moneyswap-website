<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code');
            $table->foreignId('swap_id')->constrained();
            $table->foreignId('wallet_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->float('rate', 8, 2);
            $table->integer('quantity');
            $table->datetime('feedback_at')->nullable();
            $table->datetime('feedback_user_id')->nullable()->constrained();
            $table->datetime('closed_at')->nullable();
            $table->char('status', 10);
            $table->boolean('published');
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
        Schema::dropIfExists('offers');
    }
}
