<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Добавляем импорт модели User

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Получаем аутентифицированного пользователя
            $user = Auth::user();

            // Обновляем время последнего входа
            try {
                $user->updateLastLogin($request->ip());
            } catch (\Exception $e) {
                \Log::error('Failed to update last login', [
                    'user_id' => $user->id,
                    'error'   => $e->getMessage()
                ]);
            }

            $request->session()->regenerate();

            // После входа отправляем на главную страницу (layout, welcome)
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
