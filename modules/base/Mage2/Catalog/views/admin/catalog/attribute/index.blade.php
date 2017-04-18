@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Product Attribute List</span>
            <a style="" href="{{ route('admin.attribute.create') }}" class="btn btn-primary pull-right">Create
                Attribute</a>
        </h1>


        <table class="table table-bordered" id="attribute-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Identifier</th>
                <th>Type</th>
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
        $('#attribute-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.attribute.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'identifier', name: 'identifier'},
                {data: 'type', name: 'type'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {

                        return '<a href="' + object.id + '">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="' + object.id + '">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush