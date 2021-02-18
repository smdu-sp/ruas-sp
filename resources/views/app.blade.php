<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Projeto Ruas SP: Pré-cadastro de bares e restaurantes para atendimento ao público em ruas e calçadas.
        O Projeto Ruas SP prevê que estabelecimentos ocupem, com mesas e cadeiras, a faixa de rua destinada a vagas de estacionamento regulamentado.">
    <title>Pré-Cadastro: Projeto Ruas SP</title>
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=env('APP_GTAG')?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?=env('APP_GTAG')?>');
    </script>
</head>
<body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>