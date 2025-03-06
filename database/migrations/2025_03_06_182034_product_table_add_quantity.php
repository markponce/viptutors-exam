<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $tableName = 'products';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn($this->tableName, 'quantity')) {
            Schema::table($this->tableName, function (Blueprint $table) {
                $table->integer('quantity')->default(0)->after('body');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn($this->tableName, 'quantity')) {
            Schema::dropColumns($this->tableName, 'quantity');
        }
    }
};
