<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class BrandDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'asc';

    public function prepareQueryBuilder()
    {
        $locales = ['tm', 'en', 'ru'];
        $selects = [
            'attribute_options.id',
            'attribute_options.admin_name',
            'attribute_options.sort_order',
            'attribute_options.swatch_value'
        ];

        foreach ($locales as $locale) {
            $selects[] = DB::raw("MAX(CASE WHEN attribute_option_translations.locale = '{$locale}' THEN attribute_option_translations.label ELSE NULL END) as {$locale}_translation");
        }

        $queryBuilder = DB::table('attribute_options')
            ->select($selects)
            ->leftJoin('attributes', 'attribute_options.attribute_id', '=', 'attributes.id')
            ->leftJoin('attribute_option_translations', 'attribute_options.id', '=', 'attribute_option_translations.attribute_option_id')
            ->where('attributes.code', 'brand')
            ->groupBy('attribute_options.id', 'attribute_options.admin_name');


        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'swatch_value',
            'label'      => 'Swatch',
            'sortable'   => false,
            'escapeHTML' => false,
            // 'type'       => 'image'
            'wrapper' => function ($value) {
                if ($value->swatch_value) {
                    return '<img src="' . asset('storage/' . $value->swatch_value) . '" width="50px" height="50px">';
                } else {
                    return '-';
                }
            },
        ]);


        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'admin_name',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);


        $locales = ['tm', 'en', 'ru'];

        foreach ($locales as $locale) {
            $this->addColumn([
                'index' => "{$locale}_translation",
                'label' => strtoupper($locale) . ' Terjime',
                'type' => 'string',
                'searchable' => true,
                'sortable' => true,
                'filterable' => true,
            ]);
        }


        $this->addColumn([
            'index'      => 'sort_order',
            'label'      => trans('admin::app.datagrid.position'),
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
            'route'  => 'admin.catalog.brands.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.catalog.brands.delete',
            'confirm_text' => __('ui::app.datagrid.massaction.delete', ['resource' => 'attribute_option']),
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
