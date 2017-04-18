@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Pages List</span>
            <a style="" href="{{ route('admin.page.create') }}" class="btn btn-primary pull-right">Create
                Page</a>
        </h1>
        <table class="table table-bordered" id="page-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Meta Title</th>
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
        $('#page-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.page.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'slug', name: 'slug'},
                {data: 'meta_title', name: 'meta_title'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {

                        return '<a href="/admin/page/'+ object.id +'/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-page-destroy-'+object.id+'" method="post"  action="/admin/page/'+object.id+'" ><input type="hidden" name="_method" value="DELETE"/><input type="hidden" name="_token" value="{{ csrf_token() }}"/> </form> <a onclick="event.preventDefault();jQuery(\'#admin-page-destroy-'+object.id+'\').submit()"  href="/admin/page/'+object.id+'">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush