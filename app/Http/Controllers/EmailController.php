<?php

namespace App\Http\Controllers;

use App\Models\Email; // Импортируем модель
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function showForm()
    {
        return view('email-form');
    }

    public function submitForm(Request $request)
    {
        // Валидация данных
        $request->validate([
            'email' => 'required|email|unique:emails,email',
        ]);

        // Сохранение электронной почты в базе данных
        Email::create(['email' => $request->email]);

        return back()->with('success', 'Email успешно сохранен!');
    }
}
