<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Tenant;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\DataTables\TenantDataTable;
use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Http\Resources\HouseResource;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TenantDataTable $tenantDataTable): JsonResponse | View
    {
        $houses = House::doesntHave('tenant')->get();

        return $tenantDataTable->render('tenant.index', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $storeTenantRequest): RedirectResponse
    {
        $monthsPassed = Carbon::now()->diffInMonths($storeTenantRequest->start_date);

        $house = House::find($storeTenantRequest->house_id);

        $balance = (int)abs($monthsPassed) == 0 ? 0 : $house->price * (int)abs($monthsPassed);

        Tenant::create($storeTenantRequest->except('balance') +
            [
                'balance' => $balance
            ]);

        alert()->success('Tenant Create Successfully!');

        return redirect()->route('tenant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant): HouseResource | View
    {
        return new HouseResource($tenant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $updateTenantRequest, Tenant $tenant): RedirectResponse
    {
        $tenant->update($updateTenantRequest->validated());

        alert()->success('Tenant Update Successfully!');

        return redirect()->route('tenant.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant): RedirectResponse
    {
        $tenant->delete();

        return redirect()->route('tenant.index');
    }
}
