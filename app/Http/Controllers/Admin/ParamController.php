<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Param\ParamFilterTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Param\StoreRequest;
use App\Http\Requests\Admin\Param\UpdateRequest;
use App\Http\Resources\Param\ParamResource;
use App\Http\Resources\ParamGroup\ParamGroupResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Param;
use App\Models\ParamGroup;
use App\Models\Product;
use App\Services\ParamService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $params = Param::all();
        $params = ParamResource::collection($params)->resolve();
        return inertia('Admin/Param/Index', compact('params'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filterTypes = ParamFilterTypeEnum::collection();
        $paramGroups = ParamGroup::all();
        $paramGroups = ParamGroupResource::collection($paramGroups)->resolve();
        return inertia('Admin/Param/Create', compact('filterTypes', 'paramGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $param = ParamService::store($data);
        return ParamResource::make($param)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Param $param)
    {
        $id = $param->param_groups_id;

        $paramGroup = ParamGroup::find($id);

        $paramGroup = ParamGroupResource::make($paramGroup)->resolve();

        $param = ParamResource::make($param)->resolve();

        return inertia('Admin/Param/Show', compact('param', 'paramGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Param $param)
    {
        $filterTypes = ParamFilterTypeEnum::collection();
        $param = ParamResource::make($param)->resolve();
        $paramGroups = ParamGroup::all();
        $paramGroups = ParamGroupResource::collection($paramGroups)->resolve();
        return inertia('Admin/Param/Edit', compact('param', 'paramGroups', 'filterTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Param $param)
    {
        $data = $request->validated();
        $param = ParamService::update($param, $data);
        return ParamResource::make($param)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Param $param)
    {
        $param->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
