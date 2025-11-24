<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        :root{
        --c-ink-900:#0A1128; /* fundo escuro */
        --c-ink-800:#001F54; /* topo/footer */
        --c-ink-700:#034078; /* superfícies */
        --c-accent:#1282A2;  /* destaque */
        --c-paper:#FEFCFB;   /* texto/superfície clara */
        }


        body {
            background-color: var(--c-ink-900);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: white;
            max-width: 600px;
            margin: 40px auto;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            color: #333;
        }

        .email-container p {
            font-size: 16px;
            margin-bottom: 20px;
            color: var(--c-paper);
        }

    </style>
</head>
<body>
    <div class="email-container">
        <p>
            Bom dia!

            Segue em anexo os relatórios diários de compras.
        </p>
    </div>
</body>
</html>