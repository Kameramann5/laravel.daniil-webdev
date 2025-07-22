<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* Стили Tailwind из welcome.blade.php */
        *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}
        html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree,sans-serif;font-feature-settings:normal}
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
        .p-8{padding:2rem}.w-full{width:100%}.max-w-xl{max-width:36rem}.mx-auto{margin-left:auto;margin-right:auto}
        .text-2xl{font-size:1.5rem;line-height:2rem}.font-bold{font-weight:700}.mb-6{margin-bottom:1.5rem}
        .text-center{text-align:center}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}
        .dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}
        .mt-4{margin-top:1rem}.mt-8{margin-top:2rem}.mb-4{margin-bottom:1rem}
        .text-lg{font-size:1.125rem;line-height:1.75rem}
        .text-gray-600{color:#4b5563}.text-gray-700{color:#374151}
        .text-green-700{color:#15803d}.text-red-500{color:#ef4444}
        .underline{text-decoration:underline}
        .hover\:text-gray-900:hover{color:#111827}
        .bg-red-500{background-color:#ef4444}
        .hover\:bg-red-600:hover{background-color:#dc2626}
        .rounded{border-radius:0.25rem}
        .text-white{color:#fff}
        .py-2{padding-top:0.5rem;padding-bottom:0.5rem}.px-4{padding-left:1rem;padding-right:1rem}
        .border-2{border-width:2px}
        .border-red-400{border-color:#f87171}
        .transition{transition-property:all;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}
        .inline-block{display:inline-block}
    </style>
</head>
<body class="antialiased">
    <div class="relative min-h-screen flex justify-center items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-2xl p-8 w-full max-w-xl mx-auto">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-white">
                Добро пожаловать, {{ auth()->user()->name }}!
            </h1>

            <div class="mb-4 text-center">
                <span class="text-lg text-gray-700">
                    Ваш e-mail: <strong>{{ auth()->user()->email }}</strong>
                </span>
            </div>

            @if(auth()->user()->is_admin)
                <div class="mb-4 text-center">
                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded">Роль: Администратор</span>
                </div>
                <div class="mb-4 text-center">
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition border-2 border-red-400 font-semibold">
                        Перейти в админ-панель
                    </a>
                </div>
            @else
                <div class="mb-4 text-center">
                    <span class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded">Роль: Пользователь</span>
                </div>
            @endif

            <div class="mt-8 text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition font-semibold">
                        Выйти
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
