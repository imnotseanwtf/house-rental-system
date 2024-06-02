<?php

namespace App\DataTables;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MonthlyBalancesReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('house.price', fn (Tenant $tenant) => $tenant->house->price)
            ->editColumn('house.house_number', fn (Tenant $tenant) => $tenant->house->house_number)
            ->editColumn('payable_months', fn (Tenant $tenant) => $tenant->payments->count() . ($tenant->payments->count() > 1 ? ' Months' : ' Month'))
            ->editColumn('payable_amount', fn (Tenant $tenant) => $tenant->payments->count() * $tenant->house->price)
            ->editColumn('paid', fn (Tenant $tenant) => $tenant->payments->sum('amount'))
            ->editColumn('payments.date', fn (Tenant $tenant) => $tenant->payments->last()->date ?? 'No Payment Yent')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tenant $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['house', 'payments'])
            ->select('tenants.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('monthlyBalancesReport_dataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('house.house_number', 'house.house_number')
                ->title('House Number'),
            Column::make('house.price', 'house.price')
                ->title('Monthly Rate'),
            Column::make('balance')
                ->title('Outstanding Balance'),
            Column::make('payable_months')
                ->title('Payable Months')
                ->orderable(false)
                ->searchable(false),
            Column::make('payable_amount')
                ->title('Payable Amount')
                ->orderable(false)
                ->searchable(false),
            Column::make('paid')
                ->orderable(false)
                ->searchable(false),
            Column::make('payments.date', 'payments.date')
                ->title('Last Payment')
                ->orderable(false)
                ->searchable(false),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MonthlyBalancesReport_' . date('YmdHis');
    }
}
