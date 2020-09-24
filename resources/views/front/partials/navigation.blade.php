<div class="nav-box">
    <nav class="menu">
        <ul class="navigation">
            @foreach($categories as $category)
                <li>
                    <a href="">{{ $category->{localeAppColumn('name')} }}:</a>
                    @if($category->availableSubCategories)
                        <ul class="submenu">
                            @foreach($category->availableSubCategories as $subCategory)
                                <li><a href="">{{ $subCategory->{localeAppColumn('name')} }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</div>
