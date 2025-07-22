<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступ запрещен (403)</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #fef2f2 0%, #ffebeb 100%);
            color: #334155;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 50px 40px;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }
        
        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: #ef4444;
            line-height: 1;
            margin-bottom: 10px;
            text-shadow: 3px 3px 0 rgba(239, 68, 68, 0.1);
        }
        
        .error-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1e293b;
        }
        
        .error-message {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #64748b;
        }
        
        .error-details {
            background: #fef2f2;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: left;
            border-left: 4px solid #ef4444;
        }
        
        .error-details p {
            margin-bottom: 8px;
            display: flex;
        }
        
        .error-details strong {
            min-width: 120px;
            display: inline-block;
            color: #b91c1c;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 16px;
        }
        
        .btn-primary {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }
        
        .btn-primary:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
        }
        
        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #e2e8f0;
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }
        
        .btn-icon {
            margin-right: 8px;
        }
        
        .contact {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            color: #64748b;
        }
        
        .contact a {
            color: #0ea5e9;
            text-decoration: none;
        }
        
        .contact a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            .container {
                padding: 30px 20px;
            }
            
            .error-code {
                font-size: 80px;
            }
            
            .error-title {
                font-size: 24px;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .error-details strong {
                min-width: 90px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">403</div>
        <h1 class="error-title">Доступ запрещен</h1>
        
        <p class="error-message">
            У вас недостаточно прав для доступа к этой странице. Если вы считаете, что это ошибка, свяжитесь с администратором.
        </p>
        
        <div class="error-details">
            <p><strong>Ваш логин:</strong> {{ Auth::check() ? Auth::user()->email : 'Гость' }}</p>
            <p><strong>Ваша роль:</strong> {{ Auth::check() ? Auth::user()->role : 'Не авторизован' }}</p>
            <p><strong>Запрошенный URL:</strong> {{ request()->fullUrl() }}</p>
        </div>
        
        <div class="actions">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                </svg>
                На главную
            </a>
            
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Вернуться назад
            </a>
        </div>
        
        <div class="contact">
            <p>Нужна помощь? <a href="mailto:admin@example.com">Свяжитесь с нами</a></p>
        </div>
    </div>
</body>
</html>