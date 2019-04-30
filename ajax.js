$("#cep").focusout(function() {
		var obj = {
			cep: $("#cep").val()
		};

		$.ajax({
			url: "tratamento.php?req=1",
			type: "POST",
			dataType: "TEXT",
			data: obj,
			success: function(data) {
				console.log(data);
			}
		});

		$.ajax({
			url: "tratamento.php?req=2",
			type: "GET",
			dataType: "TEXT",
			data: {},
			success: function(data) {
				console.log(data);
				if (data != -1) {
					var resposta = data.split(";");
					$('#logradouro').val(resposta[0]);
					$('#complemento').val(resposta[1]);
					$('#bairro').val(resposta[2]);
					$('#localidade').val(resposta[3]);
					$('#uf').val(resposta[4]);
					$('#unidade').val(resposta[5]);
				}
				else {
					$('#logradouro').val("");
					$('#complemento').val("");
					$('#bairro').val("");
					$('#localidade').val("");
					$('#uf').val("");
					$('#unidade').val("");
				}
			}
		});
	});