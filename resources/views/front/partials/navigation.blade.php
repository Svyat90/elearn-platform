<div class="nav-box">
    <nav class="menu">
        <ul class="navigation">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->id) }}">{{ $category->{localeAppColumn('name')} }}:</a>
                    @if($category->availableSubCategories)
                        <ul class="submenu">
                            @foreach($category->availableSubCategories as $subCategory)
                                <li><a href="{{ route('sub-categories.show', $subCategory->id) }}">{{ $subCategory->{localeAppColumn('name')} }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</div>
