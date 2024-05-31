<?php

namespace App\Http\Controllers;

use App\Models\HouseType;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\DataTables\HouseTypeDataTable;
use App\Http\Requests\HouseType\StoreHouseTypeRequest;
use App\Http\Requests\HouseType\UpdateHouseTypeRequest;

class HouseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HouseTypeDataTable $houseTypeDataTable): JsonResponse | View
    {
        return $houseTypeDataTable->render('houseType.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseTypeRequest $storeHouseTypeRequest): RedirectResponse
    {
        HouseType::create($storeHouseTypeRequest->validated());

        alert()->success('Category Store Succesfully!');

        return redirect()->route('house-type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseType $house_type): JsonResponse | View
    {
        return response()->json($house_type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseTypeRequest $updateHouseTypeRequest, HouseType $house_type): RedirectResponse
    {
        $house_type->update($updateHouseTypeRequest->validated());

        alert()->success('Category Update Sucessfully!');

        return redirect()->route('house-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseType $house_type): RedirectResponse
    {
        $house_type->delete();

        return redirect()->route('house-type.index');
    }
}
