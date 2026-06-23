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
