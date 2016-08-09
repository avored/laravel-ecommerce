<?php foreach ($categories as $category): ?>

    <?php $childCategories = $category['children']; ?>
    <?php $class = (count($childCategories) > 0) ? "dropdown-submenu" : ""; ?>
    <li <?php echo "class='" . $class . "'"; ?>>
        <a href="{{route ('category.view', $category['object']->id)}}" class="dropdown-toggle" data-toggle="dropdown" title="Test">{{ $category['object']->name }}</a>
        <?php while (true): ?>

            <?php if ($category['object'] == NULL): ?>
                <?php break ?>
            <?php endif; ?>

            <?php
            $id = $category['object']->id;
            $name = $category['object']->name;
            $category['object'] = NULL;
            ?>
            <?php if (count($childCategories) > 0): ?>
                <ul class="dropdown-menu multi-level">
                    <li><a href="{{route ('category.view', $id)}}">ALL {{ $name }}</a></li>
                    @include('layouts.category-tree',['categories' => $childCategories])
                </ul>
            <?php endif; ?>
        <?php endwhile; ?>
    </li>
<?php endforeach; ?>