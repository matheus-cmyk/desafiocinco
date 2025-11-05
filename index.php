<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gerador de Rifas</title>
<style>
  /* ======== BASE GERAL ======== */
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ece9e6, #ffffff);
    margin: 0;
    padding: 0;
    color: #222;
  }

  .container {
    width: 90%;
    max-width: 950px;
    margin: 40px auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  }

  h1 {
    text-align: center;
    color: #000000ff;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 30px;
  }

  form {
    display: grid;
    gap: 15px;
    margin-bottom: 30px;
  }

  label {
    font-weight: 600;
    color: #444;
  }

  input {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 10px;
    transition: 0.3s;
  }

  input:focus {
    border-color: #000000ff;
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    outline: none;
  }

  button {
    background: linear-gradient(90deg, #ffffffff, #000000ff);
    color: white;
    border: none;
    padding: 12px;
    font-size: 17px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: 0.3s;
  }

  button:hover {
    transform: scale(1.03);
    background: linear-gradient(90deg, #000000ff, #ffffffff);
  }

  /* ======== BILHETE ESTILO PREMIUM ======== */
  .rifa {
    display: flex;
    justify-content: space-between;
    align-items: stretch;
    border-radius: 16px;
    background: #fafafa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin: 20px 0;
    overflow: hidden;
    position: relative;
  }

  .rifa::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 2px;
    background: repeating-linear-gradient(
      to bottom,
      transparent,
      transparent 8px,
      #ccc 8px,
      #ccc 12px
    );
    transform: translateX(-50%);
  }

  .lado {
    width: 50%;
    padding: 20px;
    box-sizing: border-box;
  }

  .lado h2 {
    text-align: center;
    color: #000000ff;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 10px;
  }

  .lado p {
    font-size: 14px;
    margin: 6px 0;
  }

  .valor {
    color: #d4a017;
    font-weight: bold;
  }

  .numero {
    text-align: right;
    font-size: 16px;
    font-weight: bold;
    color: #000000ff;
    margin-top: 10px;
  }

  /* ======== BOTÕES ======== */
  .print-btn {
    background: linear-gradient(90deg, #000000ff, #ffffffff);
    color: white;
    display: block;
    margin: 30px auto 10px;
    padding: 14px 30px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: 0.3s;
  }

  .print-btn:hover {
    transform: scale(1.05);
    background: linear-gradient(90deg, #000000ffrgba(157, 157, 157, 1)52);
  }

  .game-btn {
    background: linear-gradient(90deg, #000000ff, #ffffffff);
    color: white;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: 0.3s;
  }

  .game-btn:hover {
    transform: scale(1.05);
    background: linear-gradient(90deg, #000000ffrgba(119, 119, 119, 1)00);
  }

  /* ======== IMPRESSÃO ======== */
  @media print {
    form, .print-btn, .game-btn, hr {
      display: none;
    }
    body {
      background: white;
    }
    .rifa {
      box-shadow: none;
      page-break-inside: avoid;
    }
  }
</style>
</head>
<body>
<div class="container">
  <h1>Rifas 2025</h1>

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
    $campanha = htmlspecialchars($_POST["campanha"]);
    $premio = htmlspecialchars($_POST["premio"]);
    $valor = number_format($_POST["valor"], 2, ',', '.');
    $quantidade = intval($_POST["quantidade"]);

    echo "<h2 style='text-align:center;'>Campanha: $campanha</h2>";
    echo "<p style='text-align:center;'><strong>Prêmio:</strong> $premio | <span class='valor'>Valor:</span> R$ $valor</p>";

    for ($i = 1; $i <= $quantidade; $i++) {
      $numero = str_pad($i, 3, '0', STR_PAD_LEFT);
      echo "
      <div class='rifa'>
        <div class='lado'>
          <h2>BILHETE RIFA</h2>
          <p><strong>Nome:</strong> ____________________</p>
          <p><strong>Telefone:</strong> ________________</p>
          <p><strong>E-mail:</strong> __________________</p>
          <p><strong>Valor:</strong> R$ $valor</p>
          <p class='numero'>N° $numero</p>
        </div>
        <div class='lado'>
          <h2>$campanha</h2>
          <p><strong>Prêmio:</strong> $premio</p>
          <p><strong>Valor do bilhete:</strong> R$ $valor</p>
          <p><strong>Sorteio:</strong> Boa sorte!</p>
          <p class='numero'>N° $numero</p>
        </div>
      </div>";
    }

    echo "<button class='print-btn' onclick='window.print()'>Imprimir Bilhetes</button>";
  }
  ?>

  <hr style="margin: 40px 0;">
  <div style="text-align:center;">
    <p>Quer se divertir enquanto imprime suas rifas?</p>
    <a class="game-btn" href="jogojokenpo.php">Jogar Jokempô</a>
  </div>
</div>
</body>
</html>
