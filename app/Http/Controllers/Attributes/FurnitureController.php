<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use App\Models\Furniture;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Furniture::class);
        return view('app.attributes.furniture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Furniture::class);
        $primaryFurnitures = Furniture::where('is_primary', true)->get();
        return view('app.attributes.furniture.create', compact('primaryFurnitures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Furniture::class);
        $validated = $request->validate([
            'name' => 'required|unique:furnitures,name',
            'icon_path' => 'nullable|image',
            'show' => 'required|boolean',
            'primary_furniture_id' => 'nullable|exists:furnitures,id',
        ]);

        $file = $request->file('icon_path');
        if ($file) {
            $file_name = $validated['name'] . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/furniture', $file_name);
            $validated['icon_path'] = $path;
        } else {
            $validated['show'] = false;
        }


        $furniture = Furniture::create($validated);

        if ($validated['primary_furniture_id'] == '') {
            $furniture->is_primary = true;
            $furniture->save();
        } else {
            $furniture->is_primary = false;
            $furniture->save();
        }


        return redirect()->route('furniture.index')->banner('Furniture created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function show(Furniture $furniture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function edit(Furniture $furniture)
    {
        $this->authorize('update', $furniture);
        $primaryFurnitures = Furniture::where('is_primary', true)->get();
        return view('app.attributes.furniture.edit', compact('furniture', 'primaryFurnitures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Furniture $furniture)
    {
        $this->authorize('update', $furniture);
        $validated = $request->validate([
            'name' => 'required|unique:furnitures,name,' . $furniture->id,
            'show' => 'required|boolean',
            'primary_furniture_id' => 'nullable|exists:furnitures,id',
            'icon_path' => 'nullable|image|max:2048',
        ]);

        $file = $request->file('icon_path');

        if ($file) {
            $file_name = $validated['name'] . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/furniture', $file_name);
            $validated['icon_path'] = $path;
        } else {
            $validated['show'] = false;
        }

        if ($validated['primary_furniture_id'] == '') {
            $validated['is_primary'] = true;
        } else {
            $validated['is_primary'] = false;
        }

        $furniture->update($validated);

        return redirect()->route('furniture.index')->banner('Furniture updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Furniture $furniture)
    {
        //
    }
}
