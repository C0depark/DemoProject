<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_activity', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('activity', 100)->nullable()->default(null);
            $table->string('type', 100)->nullable()->default(null);
            $table->integer('participants')->default(0);
            $table->double('price', 8, 2)->default(0);
            $table->string('link', 100)->default(null);
            $table->string('key', 100)->default(null);
            $table->float('accessibility', 3, 1)->default(0);
            $table->timestamp('create_date');

            $table->index(['key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};
