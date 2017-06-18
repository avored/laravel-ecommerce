@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table table-bordered" id="review-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Product Title</th>
                <th>Start</th>
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
        $('#review-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.review.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'product_title', name: 'product_title'},
                {data: 'star', name: 'start'},

                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {

                        return '<a href="/admin/review/' + object.id + '/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-review-destroy-' + object.id + '" method="post"  action="/admin/review/' + object.id + '" ><input type="hidden" name="_method" value="DELETE"/><input type="hidden" name="_token" value="{{ csrf_token() }}"/> </form> <a onclick="event.preventDefault();jQuery(\'#admin-review-destroy-' + object.id + '\').submit()"  href="/admin/review/' + object.id + '">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush
