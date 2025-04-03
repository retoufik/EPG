<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStagiaires = Stagiaire::count();
        
        $activeStagiaires = Stagiaire::where('debut', '<=', now())
            ->where('fin', '>=', now())
            ->count();
        
        $completedStagiaires = Stagiaire::where('fin', '<', now())->count();
        
        $pendingStagiaires = Stagiaire::where('debut', '>', now())->count();

        $stagiaireProgress = Stagiaire::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = collect();
        $counts = [];
        for ($i = 30; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates->push($date);
            $counts[$date] = 0;
        }

        foreach ($stagiaireProgress as $progress) {
            $counts[$progress->date] = $progress->count;
        }

        $stagiaireProgressData = [
            'labels' => $dates->map(function($date) {
                return date('M d', strtotime($date));
            }),
            'data' => array_values($counts)
        ];

        $stagiaireDistribution = [
            Stagiaire::where('debut', '<=', now())->where('fin', '>=', now())->count(),
            Stagiaire::where('fin', '<', now())->count(),
            Stagiaire::where('debut', '>', now())->count()
        ];

        $recentStagiaires = Stagiaire::latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalStagiaires',
            'activeStagiaires',
            'completedStagiaires',
            'pendingStagiaires',
            'stagiaireProgressData',
            'stagiaireDistribution',
            'recentStagiaires'
        ));
    }
} 