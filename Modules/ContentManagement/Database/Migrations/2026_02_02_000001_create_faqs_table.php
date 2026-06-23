<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('faqs')) {
            return;
        }

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->unsignedBigInteger('faq_category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();

            $table->index('faq_category_id');
            $table->index('user_id');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->foreign('faq_category_id')
                ->references('id')
                ->on('faq_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
