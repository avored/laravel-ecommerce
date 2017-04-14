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
