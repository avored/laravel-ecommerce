@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        Edit Review
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('admin.review.update', $model->id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">

                            @include('mage2-ecommerce::forms.text',['name' => 'user_full_name','label' => 'User Full Name', 'attributes' => ['class' => 'form-control','id' =>'user_full_name','disabled' => true]])
                            @include('mage2-ecommerce::forms.text',['name' => 'product_title','label' => 'Product Title', 'attributes' => ['class' => 'form-control','id' =>'user_full_name','disabled' => true]])
                            @include('mage2-ecommerce::forms.text',['name' => 'star','label' => 'Star', 'attributes' => ['class' => 'form-control','id' =>'user_full_name','disabled' => true]])
                            @include('mage2-ecommerce::forms.select',['name' => 'status','label' => 'Status', 'options' => ['ENABLED' => 'Enable','DISABLED' => 'Disabled']])


                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update Review</button>
                                <a href="{{ route('admin.review.index') }}" class="btn">Cancel</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection