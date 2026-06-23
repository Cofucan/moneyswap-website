<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('items') && !Schema::hasTable('prices')) {
            Schema::rename('items', 'prices');
            return;
        }

        if (!Schema::hasTable('items') || !Schema::hasTable('prices')) {
            return;
        }

        $itemColumns = Schema::getColumnListing('items');
        $priceColumns = Schema::getColumnListing('prices');
        $columns = array_values(array_intersect($itemColumns, $priceColumns));

        if (!empty($columns)) {
            DB::table('items')->orderBy('id')->chunk(500, function ($rows) use ($columns) {
                $payload = [];
                foreach ($rows as $row) {
                    $record = [];
                    foreach ($columns as $column) {
                        $record[$column] = $row->{$column};
                    }
                    $payload[] = $record;
                }
                if (!empty($payload)) {
                    DB::table('prices')->insertOrIgnore($payload);
                }
            });
        }

        Schema::drop('items');
    }

    public function down(): void
    {
        if (Schema::hasTable('prices') && !Schema::hasTable('items')) {
            Schema::rename('prices', 'items');
        }
    }
};
