<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация — Мой сайт</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* Из твоего welcome.blade.php — стили Tailwind */
        *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}
        html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}
        body{margin:0;line-height:inherit}
        .relative{position:relative}.flex{display:flex}.min-h-screen{min-height:100vh}
        .bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}
        .bg-center{background-position:center}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}
        .dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}
        .dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}
        .selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}
        .selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}
        .selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}
        .selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}
        .bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}
        .dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}
        .rounded-lg{border-radius:0.5rem}
        .shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);box-shadow:var(--tw-shadow)}
        .p-8{padding:2rem}.w-full{width:100%}.max-w-md{max-width:28rem}.mx-auto{margin-left:auto;margin-right:auto}
        .text-2xl{font-size:1.5rem;line-height:2rem}.font-bold{font-weight:700}.mb-6{margin-bottom:1.5rem}
        .text-center{text-align:center}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}
        .dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}
        .bg-red-50{background-color:#fef2f2}.border-red-400{border-color:#f87171}.text-red-700{color:#b91c1c}
        .block{display:block}.mb-2{margin-bottom:0.5rem}.text-sm{font-size:.875rem;line-height:1.25rem}
        .text-gray-600{color:#4b5563}
        .border{border-width:1px;border-color:#e5e7eb}
        .rounded{border-radius:0.25rem}
        .px-3{padding-left:0.75rem;padding-right:0.75rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}
        .focus\:rounded-sm:focus{border-radius:0.125rem}
        .focus\:outline:focus{outline-style:solid}
        .focus\:outline-2:focus{outline-width:2px}
        .focus\:outline-red-500:focus{outline-color:#ef4444}
        .mb-4{margin-bottom:1rem}.mb-6{margin-bottom:1.5rem}
        .w-full{width:100%}
        .bg-red-500{background-color:#ef4444}
        .text-white{color:#fff}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}
        .hover\:bg-red-600:hover{background-color:#dc2626}
        .transition{transition-property:all;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}
        .mt-4{margin-top:1rem}
        .underline{text-decoration:underline}
        .hover\:text-gray-900:hover{color:#111827}
        .dark\:text-gray-400{color:#9ca3af}
        .dark\:hover\:text-white:hover{color:#fff}
    </style>
</head>
<body class="antialiased">
    <div class="relative flex justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-2xl p-8 w-full max-w-md mx-auto">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-white">Регистрация</h1>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4 text-red-700">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm text-gray-600">Имя</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           class="w-full border rounded px-3 py-2 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500" />
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm text-gray-600">E-mail</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full border rounded px-3 py-2 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500" />
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm text-gray-600">Пароль</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full border rounded px-3 py-2 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500" />
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block mb-2 text-sm text-gray-600">Повторите пароль</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           required
                           class="w-full border rounded px-3 py-2 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500" />
                </div>
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 transition">Зарегистрироваться</button>
            </form>

            <div class="mt-4 text-center">
                Уже есть аккаунт?
                <a href="{{ route('login') }}" class="underline text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Войти</a>
            </div>
        </div>
    </div>
</body>
</html>
