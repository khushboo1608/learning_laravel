<li class="nav-item {{ Request::is('articles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('articles.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Articles</span>
    </a>
</li>
<li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('posts.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Posts</span>
    </a>
</li>
<li class="nav-item {{ Request::is('news*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('news.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>News</span>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('banners*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('banners.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Banners</span>
    </a>
</li>
