@extends('layouts.admin')
@section('content')
    <div class="container">
        <table class="table table-bordered" id="admin-user-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
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
        $('#admin-user-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.user.data-grid-table.get-data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
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