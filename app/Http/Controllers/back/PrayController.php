<?php

namespace App\Http\Controllers\back;

use App\Models\Pray;
use Inertia\Inertia;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrayStoreRequest;
use App\Http\Requests\PrayUpdateRequest;
use App\Http\Resources\PrayResource;
use App\Http\Resources\CategorieResource;

class PrayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prays = Pray::query()->with('categorie')->when(
            request()->input('search'),
            function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            }
        )->whereHas('categorie', function ($query) {
            $query->where('status', true);
        })->orderBy('id', 'DESC')->get();
        $prays = PrayResource::collection($prays);
        return Inertia::render('Prays/Index', compact('prays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::query()->where('status', true)->orderBy('id', 'DESC')->get();
        $categories = CategorieResource::collection($categories);
        return Inertia::render('Prays/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrayStoreRequest $request)
    {
        Pray::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id
        ]);

        return redirect()->route('dualar.index');
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
        $pray = Pray::query()->with('categorie')->where('id', $id)->firstOrFail();
        $categories = Categorie::query()->where('status', true)->OrderBy('id', 'DESC')->get();
        $categories = CategorieResource::collection($categories);
        $pray = new PrayResource($pray);
        return Inertia::render('Prays/Edit', compact('pray', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrayUpdateRequest $request, string $id)
    {
        Pray::query()->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('dualar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pray = Pray::query()->where('id', $id)->first();
        $pray->delete();

        return redirect()->route('dualar.index');
    }
}
