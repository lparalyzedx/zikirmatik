<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Categorie;
use App\Models\Chant;
use App\Models\Daily;
use App\Models\People;
use App\Models\Pray;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function dashboard()
    {
        $data = [
            'categorie' => Categorie::where('status', true)->count(),
            'pray' => Pray::with('categorie')
                ->whereHas('categorie', function ($query) {
                    $query->where('status', true);
                })
                ->where('status', true)
                ->count(),
            'chant' => Chant::where('status', true)->count(),
            'daily' => Daily::with('pray')
                ->when(request()->input('search'), function ($query, $search) {
                    $query->where('date', 'like', '%' . $search . '%');
                })
                ->whereHas('pray', function ($query) {
                    $query->where('status', true)
                        ->whereHas('categorie', function ($query) {
                            $query->where('status', true);
                        });
                })
                ->orderBy('id', 'DESC')
                ->count(),
            'user' => People::all()->count()
        ];

        return Inertia::render('Dashboard', compact('data'));
    }
}
