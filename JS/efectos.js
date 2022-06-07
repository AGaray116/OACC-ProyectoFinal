$(document).ready(function(){

// Scroll Elementos Menu
	var nosotros = $('#nosotros').offset().top;
	var	directorio = $('#titulo-directorio').offset().top;
	var	ubicacion = $('#Ubicacion').offset().top;

// Boton nosotros
	$('#btn-nosotros').on('click', function(e){
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 440
		}, 500);
	});

	$('#btn-directorio').on('click', function(e){
		e.preventDefault();
		$('html, body').animate({
			scrollTop: directorio - 40
		});
	});

	$('#btn-ubicacion').on('click',function(e){
        e.preventDefault();
        $('html, body').animate({
            scrollTop: ubicacion
        },600);
    });


	



// Efecto Menu
	$('.menu a, .nose2').each(function(index, elemento){
		$(this).css({
			'top': '-200px'
		});

		$(this).animate({
			top: '0'
		},2000 + (index * 500));
	});
	



// Efecto Header
	if ($(window).width() > 800){
		$('header .textos').css({
			opacity: 0,
			marginTop: 0
		});

		$('header .textos').animate({
			opacity: 1,
			marginTop: '-52px'
		},1500);

		
	}

});