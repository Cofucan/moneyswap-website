<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('prices')) {
            return;
        }

        Schema::table('prices', function (Blueprint $table) {
            if (!Schema::hasColumn('prices', 'cost_price')) {
                $table->decimal('cost_price', 15, 2)->nullable()->after('overview');
            }
            if (!Schema::hasColumn('prices', 'uom')) {
                $table->string('uom', 50)->nullable()->after('cost_price');
            }
        });

        if (Schema::hasColumn('prices', 'cost') && Schema::hasColumn('prices', 'cost_price')) {
            DB::table('prices')
                ->whereNull('cost_price')
                ->whereNotNull('cost')
                ->update(['cost_price' => DB::raw('cost')]);
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('prices')) {
            return;
        }

        Schema::table('prices', function (Blueprint $table) {
            if (Schema::hasColumn('prices', 'uom')) {
                $table->dropColumn('uom');
            }
            if (Schema::hasColumn('prices', 'cost_price')) {
                $table->dropColumn('cost_price');
            }
        });
    }
};
