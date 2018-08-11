@extends('avored-framework::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-subscribe::subscribe.edit') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.subscribe.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')

                        @include('avored-subscribe::subscribe._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('avored-subscribe::subscribe.edit') }}</button>
                            <a href="{{ route('admin.subscribe.index') }}" class="btn">{{ __('avored-framework::lang.cancel') }}</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection