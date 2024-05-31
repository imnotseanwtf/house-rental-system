<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseType;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\DataTables\HouseDataTable;
use App\Http\Requests\House\StoreHouseRequest;
use App\Http\Requests\House\UpdateHouseRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\HouseResource;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HouseDataTable $houseDataTable): JsonResponse | View
    {
        $houseTypeCategories = HouseType::all();

        return $houseDataTable->render('house.index', compact('houseTypeCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseRequest $storeHouseRequest): RedirectResponse
    {
        House::create($storeHouseRequest->validated());

        alert()->success('House Create Successfully!');

        return redirect()->route('house.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house): HouseResource | View
    {
        $house->load('houseType');

        return new HouseResource($house);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseRequest $updateHouseRequest, House $house): RedirectResponse
    {
        $house->update($updateHouseRequest->validated());

        alert()->success('House Update Successfully!');

        return redirect()->route('house.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house): RedirectResponse
    {
        $house->delete();

        return redirect()->route('house.index');
    }
}
