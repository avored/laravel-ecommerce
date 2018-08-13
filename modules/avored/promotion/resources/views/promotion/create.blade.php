@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
        <div class="h1"> {{ __('avored-promotion::promotion.promotion-create') }}</div>
        <form action="{{ route('admin.promotion.store') }}" enctype="multipart/form-data" method="post">
            @csrf


            <div class="row" id="promotion-save-accordion" data-children=".promotion-card">
                <div class="col-12">
                    <div class="card promotion-card  mb-2 mt-2">
                        <a data-toggle="collapse" data-parent="#promotion-save-accordion"
                           class="float-right" href="#basic">
                            <div class="card-header">
                                Basic Details
                            </div>
                        </a>
                        <div class="card-body collapse show" id="basic">
                            @include('avored-promotion::promotion._fields')
                        </div>
                    </div>

                    <div class="card promotion-card mb-2 mt-2">
                        <a data-toggle="collapse" data-parent="#promotion-save-accordion"
                           class="float-right" href="#rules">
                            <div class="card-header">
                                Rules
                            </div>
                        </a>
                        <div class="card-body collapse" id="rules">
                            @include('avored-promotion::promotion._rules')
                        </div>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            {{ __('avored-promotion::promotion.promotion-update') }}
                        </button>
                        <a href="{{ route('admin.promotion.index') }}" class="btn">
                            {{ __('avored-framework::lang.cancel') }}
                        </a>
                    </div>


                </div>
            </div>
        </form>
        </div>
    </div>
@endsection