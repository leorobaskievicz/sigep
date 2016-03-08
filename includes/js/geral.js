$(document).on("ready", function () {
	// Configura a barra de loader
	NProgress.configure({ showSpinner: true });
	NProgress.start();// Inicia barra de progresso

	$('#nprogress .bar').css({'background': '#FFF'});
	$('#nprogress .peg').css({'box-shadow': '0 0 10px #FFF, 0 0 5px #FFF'});
	$('#nprogress .spinner-icon').css({'border-top-color': '#fff', 'border-left-color': '#fff'});
	
	// Funcao para corrigir tamanho da tela modal de acordo com monitor
	$('#myModal').on('show.bs.modal', function () {
		$('.modal .modal-body').css('overflow-y', 'auto'); 
		$('.modal .modal-body').css('height', $(window).height() * 0.7);
	});
	
	// TRATA DO VALOR DO CAMPO DE PESQUISA DO SITE
	$('[name=search]').on("keyup", function () {
		var valor = $(this).val();
		if (valor != "")
			$('.sugestao-produtos').collapse("show");
		else
			$('.sugestao-produtos').collapse("hide");
	});

	$('[name=search]').on("blur", function () {
		$('.sugestao-produtos').collapse("hide");
	});

	$('[name=search]').on("focus", function () {
		if ($(this).val() != "")
			$('.sugestao-produtos').collapse("show");
	});

	NProgress.done();// Encerre barra de progresso
});

/*
	FUNÇÃO PARA RETIRAR TODOS OS ESPAÇOS DESENCESSÁRIOS DE UMA STRING
	@param string
	@return string (sem espaços)
*/

function trim(str) { return str.replace(/^\s+|\s+$/g,""); }