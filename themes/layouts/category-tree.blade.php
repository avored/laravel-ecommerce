<?php foreach ($categories as $category): ?>

    <?php $childCategories = $category['children']; ?>
    <?php $class = (count($childCategories) > 0) ? "dropdown-submenu" : ""; ?>
    <?php $attributes = (count($childCategories) > 0) ? 'class="dropdown-toggle" data-toggle="dropdown"' : ""; ?>
    <li <?php echo "class='" . $class . "'"; ?>>
        <a href="{{route ('category.view', $category['object']->slug)}}"
           {{ $attributes }}
           title="{{ $category['object']->name }}">{{ $category['object']->name }}</a>
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
                <ul class="dropdown-menu multi-level">
                    <li><a href="{{route ('category.view', $slug)}}">ALL {{ $name }}</a></li>
                    @include('layouts.category-tree',['categories' => $childCategories])
                </ul>
            <?php endif; ?>
        <?php endwhile; ?>
    </li>
<?php endforeach; ?>