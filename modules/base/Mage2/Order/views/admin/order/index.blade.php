@extends('layouts.admin')
@section('content')
    <div class="container">
        <table class="table table-bordered" id="order-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Shipping Option</th>
                <th>Payment Option</th>
                <th>Order Status Title</th>
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
                {data: 'title', name: 'title'},
                {data: 'identifier', name: 'identifier'},
                {data: 'type', name: 'type'},
                {
                    data: 'view',
                    name: 'view',
                    sortable: false,
                    render: function (data, type, object, meta) {

                        return '<a href="' + object.id + '">View</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush