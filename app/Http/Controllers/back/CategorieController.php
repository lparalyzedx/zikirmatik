<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieStoreRequest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use Inertia\Inertia;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::query()->when(
            request()->input('search'),
            function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
        )
            ->orderBy('id', 'DESC')->get();
        $categories = CategorieResource::collection($categories);
        return Inertia::render('Categories/Index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorieStoreRequest $request)
    {
        Categorie::query()->create([
            'name' => $request->name
        ]);

        return redirect()->route('kategoriler.index');
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
        $category = Categorie::query()->where('id', $id)->firstOrFail();
        $category = new CategorieResource($category);
        return Inertia::render('Categories/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategorieUpdateRequest $request, string $id)
    {
        Categorie::query()->where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('kategoriler.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::query()->where('id', $id)->first();
        $categorie->delete();

        return redirect()->route('kategoriler.index');
    }
}
