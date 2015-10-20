<?php 
/** Not Sure Why Facade is not working??   */
use Mage2\Admin\Helpers\AttributeHelper;
?>
<div class="tab-content">
    <div class="tab-pane fade in active" id="tab1">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    {!!  Form::label('name', 'Name')  !!}
                    {!!  Form::text('name',null,array('class'=>'form-control', 'autofocus' => true))  !!}
                </div>

                <div class="form-group">
                    {!!  Form::label('slug', 'Slug')  !!}
                    {!!  Form::text('slug',null,array('class'=>'form-control', 'disabled' => true))  !!}
                </div>

                <div class="form-group">
                    {!!  Form::label('sku', 'Sku')  !!}
                    {!!  Form::text('sku',null,array('class'=>'form-control'))  !!}
                </div>

                <div class="form-group">
                    {!!  Form::label('brief_description', 'Brief Description')  !!}
                    {!!  Form::text('brief_description',null,array('class'=>'form-control'))  !!}
                </div>

                <div class="form-group">
                    {!!  Form::label('description', 'Description')  !!}
                    {!!  Form::textarea('description',null,array('class'=>'form-control'))  !!}
                </div>


                <?php
                $productCategory = (isset($productCategory)) ? $productCategory : [];
                ?>
                <div class="form-group">
                    {!!  Form::label('categories', 'Category')  !!}
                    {!!  Form::select('categories',$categories,$productCategory,array('class'=>'form-control select2','multiple'=>'multiple','name'=>'categories[]'))  !!}
                </div>
                <div class="form-group image_list">
                    <label>Product Images </label>

                    @if (isset($product))
                        @foreach($product->images()->get() as $productImage)
                            <div class="upload_image_preview col-md-2">
                                <a href="" class="glyphicon glyphicon-remove product_image_delete pull-right">&nbsp;</a>
                                <img class="img-responsive" width="200" src="{{ $productImage->path }}"/>
                                <input type="hidden" name="productImage[{{ $productImage->id }}]"
                                       value="{{ $productImage->path}}"/>
                            </div>
                        @endforeach
                    @endif

                    <div class='image_file col-md-2'> 
                        <div data-token="{{ csrf_token() }}" class='btn btn-default btn-file image glyphicon glyphicon-camera'>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    {!!  Form::label('qty', 'Qty')  !!}
                    {!!  Form::text('qty',null,array('class'=>'form-control'))  !!}
                </div>

                <?php
                $productPrice = (isset($productPrice)) ? $productPrice : 0;
                ?>
                <div class="form-group">
                    {!!  Form::label('price', 'Price')  !!}
                    {!!  Form::text('price',$productPrice,array('class'=>'form-control'))  !!}
                </div>

                <div class="form-group">
                    {!! Form::label('manage_stock', 'Manage Stock') !!}
                    {!!  Form::select('manage_stock',[1 => 'Yes', 0 => 'No'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('low_stock_notification', 'Low Stock Notification') !!}
                    {!!  Form::select('low_stock_notification',[0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control']) !!}
                </div>


                <?php
                    /**
                $id = (isset($product->id) ? $product->id : null );
                foreach($entity->attributes()->get() as $attribute)
                    !! AttributeHelper::renderProductAttribute($attribute, $id) !!}
                endforeach
                */
                ?>

            </div>
        </div>
    </div> 
    <div class="tab-pane fade" id="tab2">
        Tab 2 content
    </div>
    <div class="tab-pane fade" id="tab3">
        Tab 3 content
    </div>
</div>