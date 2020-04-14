@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.artistDebitedTransactionList.title') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArtistPaymentHistory">
            <thead>
            <tr>
                <th width="10">

                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.id') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.any_fees') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.any_charges') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.final_amount') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.txn_for') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.txn_info') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.status') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.proccesed_by') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.user') }}
                </th>
                <th>
                    {{ trans('cruds.user.fields.referred_by') }}
                </th>
                <th>
                    {{ trans('cruds.artistPaymentHistory.fields.earn_from') }}
                </th>
                <th>Created</th>
                <th>Updated</th>
                <th>
                    &nbsp;
                </th>
            </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            let dtOverrideGlobals = {
                    buttons: dtButtons,
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    aaSorting: [],
                    ajax: "{{ route('admin.artist-debited-transaction-lists.index') }}",
                    columns: [
                        { data: 'placeholder', name: 'placeholder' },
                        { data: 'id', name: 'id' },
                        { data: 'any_fees', name: 'any_fees' },
                        { data: 'any_charges', name: 'any_charges' },
                        { data: 'final_amount', name: 'final_amount' },
                        { data: 'txn_for', name: 'txn_for' },
                        { data: 'txn_info', name: 'txn_info' },
                        { data: 'status', name: 'status' },
                        { data: 'proccesed_by', name: 'proccesed_by' },
                        { data: 'user_referred_by', name: 'user.referred_by' },
                        { data: 'user.referred_by', name: 'user.referred_by' },
                        { data: 'earn_from_name', name: 'earn_from.name' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'updated_at', name: 'updated_at' },
                        { data: 'actions', name: '{{ trans('global.actions') }}' }
                    ],
                    order: [[ 1, 'desc' ]],
                    pageLength: 25,
                };
            $('.datatable-ArtistPaymentHistory').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });

    </script>
@endsection