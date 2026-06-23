<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdToHowItWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('how_it_works')) {
            Schema::create('how_it_works', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->string('slug')->nullable()->unique();
                $table->string('forwhom')->nullable();
                $table->text('overview')->nullable();
                $table->string('display_image')->nullable();
                $table->boolean('published')->default(true);
                $table->string('button_text')->nullable();
                $table->string('button_url')->nullable();
                $table->unsignedInteger('display_order')->default(1);
                $table->timestamps();
            });
        }

        Schema::table('how_it_works', function (Blueprint $table) {
            $table->unsignedBigInteger('how_it_work_group_id')->nullable()->after('id');
            $table->index('how_it_work_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('how_it_works', function (Blueprint $table) {
            $table->dropIndex(['how_it_work_group_id']);
            $table->dropColumn('how_it_work_group_id');
        });
    }
}
