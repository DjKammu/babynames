<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>500 Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>
  <div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">500</span>
                <div class="mb-4 lead">Oops! Something went wrong.</div>
                <a href="{{ url('/')}}" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
body {
background: #dedede;
}
.page-wrap {
min-height: 100vh;
}

</style>
</body>

</html>
