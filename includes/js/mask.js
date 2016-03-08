$(document).on("ready", function () {
	// Configura mascára nos campos necessários
	$("[name=cpf]").mask("999.999.999-99");
	$("[name=nascimento]").mask("99/99/9999");
	$("[name=tel]").mask("(99) 9999-9999?9");
	$("[name=cel]").mask("(99) 9999-9999?9");
	$("[name=cep]").mask("99.999-999");
	$("[name=cepent]").mask("99.999-999");
});