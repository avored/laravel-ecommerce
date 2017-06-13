@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">OrderStatus List</span>
            <a style="" href="{{ route('admin.order-status.create') }}" class="btn btn-primary pull-right">Create
                OrderStatus</a>
        </h1>

        <table class="table table-bordered" id="order-status-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Edit</th>
                <th>Destroy</th>
            </tr>
            </thead>
        </table>
    </div>
@stop

@push('scripts')
<script>
    $(function () {
        $('#order-status-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.sale.order-status.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/admin/order-status/' + object.id + '/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-order-status-destroy-' + object.id + '" method="post"  action="/admin/order-status/' + object.id + '" >' +
                            '<input type="hidden" name="_method" value="DELETE"/>' +
                            '<input type="hidden" name="_token" value="{{ csrf_token() }}"/>' +
                            '</form>' +
                            '<a onclick="event.preventDefault();jQuery(\'#admin-order-status-destroy-' + object.id + '\').submit()"' +
                            'href="/admin/order-status/' + object.id + '">Destroy' +
                            '</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush