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

class TenantDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('house.price', fn (Tenant $tenant) => $tenant->house->price)
            ->editColumn('house.house_number', fn (Tenant $tenant) => $tenant->house->house_number)
            ->editColumn('payments.date', fn (Tenant $tenant) => $tenant->payments->last()->date ?? 'No Payment Yent')
            ->addColumn('action', fn (Tenant $tenant) => view('tenant.components.action', compact('tenant')))
            ->rawColumns(['action']);
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
            ->setTableId('tenant_dataTable')
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
            Column::make('payments.date', 'payments.date')
                ->title('Last Payment'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tenant_' . date('YmdHis');
    }
}
