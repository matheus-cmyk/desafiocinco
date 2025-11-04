<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo do Jokempô</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            text-align: center;
            padding: 40px;
        }
        h1 { color: #333; }
        form { margin: 20px auto; }
        button {
            padding: 15px 25px;
            margin: 10px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #007bff;
            color: white;
            transition: 0.3s;
        }
        button:hover { background: #0056b3; }
        .resultado {
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            margin: 20px auto;
            box-shadow: 0 0 10px #ccc;
        }
        img { width: 100px; }
        .back-btn {
            background: #28a745;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
        }
        .back-btn:hover {
            background: #1e7e34;
        }
    </style>
</head>
<body>
    <h1>🪨📄✂️ Jogo do Jokempô</h1>
    <form method="POST">
        <button type="submit" name="jogador" value="1">🪨 Pedra</button>
        <button type="submit" name="jogador" value="2">📄 Papel</button>
        <button type="submit" name="jogador" value="3">✂️ Tesoura</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["jogador"])) {
        $jogador = (int) $_POST["jogador"];
        $computador = rand(1, 3);

        $opcoes = [
            1 => ["nome" => "Pedra", "gif" => "https://media.giphy.com/media/l1J9EdzfOSgfyueLm/giphy.gif"],
            2 => ["nome" => "Papel", "gif" => "https://media.giphy.com/media/9V7uxlN5JYxAc/giphy.gif"],
            3 => ["nome" => "Tesoura", "gif" => "https://media.giphy.com/media/3o7btPCcdNniyf0ArS/giphy.gif"]
        ];

        function resultado($j, $c) {
            if ($j == $c) return "🤝 Empate!";
            if (($j == 1 && $c == 3) || ($j == 2 && $c == 1) || ($j == 3 && $c == 2))
                return "🎉 Você venceu!";
            return "💀 Você perdeu!";
        }

        echo "<div class='resultado'>";
        echo "<h3>Você escolheu: {$opcoes[$jogador]['nome']}</h3>";
        echo "<img src='{$opcoes[$jogador]['gif']}' alt='jogador'>";
        echo "<h3>Computador escolheu: {$opcoes[$computador]['nome']}</h3>";
        echo "<img src='{$opcoes[$computador]['gif']}' alt='computador'>";
        echo "<h2>" . resultado($jogador, $computador) . "</h2>";
        echo "<form method='POST'><button type='submit'>🔁 Jogar novamente</button></form>";
        echo "<a href='index.php' class='back-btn'>⬅️ Voltar ao Gerador de Rifas</a>";
        echo "</div>";
    } else {
        echo "<p>Escolha uma opção para jogar!</p>";
    }
    ?>
</body>
</html>
