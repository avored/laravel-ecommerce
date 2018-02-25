@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="h1">Configuration</div>

            <form method="post" action="{{ route('admin.configuration.store') }}" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div id="configuration-list" class="mb-3" role="tablist">
                    <div class="card mb-3">
                        <a data-toggle="collapse" href="#general-config">
                            <div class="card-header" role="tab" id="general-header">
                                <h5 class="mb-0">
                                    General
                                </h5>
                            </div>
                        </a>

                        <div id="general-config" class="collapse show" role="tabpanel" data-parent="#configuration-list">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="general_site_title">Default Site Title</label>
                                    <input type="text" class="form-control" id="general_site_title"
                                           name="general_site_title" value="{{ $model->general_site_title }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="general_site_description">Default Site description</label>
                                <textarea class="form-control"
                                          id="general_site_description"
                                          name="general_site_description">{{ $model->general_site_description }}</textarea>

                                </div>

                                @include('mage2-ecommerce::forms.select',['name' => 'general_term_condition_page',
                                                                            'label' => 'Term & Condition Page',
                                                                            'options' => $pageOptions])
                                @include('mage2-ecommerce::forms.select',['name' => 'general_home_page',
                                                                           'label' => 'Home Page',
                                                                           'options' => $pageOptions])

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <a class="collapsed" data-toggle="collapse" href="#user-config">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    Users
                                </h5>
                            </div>
                        </a>

                        <div id="user-config" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                             data-parent="#configuration-list">
                            <div class="card-body">
                                @include('mage2-ecommerce::forms.select',['name' => 'mage2_address_default_country',
                                                                           'label' => 'User Address Default Country',
                                                                           'options' => $countryOptions])

                                @include('mage2-ecommerce::forms.select',['name' => 'mage2_user_activation_required',
                                                                           'label' => 'User Activation Required',
                                                                           'options' => [0 => 'No',1 => 'Yes']])

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <a class="collapsed" data-toggle="collapse" href="#order-config" aria-expanded="false"
                           aria-controls="collapseThree">
                            <div class="card-header" role="tab" id="headingThree">
                                <h5 class="mb-0">

                                    Tax

                                </h5>
                            </div>
                        </a>

                        <div id="order-config" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                             data-parent="#configuration-list">
                            <div class="card-body">

                                @include('mage2-ecommerce::forms.select',['name' => 'mage2_tax_class_default_country_for_tax_calculation',
                                                                           'label' => 'Default Country for Tax Calculation',
                                                                           'options' => $countryOptions])

                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>
@endsection