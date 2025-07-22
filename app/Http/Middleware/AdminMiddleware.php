<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Проверка авторизации
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Требуется авторизация');
        }

        $user = Auth::user();
        
        // Проверка прав администратора
        if ($user->isAdmin()) {
            try {
                // Обновляем время последнего входа и создаем запись в истории
                $user->updateLastLogin($request->ip());
            } catch (\Exception $e) {
                // Логируем ошибку, но не прерываем доступ
                Log::error('Failed to update last login', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }
            
            return $next($request);
        }

        // Для обычных пользователей - редирект на главную страцию сайта
        return redirect('/')->with('warning', 'У вас нет доступа к админ-панели');
    }
}