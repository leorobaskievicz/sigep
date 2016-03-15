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

	/*
		CHAMA FUNCAO PARA BOTAO AVISA-ME QUANDO CHEGAR
		EXIBE FORMULARIO NA JANELA MODAL
	*/

	$("#avisaMeQuandoChegar").on("click", function (event) {
		event.preventDefault();

		var codigo = $(this).attr("data-codigo");
		var produto = $(this).attr("data-produto");
		var preco = $(this).attr("data-preco");

		$("[name=codigo-avisamequandochegar]").val(codigo);
		$("[name=produto-avisamequandochegar]").val(produto);
		$("[name=preco-avisamequandochegar]").val(preco);

		$("#myModal").modal();
	});

	/*
		FUNÇÃO PARA FAZER REQUISIÇÃO AJAX PARA SALVAR PRODUTO NO CARRINHO
	*/

	$('.addCarrinho').on('click', function (event) {
		event.preventDefault();

		var codigo = $(this).attr('data-codigo');
		var nome   = $(this).attr('data-nome');
		var qtd    = $(this).attr('data-qtd');
		var preco  = $(this).attr('data-codigo');

		var boxProduto = $(this).parent('p').parent('div').parent('div');
		
		$.ajax({
			url: "/Carrinho/salvar",
			dataType: 'html',
			type: "GET",
			data: {
				codigo: codigo,
				nome: nome,
				qtd: qtd,
				preco: preco,
			},
			beforeSend: function () {
				$(this).html('Salvando').attr("disabled","disabled");
			},
			complete: function () {
				$(this).html('<span class="glyphicon glyphicon-shopping-cart"> </span> Comprar').removeAttr('disabled');
			},
			success: function(data) {
				if (data != "false") {
					// FAZ ANIMAÇÃO DA FOTO DO PRODUTO PARA ENVIAR PARA A CESTA
					var classImg = boxProduto.find("img").clone().prependTo(boxProduto);// Produra pela tag img
			        // Abaixo seleciona a imagem dentro do div.foto2 duplicado
					var img  = classImg;// Seleciona a foto dentro da classe encontrada acima
			        var imgWidth = img.width();// Pega tamanho da foto original para copiar
			        var imgHeight = img.height();// Pega tamanho da foto origanl para copiar
			        var yCarrinho = $(".minha-cesta-menu").last().offset().left + 23;
			        var xCarrinho = $(".minha-cesta-menu").last().offset().top + 17;
					var y = img.offset().left;
					var x = img.offset().top;
					// Faz animação da imagem como se estivesse colocando produto na cesta
			        $("body").prepend(img);
			        img.css({
			            width: imgWidth,
			            height: imgHeight,
			            position: "absolute",
			            zIndex: 50,
			            left: y,
			            top: x
			        });
					img.animate({
						left: yCarrinho,
						top: xCarrinho
					}, 300, function() {
						img.animate({
							height: "10px",
							width: "10px"
						}, 300, function () {
							img.fadeOut("fast");
						});
					}); 

					// CORRIGE QTD MINHA CESTA MENU
					$.ajax({
						url: "/Carrinho/totalItens",
						dataType: 'html',
						success: function(data) { 
							$('.minha-cesta-menu > a').text(data+" itens");
						}
					});

					// CORRIGE VALOR TOTAL MINHA CESTA MENU
					$.ajax({
						url: "/Carrinho/total",
						dataType: 'html',
						success: function(data) { 
							$('.minha-cesta-menu > ul > li > footer').text("R$ "+number_format(data,2,",",""));
						}
					});

					// Recarrega minha cesta menu iframe para atualiza listagem de produtos
					$('.minha-cesta-menu > ul > li > article > iframe').attr("src","/MeuCarrinho/minhaCesta");
				}
			},
			error: function (xhr,er) {
				//alert('Erro '+xhr.status+' - '+xhr.statusText+' Tipo do erro : '+er);
			}
		});
	});

	/*
		FUNÇÃO PARA DELETAR PRODUTO DO CARRINHO
	*/

	$('.removeCarrinho').on("click", function (event) {	
		event.preventDefault();

		var codigo = $(this).attr('data-rowid');
		var link = $(this).attr('data-page');
		
		$.ajax({
			url: "/Carrinho/editar",
			dataType: 'html',
			type: "GET",
			data: {
				rowid: codigo,
				qtd: 0
			},
			beforeSend: function () {
				$(this).html('Apagando').attr("disabled","disabled");
			},
			complete: function () {
				$(this).html('<span class="glyphicon glyphicon-trash"> </span> Apagar').removeAttr('disabled');
			},
			success: function(data) { 
				location.href = link;
			},
			error: function (xhr,er) {
				//alert('Erro '+xhr.status+' - '+xhr.statusText+' Tipo do erro : '+er);
			}
		});
	});

});

/*
	FUNÇÃO PARA RETIRAR TODOS OS ESPAÇOS DESENCESSÁRIOS DE UMA STRING
	@param string
	@return string (sem espaços)
*/

function trim(str) { return str.replace(/^\s+|\s+$/g,""); }

/*
	FUNÇÃO PARA FORMATAR STRING DE VALOR NO FORMATO DE MOEDA (IGUAL AO PHP)
	@param float valor - Ex.: 4.40
	@return string valor - E.: 4,40
*/

function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

/*
	FUNÇÃO RECEBE JSON OBJECT E CONVERTE PARA SITRING
*/

function jsonToString (json)
{
	return JSON.stringify(json).replace(',', ', ').replace('[', '').replace(']', '');
}