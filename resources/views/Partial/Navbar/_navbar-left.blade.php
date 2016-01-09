<ul class="nav navbar-nav navbar-left">
    <li class="dropdown menu-merge hidden-xs">

        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-plus"></i> Actions Rapides
            <span class="caret caret-tp"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('movies_create') }}">Créer un film</a>
            </li>
            <li><a href="{{ route('categories_create') }}">Créer une catégorie</a></li>
            <li><a href="{{ route('actors_create') }}">Créer un acteur</a></li>
            <li><a href="{{ route('directors_create') }}">Créer un réalisteur</a></li>
        </ul>

    </li>
    <li class="hidden-xs">
        <a class="request-fullscreen toggle-active" href="#">
            <span class="ad ad-screen-full fs18"></span>
        </a>
    </li>
</ul>
