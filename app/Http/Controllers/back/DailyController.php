<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\DailyStoreRequest;
use App\Http\Requests\DailyUpdateRequest;
use App\Http\Resources\DailyResource;
use App\Http\Resources\PrayResource;
use App\Models\Daily;
use App\Models\Pray;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DailyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailies = Daily::query()->with('pray')->when(
            request()->input('search'),
            function ($query, $search) {
                $query->where('date', 'like', '%' . $search . '%');
            }
        )->whereHas('pray', function ($query) {
            $query->where('status', true)->whereHas('categorie', function ($query) {
                $query->where('status', true);
            });
        })->orderBy('id', 'DESC')->get();
        $dailies = DailyResource::collection($dailies);
        return Inertia::render('Dailies/Index', compact('dailies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prays = Pray::query()->with('categorie')->whereHas('categorie', function ($query) {
            $query->where('status', true);
        })->where('status', true)->get();
        $prays = PrayResource::collection($prays);
        return Inertia::render('Dailies/Create', compact('prays'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DailyStoreRequest $request)
    {
        Daily::query()->create([
            'pray_id' => $request->pray_id,
            'date'   => $request->date
        ]);

        return redirect()->route('gunluk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daily = Daily::query()->where('id', $id)->first();
        $daily = new DailyResource($daily);
        $prays = Pray::query()->with('categorie')->whereHas('categorie', function ($query) {
            $query->where('status', true);
        })->where('status', true)->get();
        $prays = PrayResource::collection($prays);
        return Inertia::render('Dailies/Edit', compact('daily', 'prays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DailyUpdateRequest $request, string $id)
    {
        Daily::query()->where('id', $id)->update([
            'pray_id' => $request->pray_id,
            'date' => $request->date,
            'status' => $request->status
        ]);

        return redirect()->route('gunluk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daily = Daily::query()->where('id', $id)->first();
        $daily->delete();
        return redirect()->route('gunluk.index');
    }
}
