@extends('avored-ecommerce::layouts.app')

@section('content')
<div id="admin-category-edit-page">
    <div class="row">
        <div class="col-12">
            <div class="h1 mt-1">Edit Category</div>

            <form action="{{ route('admin.category.update', $model->id) }}" method="post">
                <div class="card mt-3 mb-3">
                    <div class="card-header">Basic Details</div>
                    <div class="card-body">

                        @csrf()
                        <input type="hidden" name="_method" value="put">
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

                <button type="submit"  class="btn category-save-button">Edit Category</button>

                <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-category-edit-page',
        data : {
            category: {!! $model !!},
        },
        methods: {
            changeModelValue: function(val,fieldName) {
                this.category[fieldName] = val;
            }
        }
    });

</script>


@endpush