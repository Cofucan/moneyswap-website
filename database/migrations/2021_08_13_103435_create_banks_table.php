<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name');
            $table->string('slug');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('trading_name')->nullable();
            $table->string('display_icon')->nullable();
            $table->boolean('published');
            $table->timestamps();
        });

        if (Schema::hasTable('countries')) {
            try {
                Schema::table('banks', function (Blueprint $table) {
                    $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
                });
            } catch (\Throwable $e) {
                // Ignore if FK cannot be created due to incompatible schema/engine.
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
