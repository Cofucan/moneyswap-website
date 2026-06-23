<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndDataToContentSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_sections', function (Blueprint $table) {
            $table->string('type')->default('text')->after('section_key');
            $table->json('data')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_sections', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('data');
        });
    }
}
