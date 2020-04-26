
<nav class="topnav">

    <div class="item">
        <a href="/">My Weather</a>
    </div>
    <div class="item">
        <a href="/tokens">Tokens</a>
    </div>

    @auth
        <div class="item pull-right">
            <a href="/logout">Logout</a>
        </div>
    @endauth
</nav>

