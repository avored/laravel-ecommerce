<li class="dropdown">
    <?php $categoryName = isset($category->name) ? $category->name : $category[0]->name; ?>
    <?php $categorySlug = isset($category->slug) ? $category->slug : $category[0]->slug; ?>
    <a href="{{ route('category.view', $categorySlug) }}" >
        {{ $categoryName }}
    </a>

	@if (count($category['child']) > 0)
	    <ul class="dropdown-menu">
	    @foreach($category['child'] as $category)
	        @include('front.includes.category', $category)
	    @endforeach
	    </ul>
	@endif
</li>        