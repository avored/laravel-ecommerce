@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Gift Coupon List</span>
            <a style="" href="{{ route('admin.gift-coupon.create') }}" class="btn btn-primary pull-right">Create
                Gift Coupon</a>
        </h1>

        <table class="table table-bordered" id="gift-coupon-table">
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
        $('#gift-coupon-table').DataTable({
            processing: true,
            searching: false,
            serverSide: true,
            ajax: '{!! route('admin.sale.gift-coupon.data-grid-table.get-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/admin/sale/gift-coupon/'+ object.id +'/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="admin-gift-coupon-destroy-'+object.id+'" method="post"  action="/admin/sale/gift-coupon/'+object.id+'" >' +
                                '<input type="hidden" name="_method" value="DELETE"/>' +
                                '<input type="hidden" name="_token" value="{{ csrf_token() }}"/>' +
                                '</form>' +
                                '<a onclick="event.preventDefault();jQuery(\'#admin-gift-coupon-destroy-'+object.id+'\').submit()"' +
                                    'href="/admin/sale/gift-coupon/'+object.id+'">Destroy' +
                                '</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush