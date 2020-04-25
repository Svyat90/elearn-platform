<?php

namespace App\Http\Controllers\Admin;

use App\ArtistEnquiry;
use App\ArtistResponse;
use App\Chart\CrazyChart;
use App\Order;
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
            'conditions'            => [
                ['name' => 'Count','condition' => "payment_status = '1' ", 'color' => 'black']
            ],
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
                $query = $query->where('payment_status',1);
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
            'group_by_field'        => 'created_at',
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
                $query = $query->leftJoin('role_user','role_user.user_id','=','users.id')
                                ->where('role_user.role_id', 2);
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
            'group_by_field'        => 'created_at',
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
                $query = $query->leftJoin('role_user','role_user.user_id','=','users.id')
                                ->where('role_user.role_id', 3);
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

        // Sales Bar Count
        $settings5 = [
            'chart_title'           => 'Sales Bar Count',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'conditions'            => [
                ['name' => 'Count','condition' => "payment_status = '1' ", 'color' => 'black']
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'payment_status',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];
        $settings5_day = $settings5;
        $settings5_day['group_by_period'] = 'day';
        $settings5_day['chart_title'] = 'Sales Bar Count Daily';
        $chart5_day = new CrazyChart($settings5_day);

        $settings5_week = $settings5;
        $settings5_week['group_by_period'] = 'week';
        $settings5_week['chart_title'] = 'Sales Bar Count Weekly';
        $chart5_week = new CrazyChart($settings5_week);

        $settings5_month = $settings5;
        $settings5_month['group_by_period'] = 'month';
        $settings5_month['chart_title'] = 'Sales Bar Count Monthly';
        $chart5_month = new CrazyChart($settings5_month);

        $settings5_year = $settings5;
        $settings5_year['group_by_period'] = 'year';
        $settings5_year['chart_title'] = 'Sales Bar Count Year';
        $chart5_year = new CrazyChart($settings5_year);


        // Sales Bar Amount
        $settings5_amout = [
            'chart_title'           => 'Sales Bar Amount',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Order',
            'conditions'            => [
                ['name' => 'Amount','condition' => "payment_status = '1' ", 'color' => 'black']
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'booking_amount',
            'filter_field'          => 'payment_status',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];
        $settings5_amout_day = $settings5_amout;
        $settings5_amout_day['group_by_period'] = 'day';
        $settings5_amout_day['chart_title'] = 'Sales Bar Amount Daily';
        $chart5_amount_day = new CrazyChart($settings5_amout_day);

        $settings5_amout_week = $settings5_amout;
        $settings5_amout_week['group_by_period'] = 'week';
        $settings5_amout_week['chart_title'] = 'Sales Bar Amount Weekly';
        $chart5_amount_week = new CrazyChart($settings5_amout_week);

        $settings5_amout_month = $settings5_amout;
        $settings5_amout_month['group_by_period'] = 'month';
        $settings5_amout_month['chart_title'] = 'Sales Bar Amount Monthly';
        $chart5_amount_month = new CrazyChart($settings5_amout_month);

        $settings5_amout_year = $settings5_amout;
        $settings5_amout_year['group_by_period'] = 'year';
        $settings5_amout_year['chart_title'] = 'Sales Bar Amount Year';
        $chart5_amount_year = new CrazyChart($settings5_amout_year);


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

//        $chart6 = new LaravelChart($settings6);
        $chart6 = '';

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
                'user'         => 'name',
                'payment_status' => '',
                'created_at'   => '',
            ],
        ];

        $settings7['data'] = [];

        if (class_exists($settings7['model'])) {
            $settings7['data'] = $settings7['model']::latest()
                                ->take($settings7['entries_number'])
                                ->get();
            if($settings7['data']) {
                foreach ($settings7['data'] as $key => $row) {
                    $row->payment_status =  $row->payment_status ? Order::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
                }
            }
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
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'id'          => '',
                'video' => '',
                'note' => '',
                'celebrity'      => '',
                'action'       => '',
                'created_at'  => '',
            ],
        ];

        $settings8['data'] = [];

        if (class_exists($settings8['model'])) {
            $settings8['data'] = $settings8['model']::latest()
                ->take($settings8['entries_number'])
                ->get();

            if($settings8['data']) {
                foreach ($settings8['data'] as $key => $row) {
                    $row->video =  $row->video ? $row->video->name : '';
                    $row->action =  $row->artist_action ? ArtistResponse::ARTIST_ACTION_SELECT[$row->artist_action] : '';
                    $row->note =  $row->artist_note ? $row->artist_note : "";
                    $row->celebrity =  $row->artist ? $row->artist->display_name : '';
                }
            }
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
                'name'       => '',
                'email'      => '',
                'status'     => '',
                'created_at'  => '',
            ],
        ];

        $settings9['data'] = [];

        if (class_exists($settings9['model'])) {
            $settings9['data'] = $settings9['model']::latest()
                ->take($settings9['entries_number'])
                ->get();
            if($settings9['data']) {
                foreach ($settings9['data'] as $key => $row) {
                    $row->status =  $row->status ? ArtistEnquiry::STATUS_SELECT[$row->status] : '';
                }
            }
        }

        if (!array_key_exists('fields', $settings9)) {
            $settings9['fields'] = [];
        }

        $settings10 = [
            'chart_title'           => 'Orders Completed %',
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
            'chart_title'           => 'Orders Processing %',
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
            'chart_title'           => 'Other Statuses %',
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

        return view('admin.home.index', compact('settings1',
            'settings2',
            'settings3',
            'settings4',
            'chart5',
            'chart5_day',
            'chart5_week',
            'chart5_month',
            'chart5_year',
            'chart5_amount',
            'chart5_amount_day',
            'chart5_amount_week',
            'chart5_amount_month',
            'chart5_amount_year',
            'chart6', 'settings7', 'settings8', 'settings9', 'settings10', 'settings11', 'settings12'));
    }

}
