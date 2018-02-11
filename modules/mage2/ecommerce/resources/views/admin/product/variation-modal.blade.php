<div class="modal"
id="variation-modal-{{ $model->id }}"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{ route('admin.product.update', $model->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="product_id" value="{{ $model->id }}">
            <div class="modal-header">
                <h5 class="modal-title">Product Variation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="variation-name-{{ $model->id }}">Name</label>
                    <input type="text" value="{{ $model->name }}"
                           id="variation-name-{{ $model->id }}"
                           class="form-control" name="name" />
                </div>

                <div class="form-group">
                    <label for="variation-sku-{{ $model->id }}">SKU</label>
                    <input type="text" value="{{ $model->sku }}"
                           id="variation-sku-{{ $model->id }}"
                           class="form-control" name="sku" />
                </div>


                <div class="form-group">
                    <label for="variation-price-{{ $model->id }}">Price</label>
                    <input type="text" value="{{ $model->price }}"
                           id="variation-price-{{ $model->id }}"
                           class="form-control" name="price" />
                </div>

                <div class="form-group">
                    <label for="variation-qty-{{ $model->id }}">Qty</label>
                    <input type="text" value="{{ $model->qty }}"
                           id="variation-qty-{{ $model->id }}"
                           class="form-control" name="qty" />
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary save-variation-button">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
