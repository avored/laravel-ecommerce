@extends('avored-ecommerce::layouts.app')

@section('content')
<div id="admin-cms-page" class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Page</div>
                <div class="card-body">

                    <form action="{{ route('admin.page.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')
                        @include('avored-ecommerce::page._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Page</button>
                            <a href="{{ route('admin.page.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-cms-page',
        data : {
            model: {},
            autofocus:true,
            disabled: false
           
        },
        methods: {
            changeModelValue: function(val,fieldName) {
                this.model[fieldName] = val;
            }
        }
    });

</script>


@endpush