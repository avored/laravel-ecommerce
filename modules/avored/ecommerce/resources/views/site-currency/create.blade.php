@extends('avored-ecommerce::layouts.app')

@section('content')

    <div id="admin-site-currency-page" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-ecommerce::currency.create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.site-currency.store') }}" method="post">
                        @csrf

                        @include('avored-ecommerce::site-currency._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-ecommerce::currency.create') }}
                            </button>
                            <a href="{{ route('admin.site-currency.index') }}" class="btn">
                                {{ __('avored-ecommerce::lang.cancel') }}
                            </a>
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
        el: '#admin-site-currency-page',
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