<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dynamic Form') | Dynamic Form</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.css">
    <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar-fixed.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">[ FORM BUILDER ]</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item"> <a class="nav-link active" aria-current="page"
                            href="{{ route('dashboard') }}">Dashboard</a> </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">Forms</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('forms.list') }}">List All</a></li>
                            <li><a class="dropdown-item" href="{{ route('forms.create') }}">New Form</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('forms.submissions-list') }}">Form
                            Submissions</a> </li>
                </ul>
                <a class="btn btn-secondary" type="submit">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    @yield('scripts')
</body>

</html>