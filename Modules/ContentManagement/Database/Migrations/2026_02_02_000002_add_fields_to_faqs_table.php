<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('faqs')) {
            return;
        }

        $addCategory = !Schema::hasColumn('faqs', 'faq_category_id');
        $addUser = !Schema::hasColumn('faqs', 'user_id');
        $addSlug = !Schema::hasColumn('faqs', 'slug');

        if ($addCategory || $addUser || $addSlug) {
            Schema::table('faqs', function (Blueprint $table) use ($addCategory, $addUser, $addSlug) {
                if ($addCategory) {
                    $table->unsignedBigInteger('faq_category_id')->nullable()->after('answer');
                }
                if ($addUser) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('faq_category_id');
                }
                if ($addSlug) {
                    $table->string('slug')->nullable()->after('user_id');
                }
            });
        }

        if (Schema::hasTable('faq_categories')) {
            $categoryId = DB::table('faq_categories')->orderBy('id')->value('id');
            if (!$categoryId) {
                $categoryId = DB::table('faq_categories')->insertGetId([
                    'label' => 'General',
                    'overview' => 'Default FAQ category',
                    'slug' => 'general',
                    'published' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('faqs')
                ->whereNull('faq_category_id')
                ->update(['faq_category_id' => $categoryId]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('faqs')) {
            return;
        }

        Schema::table('faqs', function (Blueprint $table) {
            if (Schema::hasColumn('faqs', 'faq_category_id')) {
                $table->dropColumn('faq_category_id');
            }
            if (Schema::hasColumn('faqs', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('faqs', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
}
