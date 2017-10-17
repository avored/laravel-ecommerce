@extends('mage2-ecommerce::admin.layouts.app')

@section('content')


    <div class="row">

        <div class="h1">Configuration</div>

        <div class="col-12">



            <form method="post" action="{{ route('admin.configuration.store') }}" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div id="configuration-list" class="mb-3" role="tablist">
                <div class="card">
                    <a data-toggle="collapse" href="#general">
                        <div class="card-header" role="tab" id="general-header">
                            <h5 class="mb-0">
                                General
                            </h5>
                        </div>
                    </a>

                    <div id="general" class="collapse show" role="tabpanel" data-parent="#configuration-list">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="general_site_title">Default Site Title</label>
                                <input type="text" class="form-control" id="general_site_title"
                                       name="general_site_title" value="{{ $model->general_site_title }}" />
                            </div>
                            <div class="form-group">
                                <label for="general_site_description">Default Site description</label>
                                <textarea class="form-control"
                                          id="general_site_description"
                                          name="general_site_description" >{{ $model->general_site_description }}</textarea>

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
                <div class="card">
                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" >
                        <div class="card-header" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                Collapsible Group Item #2
                            </h5>
                        </div>
                    </a>

                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                         data-parent="#configuration-list">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf
                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                            eiusmod.
                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et.
                            Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                            proident. Ad vegan excepteur
                            butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                            nesciunt you probably
                            haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false"
                       aria-controls="collapseThree">
                        <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">

                                Collapsible Group Item #3

                            </h5>
                        </div>
                    </a>

                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                         data-parent="#configuration-list">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et.
                            Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                            proident.
                            Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                            aesthetic synth nesciunt
                            you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>


                <div class="form-group">
                <button class="btn btn-primary">Save </button>
                </div>

            </form>
        </div>


    </div>

@endsection