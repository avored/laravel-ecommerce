<?php foreach ($categories as $category): ?>

<?php $childCategories = $category['children']; ?>

<li class="nav-item {{  (count($childCategories) > 0) ? 'dropdown' : "" }}">
    <a class="nav-link dropdown-toggle"
       href="{{ route ('category.view', $category['object']->slug)}}"
       title="{{ $category['object']->name }}">
        {{ $category['object']->name }} {!! (count($childCategories) > 0) ? '<span class="caret"></span>' : '' !!}
    </a>

    <?php while (true): ?>

    <?php if ($category['object'] == NULL): ?>
                <?php break ?>
            <?php endif; ?>

    <?php
    $slug = $category['object']->slug;
    $name = $category['object']->name;
    $category['object'] = NULL;
    ?>
    <?php if (count($childCategories) > 0): ?>
    <ul class="dropdown-menu">
        @include('layouts.category-tree',['categories' => $childCategories])
    </ul>
    <?php endif; ?>
    <?php endwhile; ?>
</li>
<?php endforeach; ?>