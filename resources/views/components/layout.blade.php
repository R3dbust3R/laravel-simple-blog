<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="http://127.0.0.1:8000/style.css">
    <title>{{ $page }}</title>
</head>
<body>
    <x-styles></x-styles>
    <x-navbar></x-navbar>
    

    {{ $slot }}


    <footer class="footer bg-dark text-light mt-4 py-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-6">
                    Laravel 11, Demo Web Application
                </div>
                <div class="col-6">
                    Copyright &copy; {{ date('Y') }}
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <x-script></x-script>
</body>
</html>