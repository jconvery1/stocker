<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDropdownRequest;
use App\Http\Resources\DropdownResource;
use App\Models\Dropdown;

class DropdownController extends Controller
{
    public function index()
    {
        return DropdownResource::collection(Dropdown::all());
    }

    public function show(Dropdown $dropdown)
    {
        return new DropdownResource($dropdown);
    }

    public function store(StoreDropdownRequest $request)
    {
        Dropdown::create($request->validated());
        return response()->json("dropdown created!");
    }

    public function update(StoreDropdownRequest $request, Dropdown $dropdown)
    {
        $dropdown->update($request->validated());
        return response()->json("dropdown updated");
    }

    public function destroy(Dropdown $dropdown)
    {
        $dropdown->delete();
        return response()->json("dropdown deleted");
    }

    public function getDropdownByDropdownGroup($dropdown_group)
    {
        $dropdowns = Dropdown::where('dropdown_group', $dropdown_group)->get();
        return $dropdowns;
    }
}
