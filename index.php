<?php
$resultado = null;
$mensagem = "";
$classeMensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valorCompra = isset($_POST["valor_compra"]) ? floatval($_POST["valor_compra"]) : 0;
    $cupom = isset($_POST["cupom"]) ? strtoupper(trim($_POST["cupom"])) : "";
    $desconto = 0;
    if ($valorCompra > 200 && $cupom === "COMPREMUITO") {
        $desconto = 0.15;
        $mensagem = "Cupom de 15% aplicado com sucesso!";
        $classeMensagem = "sucesso";
    } elseif ($valorCompra > 100 && $cupom === "QUERO10") {
        $desconto = 0.10;
        $mensagem = "Cupom de 10% aplicado com sucesso!";
        $classeMensagem = "sucesso";
    } else {
        $mensagem = "Cupom inválido ou valor insuficiente para desconto.";
        $classeMensagem = "erro";
    }
    $resultado = $valorCompra - ($valorCompra * $desconto);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Desconto</title>
    <link rel="stylesheet" href="desconto.css">
</head>
<body>
    <div class="container">
        <h1>Calculadora de Desconto</h1>   
        <form method="POST" action="">
            <label for="valor_compra">Valor da Compra (R$)</label>
            <input type="number" step="0.01" name="valor_compra" id="valor_compra" required>
            <label for="cupom">Cupom de Desconto</label>
            <input type="text" name="cupom" id="cupom" placeholder="Ex: QUERO10">
            <button type="submit">Calcular</button>
        </form>
        <?php if ($resultado !== null): ?>
            <div class="resultado <?php echo $classeMensagem; ?>">
                <p><?php echo $mensagem; ?></p>
                <h2>Valor Final: R$ <?php echo number_format($resultado, 2, ',', '.'); ?></h2>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>