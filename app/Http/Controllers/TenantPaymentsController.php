<?php

namespace App\Http\Controllers;

use App\DataTables\TenantPaymentsDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TenantPaymentsController extends Controller
{
    public function index($tenantId): JsonResponse | View
    {
        $tenantPaymentsDataTable = new TenantPaymentsDataTable($tenantId);

        return $tenantPaymentsDataTable->render('tenantPayments.index', compact('tenantId'));
    }
}
