<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='btn btn-danger delete-item'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = "<div class='btn-group dropstart' style='margin-left: 4px;'>
                <button type='button' class='btn btn-secondary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                <i class='fas fa-cog'></i>
                </button>
                <ul class='dropdown-menu'>
                <li><a class='dropdown-item' href='".route('vendor.product-galleries.index', ['product' => $query->id])."'><i class='far fa-heart'></i> Image Gallery</a></li>
                <li><a class='dropdown-item' href='".route('vendor.product-variants.index', ['product' => $query->id])."'><i class='far fa-file'></i> Variants</a></li>
                </ul>
                </div>";
                return $editBtn.$deleteBtn.$moreBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img src='".asset('uploads/products/'.$query->thumb_image)."' width='100'>";
            })
            ->addColumn('type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge bg-success">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge bg-warning">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge bg-info">Top Product</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge bg-danger">Best Product</i>';
                        break;
                    default:
                        return '<i class="badge bg-dark">None</i>';
                        break;
                }
            })
            ->addColumn('approved', function ($query) {
                return $query->is_approved === 1 ? '<i class="badge bg-success">Approved</i>' : '<i class="badge bg-warning">Pending</i>';
            })
            ->addColumn('status', function ($query) {
                $checkedOrNot = $query->status == '1' ? 'checked' : null;
                $button = '<div class="form-check form-switch mt-2">
                    <input class="form-check-input change-status" '.$checkedOrNot.' type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'">
                    </div>';
                return $button;
            })
            ->rawColumns(['image', 'action', 'type', 'approved', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', auth()->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
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
            Column::make('id')->width(100),
            Column::make('image')->width(200),
            Column::make('name'),
            Column::make('price')->width(100),
            Column::make('type')->width(100),
            Column::make('approved')->width(100),
            Column::make('status')->width(100),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
