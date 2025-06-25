<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ParamGroup\StoreRequest;


use App\Http\Requests\Admin\ParamGroup\UpdateRequest;
use App\Http\Resources\ParamGroup\ParamGroupResource;

use App\Models\ParamGroup;
use App\Services\ParamGroupService;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParamGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paramGroups = ParamGroup::all();
        $paramGroups = ParamGroupResource::collection($paramGroups)->resolve();
        return inertia('Admin/ParamGroup/Index', compact('paramGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/ParamGroup/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $paramGroup = ParamGroupService::store($data);
        return ParamGroupResource::make($paramGroup)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(ParamGroup $paramGroup)
    {
        $paramGroup = ParamGroupResource::make($paramGroup)->resolve();
        return inertia('Admin/ParamGroup/Show', compact('paramGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParamGroup $paramGroup)
    {
        $paramGroup = ParamGroupResource::make($paramGroup)->resolve();
        return inertia('Admin/ParamGroup/Edit', compact('paramGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ParamGroup $paramGroup)
    {
        $data = $request->validated();
        $paramGroup = ParamGroupService::update($paramGroup, $data);
        return ParamGroupResource::make($paramGroup)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParamGroup $paramGroup)
    {
        $paramGroup->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
