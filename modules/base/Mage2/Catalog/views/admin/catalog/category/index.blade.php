@extends('layouts.admin')

@section('content')
    <div class="container">
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
    $(function() {
        $('#category-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.category.data-grid-table.get-data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function ( data, type, object, meta ) {

                        return '<a href="'+object.id+'">Edit</a>';
                    }
                },
                { data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function ( data, type, object, meta ) {
                        return '<a href="'+object.id+'">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush