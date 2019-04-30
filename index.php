<!-- Criar CSS da página -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>CEP</title>
</head>
<body>
<form method="post">
<input type="text" name="cep" placeholder="CEP" id="cep"><br>
<input type="text" name="logradouro" placeholder="Logradouro" id="logradouro"><br>
<input type="text" name="complemento" placeholder="Complemento" id="complemento"><br>
<input type="text" name="bairro" placeholder="Bairro" id="bairro"><br>
<input type="text" name="localidade" placeholder="Localidade" id="localidade"><br>
<input type="text" name="uf" placeholder="UF" id="uf"><br>
<input type="text" name="unidade" placeholder="Unidade" id="unidade"><br>
<button type="button" id="botao">Enviar</button>
</form>
</body>

<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
</html>