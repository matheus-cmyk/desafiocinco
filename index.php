<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Rifas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ccc;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        input, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background: #007bff;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        .ticket {
            display: inline-block;
            width: 120px;
            height: 70px;
            border: 2px dashed #007bff;
            border-radius: 10px;
            margin: 6px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            line-height: 70px;
            background: #eaf4ff;
        }
        .print-btn {
            background: green;
            color: white;
            display: block;
            margin: 20px auto;
        }
        .game-btn {
            background: #ff6600;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            text-align: center;
            transition: 0.3s;
        }
        .game-btn:hover {
            background: #cc5200;
        }
        @media print {
            form, .print-btn, .game-btn { display: none; }
            .ticket { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🎟️ Gerador de Rifas</h1>

    <form method="POST">
        <label>Nome da Campanha:</label>
        <input type="text" name="campanha" required>

        <label>Prêmio(s):</label>
        <input type="text" name="premio" required>

        <label>Valor por bilhete (R$):</label>
        <input type="number" name="valor" step="0.01" required>

        <label>Quantidade de bilhetes:</label>
        <input type="number" name="quantidade" min="1" required>

        <button type="submit">Gerar Rifas</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $campanha = $_POST["campanha"];
        $premio = $_POST["premio"];
        $valor = $_POST["valor"];
        $quantidade = $_POST["quantidade"];

        echo "<h2>Campanha: $campanha</h2>";
        echo "<p><strong>Prêmio:</strong> $premio</p>";
        echo "<p><strong>Valor do Bilhete:</strong> R$ " . number_format($valor, 2, ',', '.') . "</p>";
        echo "<h3>Lista de Bilhetes Gerados:</h3>";

        for ($i = 1; $i <= $quantidade; $i++) {
            $numero = str_pad($i, 3, "0", STR_PAD_LEFT);
            echo "<div class='ticket'>$numero</div>";
        }

        echo "<button class='print-btn' onclick='window.print()'>🖨️ Imprimir Bilhetes</button>";
    }
    ?>

    <hr style="margin: 30px 0;">
    <div style="text-align:center;">
        <p>Quer se divertir enquanto imprime suas rifas?</p>
        <a class="game-btn" href="jogojokenpo.php">🎮 Jogar Jokempô</a>
    </div>
</div>
</body>
</html>
