<header class="page-header  header-h1 " style="margin-top: -20px">
    <div class="container">
        <h1>@yield('page-title')</h1>
        <ul class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <li class="home"><span property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" title="Go to Home." href="{{route('home')}}" class="home"><span property="name">Home</span></a>
                    <meta property="position" content="1">
                    </span>
            </li>
            <li class="post post-page current-item"><span property="itemListElement" typeof="ListItem"><span
                        property="name">@yield('page-sub_title')</span>
                    <meta property="position" content="2">
                    </span>
            </li>
        </ul>
    </div>
</header>
