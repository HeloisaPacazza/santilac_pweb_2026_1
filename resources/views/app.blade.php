<!DOCTYPE html>
<html>
<head>
    <title>Santilac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Santilac</a>

        <div>
            <a class="btn btn-light" href="/produtos">Produtos</a>
            <a class="btn btn-light" href="/funcionarios">Funcionários</a>
            <a class="btn btn-light" href="/vendas">Vendas</a>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>