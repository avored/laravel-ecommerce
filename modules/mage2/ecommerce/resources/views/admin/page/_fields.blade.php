


@include('mage2-ecommerce::forms.text',['name' => 'name','label' => 'Name'])
@include('mage2-ecommerce::forms.text',['name' => 'slug','label' => 'Slug'])

@include('mage2-ecommerce::forms.textarea',['name' => 'content',
                                            'label' => 'Content',
                                            'attributes' => ['class' => 'ckeditor','id' => 'content']])

@include('mage2-ecommerce::forms.text',['name' => 'meta_title','label' => 'Meta Title'])
@include('mage2-ecommerce::forms.text',['name' => 'meta_description','label' => 'Meta Description'])
