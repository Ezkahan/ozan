<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class ModalBannerDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'asc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('modal_banners as mb')
            ->select('mb.id', 'mb.title', 'mb.image', 'mb.description', 'mb.url');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'image',
            'label'      => 'Image',
            'sortable'   => false,
            'escapeHTML' => false,
            // 'type'       => 'image'
            'wrapper' => function ($value) {
                if ($value->image) {
                    return '<img src="' . asset('storage/' . $value->image) . '" width="50px" height="50px">';
                } else {
                    return '-';
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'description',
            'label'      => trans('Description'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.banner.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.banner.delete',
            'confirm_text' => __('ui::app.datagrid.massaction.delete', ['resource' => 'banner']),
            'icon'         => 'icon trash-icon',
            // 'function'     => 'deleteFunction($event, "delete")'
        ]);

        // $this->addMassAction([
        //     'type'   => 'delete',
        //     'label'  => trans('admin::app.datagrid.delete'),
        //     'action' => route('admin.catalog.brands.massdelete'),
        //     'method' => 'POST',
        // ]);
    }
}
