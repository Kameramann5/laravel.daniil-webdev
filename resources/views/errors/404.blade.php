<!DOCTYPE html>
<html>
<head>
    <title>404 Страница не найдена</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 50px;
            color: #718096;
        }
        .message {
            font-size: 20px;
            margin: 20px 0;
        }
        .link {
            color: #4299e1;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <div class="message">Страница не найдена</div>
    <a href="{{ url('/') }}" class="link">Вернуться на главную</a>
</body>
</html>