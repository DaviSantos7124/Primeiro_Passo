<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada - Primeiro Passo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #002546;
            color: #fff;
            font-family: "Inter", sans-serif;
            text-align: center;
            padding: 20px
        }

        h1 {
            font-size: 5rem;
            margin: 0;
            color: #1A80D5
        }

        p {
            opacity: .85;
            max-width: 420px
        }

        a {
            display: inline-block;
            margin-top: 16px;
            background: #1A80D5;
            color: #fff;
            padding: 10px 22px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600
        }
    </style>
</head>

<body>
    <i class="bi bi-compass" style="font-size:48px"></i>
    <h1>404</h1>
    <h2>Página não encontrada</h2>
    <p>O endereço que você tentou acessar não existe ou foi movido.</p>
    <a href="dashboard.php">Voltar para o início</a>
</body>

</html>