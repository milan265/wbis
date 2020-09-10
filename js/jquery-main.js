$(document).ready(function(){
	//scroll-to-top
	$(window).scroll(function(){
        if ($(this).scrollTop() >= 400) {
            $('#scroll-to-top').fadeIn();
         } else {
            $('#scroll-to-top').fadeOut();
         }
	   });
	
	
	$('#scroll-to-top').click(function(){
		console.log("aaa");
		$('html').animate({scrollTop : 0},1300);
	    return false; 
	});

	//-----------------------------------------------------------	

	/*prijava.php*/ 
	$('#btnPrijaviSe').click(function(){
		var br = proveraBrojaKartice();
		var loz = proveraLozinke();
        if(br && loz){
            return true;
        }else{
			return false;
        }  
	});
    
    function proveraBrojaKartice(){
        var brKarticeRegExp= new RegExp(/^[0-9]{9}$/);
		var brKartice = $("#tbBrKartice").val();
		var b = brKarticeRegExp.test(brKartice);
        if(b){
			$('#tbBrKartice').removeClass('poruka-border');
			$('#tbBrKartice').addClass('border-ccc');
			$('#tbBrKarticePoruka').children(':first').slideUp();
            return true;
        }else{
			$('#tbBrKartice').removeClass('border-ccc');
            $('#tbBrKartice').addClass('poruka-border');
			$('#tbBrKarticePoruka').children(':first').slideDown();
			$('#neuspesna-prijava').css('display','none');
            return false;
        }
	}

	function proveraLozinke(){
		var loz = $("#tbLozinka").val();
		if(loz.length>0){
			$('#tbLozinka').removeClass('poruka-border');
			$('#tbLozinka').addClass('border-ccc');
			$('#tbLozinkaPoruka').children(':first').slideUp();
			return true;
		}else{
			$('#tbLozinka').removeClass('border-ccc');
            $('#tbLozinka').addClass('poruka-border');
			$('#tbLozinkaPoruka').children(':first').slideDown();
			$('#neuspesna-prijava').css('display','none');
			return false;
		}
	}

	//-----------------------------------------------------------	
		
	/*sortiranje tabele */
	
	$('#lista-racuna').DataTable({
        "paging":   false,
        "info":     false
    } );

	$('#lista-uplata').DataTable({
        "paging":   false,
        "info":     false
    } );
	$('.dataTables_length').addClass('bs-select');
	
	//-----------------------------------------------------------	
		
});

