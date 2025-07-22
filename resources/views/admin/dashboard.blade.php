<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Админ-панель' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
            padding-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .admin-content {
            padding: 20px;
            background-color: #f1f5f9;
            min-height: 100vh;
        }
        .sidebar-link {
            color: #adb5bd;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
            border-radius: 4px;
            margin: 5px 10px;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: #fff;
            background-color: #495057;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border: none;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            font-weight: 600;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
        }
        .stat-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        .stat-card-primary { border-left-color: #4e73df; }
        .stat-card-success { border-left-color: #1cc88a; }
        .stat-card-info { border-left-color: #36b9cc; }
        .stat-card-warning { border-left-color: #f6c23e; }
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .stat-title {
            font-size: 0.9rem;
            color: #5a5c69;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .chart-area {
            position: relative;
            height: 300px;
        }
        .chart-pie {
            position: relative;
            height: 250px;
        }
        .list-group-item {
            border: none;
            border-left: 3px solid #4e73df;
            margin-bottom: 5px;
            border-radius: 4px;
        }
        .user-badge-admin { background-color: #1cc88a; }
        .user-badge-user { background-color: #4e73df; }
        .table thead th {
            font-weight: 600;
            color: #6e707e;
        }
        .alert-position {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 350px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Позиция для алертов -->
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show alert-position" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="row">
            <!-- Сайдбар -->
            <div class="col-md-2 admin-sidebar">
                <h4 class="px-3 mb-4">Админ-панель</h4>
                <ul class="nav flex-column">
                    <li>
                        <a href="{{ admin_route('admin.dashboard') }}" class="sidebar-link active">
                            <i class="bi bi-speedometer2 me-2"></i> Главная
                        </a>
                    </li>
                    <li>
                        <a href="{{ admin_route('admin.users.index') }}" class="sidebar-link">
                            <i class="bi bi-people me-2"></i> Пользователи
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-file-earmark-text me-2"></i> Контент
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-gear me-2"></i> Настройки
                        </a>
                    </li>
                    <li class="mt-4">
                        <a href="{{ url('/') }}" class="sidebar-link" target="_blank">
                            <i class="bi bi-box-arrow-up-right me-2"></i> Перейти на сайт
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Основной контент -->
            <div class="col-md-10 admin-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">{{ $title ?? 'Админ-панель' }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="me-3"><i class="bi bi-person-circle me-1"></i> {{ $user->name ?? 'Администратор' }}</span>
                        <a href="{{ admin_route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Выйти
                        </a>
                        <form id="logout-form" action="{{ admin_route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                
                <!-- Статистика в карточках -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-primary h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="stat-number">{{ $userStats['total'] ?? 0 }}</div>
                                        <div class="stat-title">Всего пользователей</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people fs-1 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-success h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="stat-number">{{ $userStats['admins'] ?? 0 }}</div>
                                        <div class="stat-title">Администраторов</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-shield-lock fs-1 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-info h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="stat-number">{{ $userStats['active'] ?? 0 }}</div>
                                        <div class="stat-title">Активных (7 дн.)</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-activity fs-1 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-warning h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="stat-number">{{ $userStats['new'] ?? 0 }}</div>
                                        <div class="stat-title">Новых (30 дн.)</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-plus fs-1 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Графики и таблицы -->
                <div class="row">
                    <!-- График регистраций -->
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Регистрации за последние 7 дней</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="registrationsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- График активности -->
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Активность пользователей за последние 7 дней</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="activityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Распределение по ролям -->
                    <div class="col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Распределение по ролям</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="roleChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    @php
                                        // Безопасное преобразование данных
                                        $roleStatsArray = is_array($roleStats ?? []) ? $roleStats : [];
                                    @endphp
                                    @foreach($roleStatsArray as $role => $count)
                                    <span class="mr-3">
                                        <i class="bi bi-circle-fill text-{{ $role === 'admin' ? 'success' : 'primary' }} me-1"></i> 
                                        {{ ucfirst($role) }} ({{ $count }})
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Последние пользователи -->
                    <div class="col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Последние пользователи</h6>
                                <a href="{{ admin_route('admin.users.index') }}" class="btn btn-sm btn-primary">Все пользователи</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Имя</th>
                                                <th>Email</th>
                                                <th>Роль</th>
                                                <th>Последний вход</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // Безопасная обработка данных
                                                $recentUsers = $recentUsers ?? collect([]);
                                            @endphp
                                            @foreach($recentUsers as $recentUser)
                                            <tr>
                                                <td>{{ $recentUser->id ?? 'N/A' }}</td>
                                                <td>{{ $recentUser->name ?? 'N/A' }}</td>
                                                <td>{{ $recentUser->email ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge rounded-pill user-badge-{{ $recentUser->role ?? 'user' }}">
                                                        {{ $recentUser->role ?? 'user' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($recentUser->last_login_at ?? false)
                                                        {{ $recentUser->last_login_at->diffForHumans() }}
                                                    @else
                                                        Никогда
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Последние действия -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Последние действия в системе</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-person-check me-2 text-success"></i> 
                                Пользователь <strong>{{ auth()->user()->name ?? 'Система' }}</strong> вошел в систему
                                <span class="float-end text-muted small">{{ now()->format('d.m.Y H:i') }}</span>
                            </li>
                            @foreach($recentUsers as $recentUser)
                            <li class="list-group-item">
                                <i class="bi bi-person-plus me-2 text-primary"></i> 
                                Пользователь <strong>{{ $recentUser->name ?? 'Новый пользователь' }}</strong> зарегистрирован
                                <span class="float-end text-muted small">
                                    {{ ($recentUser->created_at ?? now())->format('d.m.Y H:i') }}
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Простой скрипт для выделения активной ссылки
            const currentPath = window.location.pathname;
            const links = document.querySelectorAll('.sidebar-link');
            
            links.forEach(link => {
                if (link.href.includes(currentPath)) {
                    link.classList.add('active');
                }
            });
            
            // Проверка наличия данных для графиков
            function ensureArray(data) {
                if (Array.isArray(data)) return data;
                if (typeof data === 'object' && data !== null) return Object.entries(data);
                return [];
            }

            // Подготовка данных для графиков
            const registrationData = ensureArray(@json($registrationStats ?? []));
            const activityData = ensureArray(@json($activityStats ?? []));
            const roleData = ensureArray(@json($roleStats ?? []));

            // График регистраций
            if (document.getElementById('registrationsChart')) {
                const regCtx = document.getElementById('registrationsChart').getContext('2d');
                const regChart = new Chart(regCtx, {
                    type: 'line',
                    data: {
                        labels: registrationData.map(item => item[0]),
                        datasets: [{
                            label: 'Регистраций',
                            data: registrationData.map(item => item[1]),
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 2,
                            pointRadius: 4,
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 6,
                            tension: 0.3
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                },
                                grid: {
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgb(255,255,255)',
                                bodyFont: {
                                    size: 14
                                },
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                displayColors: false,
                                titleMarginBottom: 10,
                                titleFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' регистраций';
                                    }
                                }
                            }
                        }
                    }
                });
            }
            
            // График активности
            if (document.getElementById('activityChart')) {
                const actCtx = document.getElementById('activityChart').getContext('2d');
                const actChart = new Chart(actCtx, {
                    type: 'bar',
                    data: {
                        labels: activityData.map(item => item[0]),
                        datasets: [{
                            label: 'Активные пользователи',
                            data: activityData.map(item => item[1]),
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                },
                                grid: {
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
            
            // График распределения ролей
            if (document.getElementById('roleChart')) {
                const roleCtx = document.getElementById('roleChart').getContext('2d');
                const roleChart = new Chart(roleCtx, {
                    type: 'doughnut',
                    data: {
                        labels: roleData.map(item => item[0]),
                        datasets: [{
                            data: roleData.map(item => item[1]),
                            backgroundColor: [
                                'rgba(28, 200, 138, 0.8)', // admin
                                'rgba(78, 115, 223, 0.8)'   // user
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>