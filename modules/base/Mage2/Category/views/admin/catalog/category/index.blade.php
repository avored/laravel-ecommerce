@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Category List</span>
            <a style="" href="{{ route('admin.category.create') }}" class="btn btn-primary pull-right">Create
                Category</a>
        </h1>

        <table class="table table-bordered" id="category-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
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
        $('#category-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.category.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/admin/category/' + object.id + '/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-category-destroy-' + object.id + '" method="post"  action="/admin/category/' + object.id + '" ><input type="hidden" name="_method" value="DELETE"/><input type="hidden" name="_token" value="{{ csrf_token() }}"/> </form> <a onclick="event.preventDefault();jQuery(\'#admin-category-destroy-' + object.id + '\').submit()"  href="/admin/category/' + object.id + '">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush