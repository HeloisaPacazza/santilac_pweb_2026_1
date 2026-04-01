<!DOCTYPE html>
<html>
<head>
    <title>Santilac</title>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand">Santilac</a>

        <div>
            <a href="/welcome" class="btn btn-light">Home</a>
            <a href="/produtos" class="btn btn-outline-light">Produtos</a>
            <a href="/funcionarios" class="btn btn-outline-light">Funcionários</a>
            <a href="/vendas" class="btn btn-outline-light">Vendas</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>