<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiPrayResource;
use App\Http\Resources\CategorieResource;
use App\Http\Resources\ChantResource;
use App\Http\Resources\PrayResource;
use App\Http\Resources\SettingResource;
use App\Models\Categorie;
use App\Models\Chant;
use App\Models\Daily;
use App\Models\Pray;
use App\Models\Setting;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function categories()
    {
        $categories = Categorie::query()->with('pray')->whereHas('pray', function ($query) {
            $query->where('status', true);
        })->where('status', true)->get();
        $categories = CategorieResource::collection($categories);

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function prays()
    {
        $prays = Pray::query()->with('categorie')->whereHas('categorie', function ($query) {
            $query->where('status', true);
        })->where('status', true)->get();
        $prays = $prays;

        return response()->json([
            'prays' => $prays
        ], 200);
    }

    public function chants()
    {
        $chants = Chant::query()->where('status', true)->get();
        $chants = ChantResource::collection($chants);

        return  response()->json([
            'chants' => $chants
        ], 200);
    }

    public function setting()
    {
        $setting = Setting::query()->where('id',1)->first();
        $setting = new SettingResource($setting);

        return response()->json([
            'setting' => $setting
        ], 200);
    }

    public function daily()
    {
        $daily = Daily::query()->where('date', now()->format('Y-m-d'))->first();

        if ($daily) {
            $pray = Pray::query()->where('id', $daily->pray_id)->first();
            return response()->json([
                'pray' => $pray
            ]);
        }

        return response()->json([
             'pray' => []
        ]);
    }
}
