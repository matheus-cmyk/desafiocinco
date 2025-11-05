<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jogo do Jokempô</title>
<style>
  /* ======== ESTILO GERAL ======== */
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ece9e6, #ffffff);
    margin: 0;
    padding: 0;
    color: #222;
    text-align: center;
  }

  .container {
    width: 90%;
    max-width: 700px;
    background: #fff;
    margin: 60px auto;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  }

  h1 {
    font-size: 2em;
    color: #000000ff;
    margin-bottom: 30px;
  }

  p {
    font-size: 16px;
    color: #555;
  }

  /* ======== BOTÕES DE JOGO ======== */
  form {
    margin: 30px 0;
  }

  button {
    background: linear-gradient(90deg, #ffffff, #000000ff);
    color: white;
    border: none;
    padding: 15px 25px;
    margin: 10px;
    font-size: 18px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
  }

  button:hover {
    transform: scale(1.05);
    background: linear-gradient(90deg, #000000ff, #ffffff);
  }

  /* ======== RESULTADO ======== */
  .resultado {
    background: #fafafa;
    border-radius: 20px;
    padding: 30px;
    width: 90%;
    max-width: 500px;
    margin: 30px auto;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  }

  .resultado h3 {
    color: #000000ff;
    margin: 10px 0;
  }

  .resultado h2 {
    color: #d4a017;
    margin-top: 20px;
  }

  img {
    width: 100px;
    margin: 10px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  /* ======== BOTÃO VOLTAR ======== */
  .back-btn {
    background: linear-gradient(90deg, #000000ff, #ffffffff);
    color: white;
    padding: 12px 25px;
    text-decoration: none;
    border-radius: 12px;
    font-weight: bold;
    display: inline-block;
    margin-top: 20px;
    transition: 0.3s;
  }

  .back-btn:hover {
    transform: scale(1.05);
    background: linear-gradient(90deg, #000000ff, #ffffffff);
  }

  /* ======== RESPONSIVO ======== */
  @media (max-width: 600px) {
    button {
      width: 100%;
      margin: 8px 0;
    }
  }
</style>
</head>
<body>
  <div class="container">
    <h1> Jogo do Jokempô</h1>
    <p>Escolha uma opção e veja quem vence!</p>

    <form method="POST">
      <button type="submit" name="jogador" value="1">🪨 Pedra</button>
      <button type="submit" name="jogador" value="2">📄 Papel</button>
      <button type="submit" name="jogador" value="3">✂️ Tesoura</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["jogador"])) {
        $jogador = (int) $_POST["jogador"];
        $computador = rand(1, 3);

        function resultado($j, $c) {
            if ($j == $c) return "🤝 Empate!";
            if (($j == 1 && $c == 3) || ($j == 2 && $c == 1) || ($j == 3 && $c == 2))
                return "🎉 Você venceu!";
            return "💀 Você perdeu!";
        }

        echo "<div class='resultado'>";
        echo "<h2>" . resultado($jogador, $computador) . "</h2>";
        echo "<form method='POST'><button type='submit'> Jogar novamente</button></form>";
        echo "<a href='index.php' class='back-btn'> Voltar ao Gerador de Rifas</a>";
        echo "</div>";
    }
    ?>
  </div>
</body>
</html>
