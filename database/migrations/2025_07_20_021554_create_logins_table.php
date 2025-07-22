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
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            
            // Внешний ключ для связи с пользователями
            $table->foreignId('user_id')
                ->constrained() // автоматическая связь с таблицей users
                ->onDelete('cascade'); // удаление записей при удалении пользователя
            
            // IP-адрес входа (поддерживает IPv6)
            $table->string('ip_address', 45)->nullable();
            
            // Временная метка создания (без updated_at)
            $table->timestamp('created_at');
            
            // Индексы для оптимизации запросов
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
};