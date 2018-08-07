

@include('avored-framework::forms.text',['name' => 'name','label' => __('avored-banner::banner.name')])




@include('avored-framework::forms.file',['name' => 'image','label' => __('avored-banner::banner.image-path')])
@include('avored-framework::forms.text',['name' => 'alt_text','label' => __('avored-banner::banner.atl-text')])


@include('avored-framework::forms.text',['name' => 'url','label' => __('avored-banner::banner.url')])

@include('avored-framework::forms.select',['name' => 'target',
                                            'label' => __('avored-banner::banner.target'),
                                            'options' => ['' => 'Normal Link','_target' => 'New Window']
                                        ])


@include('avored-framework::forms.select',['name' => 'status',
                                            'label' => __('avored-banner::banner.status'),
                                            'options' => ['ENABLED' => 'Enabled','DISABLED' => 'Disabled']])

@include('avored-framework::forms.text',['name' => 'sort_order','label' => __('avored-banner::banner.sort-order')])