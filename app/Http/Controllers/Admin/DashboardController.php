<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Статистика пользователей
        $userStats = [
            'total' => User::count(),
            'admins' => User::admins()->count(),
            'active' => User::active()->count(),
            'new' => User::new()->count(),
        ];

        // Последние пользователи
        $recentUsers = User::with(['logins' => function ($query) {
                $query->latest()->take(1);
            }])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                $lastLogin = $user->logins->first();
                $user->formatted_last_login = $lastLogin 
                    ? $lastLogin->created_at->format('d.m.Y H:i')
                    : 'Никогда';
                return $user;
            });

        // Статистика регистраций
        $registrationStats = $this->getRegistrationStats(7);
        
        // Статистика активности
        $activityStats = $this->getActivityStats(7);
        
        // Статистика по ролям
        $roleStats = User::select('role', DB::raw('COUNT(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

        return view('admin.dashboard', [
            'title' => 'Админ-панель',
            'user' => auth()->user(),
            'userStats' => $userStats,
            'recentUsers' => $recentUsers,
            'registrationStats' => $registrationStats,
            'activityStats' => $activityStats,
            'roleStats' => $roleStats
        ]);
    }

    /**
     * Статистика регистраций по дням
     */
    protected function getRegistrationStats(int $days = 7): array
    {
        $startDate = now()->subDays($days - 1)->startOfDay();
        $endDate = now()->endOfDay();

        $stats = User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return $this->fillMissingDates($stats, $days);
    }

    /**
     * Статистика активности по дням
     */
    protected function getActivityStats(int $days = 7): array
    {
        $startDate = now()->subDays($days - 1)->startOfDay();
        $endDate = now()->endOfDay();

        $stats = User::select(
                DB::raw('DATE(last_login_at) as date'),
                DB::raw('COUNT(DISTINCT id) as count')
            )
            ->whereBetween('last_login_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return $this->fillMissingDates($stats, $days);
    }

    /**
     * Заполнение пропущенных дат
     */
    protected function fillMissingDates(array $stats, int $days): array
    {
        $result = [];
        $currentDate = now()->subDays($days - 1)->startOfDay();

        for ($i = 0; $i < $days; $i++) {
            $date = $currentDate->format('Y-m-d');
            $result[$date] = $stats[$date] ?? 0;
            $currentDate->addDay();
        }

        return $result;
    }
}