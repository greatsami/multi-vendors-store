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

class SellerProductDataTable extends DataTable
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
                $editBtn = "<a href='".route('admin.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.products.destroy', $query->id)."' class='btn btn-danger delete-item ml-2'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = "<div class='dropdown dropleft d-inline'>
                            <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-cog'></i>
                            </button>
                            <div class='dropdown-menu'>
                            <a class='dropdown-item has-icon' href='".route('admin.product-galleries.index', ['product' => $query->id])."'><i class='far fa-heart'></i> Image Gallery</a>
                            <a class='dropdown-item has-icon' href='".route('admin.product-variants.index', ['product' => $query->id])."'><i class='far fa-file'></i> Variants</a>
                            </div>
                            </div>";
                return $editBtn.$deleteBtn.$moreBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img src='".asset('uploads/products/'.$query->thumb_image)."' width='100'>";
            })
            ->addColumn('type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge badge-success">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge badge-warning">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge badge-info">Top Product</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge badge-danger">Best Product</i>';
                        break;
                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
            })
            ->addColumn('status', function ($query) {
                $checkedOrNot = $query->status == '1' ? 'checked' : null;
                $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" '.$checkedOrNot.' name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                    </label>';
                return $button;
            })
            ->addColumn('vendor', function ($query) {
                return $query->vendor->shop_name;
            })
            ->addColumn('approved', function ($query) {
                $selected = $query->is_approved == '1' ? 'selected' : '';
                return '<select class="form-control is_approved" data-id="'.$query->id.'">
                <option value="0">Pending</option>
                <option value="1" '.$selected.'>Approve</option>
                </select>';
            })
            ->rawColumns(['image', 'action', 'type', 'approved', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', '!=', auth()->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('vendor')->width(200),
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
        return 'Product_' . date('YmdHis');
    }
}
