@extends('avored-ecommerce::layouts.app')


@section('content')
<div id="admin-category-create-page">
    <div class="row">
        <div class="col-12">

            <div class="h1 mt-1">Create Category</div>

            <form method="post" action="{{ route('admin.category.store') }}">

                <div class="card mt-3 mb-3">
                    <div class="card-header">Basic Details</div>
                    <div class="card-body">

                        @csrf()
                        @include('avored-ecommerce::category._fields')

                    </div>
                </div>

                <div class="card mt-3 mb-3">
                    <div class="card-header">SEO</div>
                    <div class="card-body">

                        @include('avored-ecommerce::forms.text',['name' => 'meta_title','label' => 'Meta Title'])
                        @include('avored-ecommerce::forms.textarea',['name' => 'meta_description','label' => 'Meta Description'])

                    </div>
                </div>

                <button type="submit"  class="btn btn-primary category-save-button">Create Category</button>

                <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>
            </form>


        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-category-create-page',
        data : {
            category: {},
        }
        methods: {
            changeModelValue: function(val,fieldName) {
                this.category[fieldName] = val;
            }
        }
    });

</script>


@endpush