
@include('mage2-ecommerce::forms.text',['name' => 'name' ,'label' => 'Role Name'])

@include('mage2-ecommerce::forms.textarea',['name' => 'description' ,'label' => 'Role Description'])


<div class="row">

    @foreach(Permission::all() as $key => $permissionGroup)


        <?php
        //dd($permissionGroup);
        ?>
        @if($permissionGroup->permissionList->count() > 0)
            <div class="col-md-3">
                <div class="card permission-card card-default">
                    <div class="card-header">

                        <div class="form-check">

                            <input type="checkbox"
                                   class="form-check-input"
                                   name="permissions-all"
                                   value='1'/>
                            <label class="form-check-label">
                                {{ $permissionGroup->label() }}
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($permissionGroup->permissionList as $permission)


                            <div class="form-check">

                                    @if(isset($model) && $model->hasPermission($permission->routes()))
                                    <input type="checkbox" checked
                                           class="permission-checkbox form-check-input"
                                           name="permissions[{{ $permission->routes() }}]"
                                           value='1'/>
                                    @else
                                        <input type="checkbox"
                                               class="permission-checkbox form-check-input"
                                               name="permissions[{{ $permission->routes() }}]"
                                               value='1'/>
                                    @endif
                                        <label class="form-check-label">    {{ $permission->label() }}
                                </label>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

@push('scripts')
<script>
    $(function () {
        jQuery('.permission-card').each(function (i,el) {
            var checkedFlag = true;
            jQuery(el).find('.permission-checkbox').each(function (i,checkbox) {

                if(!jQuery(checkbox).is(':checked')) {
                    console.info(checkedFlag);
                    checkedFlag = false;
                }
            });
            if(true === checkedFlag) {
                jQuery(el).find('.group-checkbox').prop('checked',true)
            }
        });

        jQuery('.group-checkbox').on('change',function(e){
            //e.preventDefault();
            //e.stopPropagation();

            console.info(jQuery(this).is(':checked'));
            if(jQuery(this).is(':checked')) {
                jQuery(this).parents('.permission-card:first').find('.permission-checkbox').each(function(i,el){
                        jQuery(el).prop('checked',true);
                });
            }
            if(!jQuery(this).is(':checked')) {
                jQuery(this).parents('.permission-card:first').find('.permission-checkbox').each(function(i,el){
                    jQuery(el).prop('checked',false);
                });
            }

        })



    });

</script>
@endpush