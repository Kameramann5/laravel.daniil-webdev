<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('logins', function (Blueprint $table) {
            // Проверяем, есть ли колонка updated_at
            if (!Schema::hasColumn('logins', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
            
            // Меняем created_at чтобы имел значение по умолчанию
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->change();
        });
    }

    public function down()
    {
        Schema::table('logins', function (Blueprint $table) {
            // Откат изменений
        });
    }
};