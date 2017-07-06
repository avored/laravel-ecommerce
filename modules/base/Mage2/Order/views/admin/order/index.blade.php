@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Orders</h1>
        <table class="table table-bordered" id="order-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Shipping Option</th>
                <th>Payment Option</th>
                <th>Status</th>
                <th>View</th>
            </tr>
            </thead>
        </table>
    </div>
@stop

@push('scripts')
<script>
    $(function () {
        $('#order-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.order.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'shipping_option', name: 'shipping_option'},
                {data: 'payment_option', name: 'payment_option'},
                {data: 'order_status_id', name: 'order_status_id'},
                {
                    data: 'view',
                    name: 'view',
                    sortable: false,
                    render: function (data, type, object, meta) {

                        return '<a href="/admin/order/' + object.id + '">View</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush