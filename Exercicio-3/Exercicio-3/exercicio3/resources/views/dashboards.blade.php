<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>Lista de jogadores</title>
</head>
<body>
    <h1 class="m-10"> {{ $titulo }}</h1>

    <table class="m-5">
        <tr class="text-blue-500">
            <th>Nome</th>
            <th>Pontuação</th>
        </tr>
        @foreach($jogadores as $nome => $pontos)
            <tr class="gap-5 flex">
                <td> {{ $nome }} </td> 
                <td> {{ $pontos }} </td>
            </tr>
        @endforeach
    </table>
</body>
</html>