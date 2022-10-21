<nav class="navbar navbar-expand-lg" id="navbar">
    <a href="#"><img id="szakilogo" src="{{ URL::to('/szakilogo.jpg') }}" alt="szakilogo"></a>
    <a class="navbar-brand" href="#">{{ __('SzakemberKereső') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-link" href="#">{{ __('Szakember Hozzáadás') }}</a>
            </li>
            <li class="nav-item">
                <a class="navbar-link" href="#">{{ __('Szakember Lista') }}</a>
            </li>
            <li class="nav-item">
                <a class="navbar-link" href="#">{{ __('Belépés') }}</a>
            </li>
            <li class="nav-item">
                <a class="navbar-link" href="#">{{ __('Regisztráció') }} </a>
            </li>
        </ul>
    </div>
</nav>
