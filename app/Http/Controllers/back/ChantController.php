<?php

namespace App\Http\Controllers\back;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChantStoreRequest;
use App\Http\Requests\ChantUpdateRequest;
use App\Http\Resources\ChantResource;
use App\Models\Chant;

class ChantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chants = Chant::query()->when(
            request()->input('search'),
            function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
        )->orderBy('id', 'DESC')->get();
        $chants = ChantResource::collection($chants);
        return Inertia::render('Chants/Index', compact('chants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Chants/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChantStoreRequest $request)
    {
        Chant::query()->create([
            'name' => $request->name
        ]);

        return redirect()->route('zikirler.index');
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
        $chant = Chant::query()->where('id', $id)->first();
        $chant = new ChantResource($chant);

        return Inertia::render('Chants/Edit', compact('chant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChantUpdateRequest $request, string $id)
    {
        Chant::query()->where('id',$id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('zikirler.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Chant::query()->where('id', $id)->first();
        $categorie->delete();

        return redirect()->route('zikirler.index');
    }
}
