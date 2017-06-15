@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Product List</span>
            <a style="" href="{{ route('admin.product.create') }}" class="btn btn-primary pull-right">Create
                Product</a>
        </h1>

        <table class="table table-bordered" id="admin-product-table">
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
        $('#admin-product-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.product.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/admin/product/' + object.id + '/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-product-destroy-' + object.id + '" method="post"  action="/admin/product/' + object.id + '" >' +
                                '<input type="hidden" name="_method" value="DELETE"/>' +
                                '<input type="hidden" name="_token" value="{{ csrf_token() }}"/> ' +
                                '</form>' +
                                ' <a onclick="event.preventDefault();jQuery(\'#admin-product-destroy-' + object.id + '\').submit()"  ' +
                                'href="/admin/product/' + object.id + '">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush