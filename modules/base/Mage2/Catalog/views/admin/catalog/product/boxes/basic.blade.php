 
<div class="card card-default">
    <div class="card-content">
        <div class="card-title">
            <span>Basic Info</span>
            <!--div class="card-tools right">
                <button class="btn btn-card-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div-->
        </div>
        @include('template.text',['key' => 'title','label' => 'Title'])

        @include('template.text',['key' => 'slug','label' => 'Slug'])

        @include('template.text',['key' => 'sku','label' => 'SKU'])


        <!--textarea class="" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea-->
        @include('template.textarea',['key' => 'description','label' => 'Description','attributes' => ['class' => 'bootstrap-wysywig materialize-textarea']])

        @include('template.text',['key' => 'price','label' => 'Price'])

        @include('template.select',['key' => 'status','label' => 'Status', 'options' => $statusOptions])

        @include('template.select',['key' => 'is_featured','label' => 'Is Featured', 'options' => $isFeaturedOptions])

        @include('admin.catalog.product.fields.category',['key' => 'category_id[]',
        'label' => 'Category',
        'options' => $categories
        ])

        @include('template.select2',['key' => 'website_id[]',
        'label' => 'Website',
        'options' => $websites
        ])

    </div>

</div>
<script>

    jQuery(document).ready(function () {
        function change_view() {
            alert('here');
        }
        
        //$(".bootstrap-wysywig").wysihtml5({
        //    toolbar: {
        //        custom1: true,
        //        image: false
        //    },
        //    customTemplates: {
        //        custom1: function (context) {
        //            return "<li>" +
        //                    "<a class='btn btn-default' data-wysihtml5-command='formatBlock' >hellip</a>" +
        //                    "</li>";
        //        }
        //    }
        //});
    })
</script>