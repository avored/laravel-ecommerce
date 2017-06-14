@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Order Return Request List</span>
        </h1>

        <table class="table table-bordered" id="order-return-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>OrderID</th>
                <th>User Option</th>
                <th>Edit</th>
            </tr>
            </thead>
        </table>
    </div>
@stop

@push('scripts')
<script>
    $(function () {
        $('#order-return-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.order-return.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'order_id', name: 'order_id'},
                {data: 'user_option', name: 'user_option'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/admin/order-return/' + object.id + '/edit">Edit</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush