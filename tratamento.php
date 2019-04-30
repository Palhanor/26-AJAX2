<?php 

// Dar um jeito de responder com apenas um clique - Em toda req=1 abrir o fopen para apagar tudo?

$req = filter_input(INPUT_GET, "req", FILTER_VALIDATE_INT);
$arquivo = "cep.txt";

switch ($req) {
	case 1:
		// Ele não reconhece o cep como interito por causa da "-", por isso precisa passar como string
		$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
		$cepFinal = str_replace("-", "", $cep);
		// Se o cep estiver com o tamanho certo fará o registro
		if (strlen($cepFinal) == 8) {
			// Cria a url e chama a API usando o cep de tamanho correto inserido pelo usuário
			$html = "https://viacep.com.br/ws/".$cepFinal."/json";
			$requestDados = file_get_contents($html);
			// Grava as informções retornadas dentro do arquivo txt
			$gravarDados = fopen($arquivo, "w+");
			if (fwrite($gravarDados, $requestDados)) {
				echo "CEP de tamanho certo. Registro deu certo";
				fclose($gravarDados);
			}
			else {
				echo "CEP de tamanho certo. Registro deu errado";
				fclose($gravarDados);
			}
		}
		// Estando com o tamanho errado o registro não é feito e qualquer informação gravada anteriormente é apagada
		else {
			$apagarDados = fopen($arquivo, "w+");
			fwrite($apagarDados, "");
			fclose($apagarDados);
			echo "CEP de tamanho errado";
		}
		break;
	
	case 2:
		// Abre o arquivo txt para verificar o que está armazenado
		$lerDados = fopen($arquivo, "r");
		// Se o banco estiver vazio é por que o registro não foi feito (cep de tamanho errado)
		if (filesize($arquivo) > 0) {
			$pegarDados = fread($lerDados, filesize($arquivo));
			// Se não houver mensagem de erro da API ele manda os parametros
			if (substr($pegarDados, 5, 4) != "erro") {
				$dadosUsuario = json_decode($pegarDados);
				// Passa os parametros para o ajax retornar
				echo $dadosUsuario->logradouro.";".$dadosUsuario->complemento.";".$dadosUsuario->bairro.";".$dadosUsuario->localidade.";".$dadosUsuario->uf.";".$dadosUsuario->unidade;
				fclose($lerDados);
			}
			// Se houver mensagem de erro ele retorna que o CPF é inválido
			else {
				echo -1;
			}
		}
		break;
}