<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_SHORT_NAME') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link {{section_active('home')}}" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{section_active('students')}}" href="{{ route('students.home') }}">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{section_active('courses')}}" href="{{ route('courses.home') }}">Courses</a>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <input class="form-control ms-2" type="search" placeholder="Search" aria-label="Search">
            </form>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
