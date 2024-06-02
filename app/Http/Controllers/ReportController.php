<?php

namespace App\Http\Controllers;

use App\DataTables\MonthlyBalancesReportDataTable;
use App\DataTables\MonthlyPaymentsReportDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function monthlyPaymentsReport(MonthlyPaymentsReportDataTable $monthlyPaymentsReportDataTable): JsonResponse | View
    {
        return $monthlyPaymentsReportDataTable->render('reports.monthlyPaymentsReport.index');
    }

    public function monthlyBalancesReport(MonthlyBalancesReportDataTable $monthlyBalancesReportDataTable): JsonResponse | View
    {
        return $monthlyBalancesReportDataTable->render('reports.monthlyBalancesReport.index');
    }
}
