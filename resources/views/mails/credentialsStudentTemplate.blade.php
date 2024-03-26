<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crendênciais de acesso</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            width: 600px;
            padding: 20px;
            background-color: #424242;
            color: #FFC107;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-text {
            font-size: 16px;
            line-height: 1.6;
        }

        ol {
            margin-top: 10px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-title">
                Bem-vindo!
            </div>
            <img class="logo" src="{{ $message->embed(public_path('fit-manage-tech.svg')) }}" alt="Logo FitManage Tech"
                width="50%">
            <div class="card-text">
                <p>
                    Olá {{ $student->name }},
                </p>
                <p>
                    Seja bem-vindo ao nosso serviço! Estamos muito felizes em tê-lo conosco.
                </p>
                <p>
                    Abaixo estão suas credenciais de acesso:
                </p>
                <ul>
                    <li><strong>Email:</strong> {{ $student->email }}</li>
                    <li><strong>Senha:</strong> {{ $password }}</li>
                </ul>
                <p>
                    Por favor, siga as instruções abaixo para começar a usar nossa plataforma:
                </p>
                <ul>
                    <li>Passo 1: Faça login com suas credenciais.</li>
                    <li>Passo 2: Explore todas as funcionalidades disponíveis.</li>
                    <li>Passo 3: Entre em contato conosco se precisar de ajuda.</li>
                </ul>
                <p>
                    Aproveite sua experiência conosco!
                </p>
            </div>
        </div>
    </div>
</body>

</html>
