<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropForeign(['funcionario_id']);
        });

        DB::statement('ALTER TABLE `vendas` MODIFY `funcionario_id` BIGINT UNSIGNED NULL');

        Schema::table('vendas', function (Blueprint $table) {
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropForeign(['funcionario_id']);
        });

        DB::statement('ALTER TABLE `vendas` MODIFY `funcionario_id` BIGINT UNSIGNED NOT NULL');

        Schema::table('vendas', function (Blueprint $table) {
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }
};
