@extends('avored-ecommerce::layouts.app')

@section('content')

        <div id="admin-attribute-page" class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('avored-ecommerce::attribute.create') }}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.attribute.store') }}" method="post">
                            @csrf

                            @include('avored-ecommerce::attribute._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">{{ __('avored-ecommerce::attribute.create') }}</button>
                                <a href="{{ route('admin.attribute.index') }}" class="btn">{{ __('avored-ecommerce::lang.cancel') }}</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
@endsection

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-attribute-page',
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