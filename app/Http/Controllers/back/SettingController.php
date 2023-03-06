<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $setting =  Setting::query()->where('id',1)->first();
       return Inertia::render('Settings/Index',compact('setting'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingUpdateRequest $request, string $id)
    {
        $ramadan = false;
        $care = false;
        if($request->care)
        {
            $care = true;
            $ramadan = false;
        }

        if($request->ramadan)
        {
            $care = false;
            $ramadan = true;
        }

        Setting::query()->where('id',$id)->update([
            'version' => $request->version,
            'ramadan' => $ramadan,
            'care' => $care
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
