<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            
            // Улучшения:
            $table->string('email', 191)->unique(); // Явно указываем длину 191 для совместимости
            $table->enum('type', ['primary', 'secondary', 'other'])->default('primary'); // Тип email
            $table->boolean('is_verified')->default(false); // Подтвержден ли email
            $table->timestamp('verified_at')->nullable(); // Когда подтвержден
            
            // Внешний ключ для связи с пользователями
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes(); // Мягкое удаление
        });

        // Оптимизация для длинных индексов (если используете MySQL < 5.7.7)
        Schema::table('emails', function (Blueprint $table) {
            $table->index('email', 'emails_email_index');
        });
    }

    public function down()
    {
        // Удаление внешнего ключа перед удалением таблицы
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('emails');
    }
}