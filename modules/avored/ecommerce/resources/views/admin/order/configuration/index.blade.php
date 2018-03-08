@extends('avored-ecommerce::admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    Order Configuration List
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.configuration.store') }}">

                        {{ csrf_field() }}

                        @include('avored-ecommerce::forms.select',['name' => 'avored_order_default_first_status',
                                                                'label' => 'Default First Order Status(e.g: Pending)',
                                                                'options' => $orderStatusOption])

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" >Save Configuration</button>
                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

