<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('items') && !Schema::hasTable('prices')) {
            Schema::rename('items', 'prices');
        }

        if (Schema::hasTable('prices') && !Schema::hasColumn('prices', 'feature_id')) {
            Schema::table('prices', function (Blueprint $table) {
                $table->unsignedBigInteger('feature_id')->nullable();
            });

            if (Schema::hasTable('features')) {
                try {
                    Schema::table('prices', function (Blueprint $table) {
                        $table->foreign('feature_id')->references('id')->on('features')->nullOnDelete();
                    });
                } catch (\Throwable $e) {
                    // Ignore if the FK can't be created due to incompatible schema/engine.
                }
            }
        } elseif (Schema::hasTable('items') && !Schema::hasColumn('items', 'feature_id')) {
            Schema::table('items', function (Blueprint $table) {
                $table->unsignedBigInteger('feature_id')->nullable();
            });

            if (Schema::hasTable('features')) {
                try {
                    Schema::table('items', function (Blueprint $table) {
                        $table->foreign('feature_id')->references('id')->on('features')->nullOnDelete();
                    });
                } catch (\Throwable $e) {
                    // Ignore if the FK can't be created due to incompatible schema/engine.
                }
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('prices') && Schema::hasColumn('prices', 'feature_id')) {
            Schema::table('prices', function (Blueprint $table) {
                try {
                    $table->dropForeign(['feature_id']);
                } catch (\Throwable $e) {
                    // Ignore if the constraint doesn't exist.
                }
                $table->dropColumn('feature_id');
            });
        } elseif (Schema::hasTable('items') && Schema::hasColumn('items', 'feature_id')) {
            Schema::table('items', function (Blueprint $table) {
                try {
                    $table->dropForeign(['feature_id']);
                } catch (\Throwable $e) {
                    // Ignore if the constraint doesn't exist.
                }
                $table->dropColumn('feature_id');
            });
        }

        if (Schema::hasTable('prices') && !Schema::hasTable('items')) {
            Schema::rename('prices', 'items');
        }
    }
};
