<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Total Orders',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings1['filter_period'])) {
                        switch ($settings1['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings1['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings1['aggregate_function'] ?? 'count'}
                ($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => 'Total Sales',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                        now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings2['filter_period'])) {
                        switch ($settings2['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings2['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings2['aggregate_function'] ?? 'count'}
                ($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Total Customers',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings3['total_number'] = 0;

        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings3['filter_period'])) {
                        switch ($settings3['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings3['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings3['aggregate_function'] ?? 'count'}
                ($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Total Celebrities',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings4['total_number'] = 0;

        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where($settings4['filter_field'], '>=',
                        now()->subDays($settings4['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings4['filter_period'])) {
                        switch ($settings4['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings4['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings4['aggregate_function'] ?? 'count'}
                ($settings4['aggregate_field'] ?? '*');
        }

        // Sales Bar dayli
        $settings5 = [
            'chart_title'           => 'Sales Bar Count',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'payment_status',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];
        $chart5 = new LaravelChart($settings5);

        // Reigtered User
        $settings6 = [
            'chart_title'           => 'Registered user',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\User',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];

        $chart6 = new LaravelChart($settings6);

        $settings7 = [
            'chart_title'           => 'Latest Orders',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
            'fields'                => [
                'id'           => '',
                'created_at'   => '',
                'user'         => 'name',
                'order_status' => '',
            ],
        ];

        $settings7['data'] = [];

        if (class_exists($settings7['model'])) {
            $settings7['data'] = $settings7['model']::latest()
                ->take($settings7['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings7)) {
            $settings7['fields'] = [];
        }

        $settings8 = [
            'chart_title'           => 'Latest Celebrity Response',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\ArtistResponse',
            'group_by_field'        => 'action_update',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'fields'                => [
                'id'          => '',
                'order'       => 'payment_status',
                'video'       => 'name',
                'artist_note' => '',
                'created_at'  => '',
                'artist'      => 'display_name',
            ],
        ];

        $settings8['data'] = [];

        if (class_exists($settings8['model'])) {
            $settings8['data'] = $settings8['model']::latest()
                ->take($settings8['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings8)) {
            $settings8['fields'] = [];
        }

        $settings9 = [
            'chart_title'           => 'Latest Celebrity Equity',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\ArtistEnquiry',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'id'         => '',
                'artist'     => 'first_name',
                'name'       => '',
                'email'      => '',
                'contact_no' => '',
                'status'     => '',
            ],
        ];

        $settings9['data'] = [];

        if (class_exists($settings9['model'])) {
            $settings9['data'] = $settings9['model']::latest()
                ->take($settings9['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings9)) {
            $settings9['fields'] = [];
        }

        $settings10 = [
            'chart_title'           => 'Orders Completed',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
        ];

        $settings10['total_number'] = 0;

        if (class_exists($settings10['model'])) {
            $settings10['total_number'] = $settings10['model']::when(isset($settings10['filter_field']), function ($query) use ($settings10) {
                if (isset($settings10['filter_days'])) {
                    return $query->where($settings10['filter_field'], '>=',
                        now()->subDays($settings10['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings10['filter_period'])) {
                        switch ($settings10['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings10['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings10['aggregate_function'] ?? 'count'}
                ($settings10['aggregate_field'] ?? '*');
        }

        $settings11 = [
            'chart_title'           => 'Orders Processing',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
        ];

        $settings11['total_number'] = 0;

        if (class_exists($settings11['model'])) {
            $settings11['total_number'] = $settings11['model']::when(isset($settings11['filter_field']), function ($query) use ($settings11) {
                if (isset($settings11['filter_days'])) {
                    return $query->where($settings11['filter_field'], '>=',
                        now()->subDays($settings11['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings11['filter_period'])) {
                        switch ($settings11['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings11['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings11['aggregate_function'] ?? 'count'}
                ($settings11['aggregate_field'] ?? '*');
        }

        $settings12 = [
            'chart_title'           => 'Other Statuses',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
        ];

        $settings12['total_number'] = 0;

        if (class_exists($settings12['model'])) {
            $settings12['total_number'] = $settings12['model']::when(isset($settings12['filter_field']), function ($query) use ($settings12) {
                if (isset($settings12['filter_days'])) {
                    return $query->where($settings12['filter_field'], '>=',
                        now()->subDays($settings12['filter_days'])->format('Y-m-d'));
                } else
                    if (isset($settings12['filter_period'])) {
                        switch ($settings12['filter_period']) {
                            case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                            case 'month':$start = date('Y-m') . '-01';break;
                            case 'year':$start  = date('Y') . '-01-01';break;
                        }

                        if (isset($start)) {
                            return $query->where($settings12['filter_field'], '>=', $start);
                        }

                    }

            })
                ->{$settings12['aggregate_function'] ?? 'count'}
                ($settings12['aggregate_field'] ?? '*');
        }

        return view('admin.home.index', compact('settings1', 'settings2', 'settings3', 'settings4', 'chart5', 'chart6', 'settings7', 'settings8', 'settings9', 'settings10', 'settings11', 'settings12'));
    }

}
