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
			return false;
		}
	}

	//-----------------------------------------------------------	
	

	//kontakt.php
	
	var podaciOOsobi="";
	
	$('#kontakt-forma :submit').click(function(){
		var t=proveraTekst();
		var p=proveraPoruka();
		var r=proveraRegExp();
		if( t && p && r){
			podaciOOsobi={
				"ime":$('#tbIme').val(),
				"prezime":$('#tbPrezime').val(),
				"email":$('#tbEmail').val(),
				"naslov":$('#tbNaslov').val(),
				"poruka":$('#taPoruka').val()	
			};
			return true;
		}else{
			return false;
		}
	});
		
	
	function proveraTekst(){
		var t=true;
		$('#kontakt-forma :text').each(function(){
			if($(this).val().length==0){
				$(this).addClass('poruka-border');
				$(this).next().children(':eq(1)').slideUp();
				$(this).next().children(':first').slideDown();
				t=false;
			}else{
				$(this).removeClass('poruka-border');
				$(this).next().children(':first').slideUp();
			}
		});
		return t;
	}
	
	function proveraPoruka(){
		if($('#taPoruka').val()==0){
			$('#taPoruka').addClass('poruka-border');
			$('#taPoruka').next().children(':first').slideDown();
			return false;
		}else{
			$('#taPoruka').removeClass('poruka-border');
			$('#taPoruka').next().children(':first').slideUp();
			return true;
		}
	}
	function proveraRegExp(){
		var imeRegExp= new RegExp(/^[A-Z][a-z]+(\s[A-Z][a-z]+)*$/);
		var emailRegExp= new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/);
		var ime=$('#tbIme').val();
		var prezime=$('#tbPrezime').val();
		var email=$('#tbEmail').val();
		var i=imeRegExp.test(ime);
		var p=imeRegExp.test(prezime);
		var e=emailRegExp.test(email);
		if(i || ime.length==0){
			if(i){
				$('#tbIme').removeClass('poruka-border');
				$('#tbIme').next().children(':eq(1)').slideUp();
			}
		}else{
			$('#tbIme').addClass('poruka-border');
			$('#tbIme').next().children(':eq(1)').slideDown();
		}
		if(p || prezime.length==0){
			if(p){
				$('#tbPrezime').removeClass('poruka-border');
				$('#tbPrezime').next().children(':eq(1)').slideUp();
			}
		}else{
			$('#tbPrezime').addClass('poruka-border');
			$('#tbPrezime').next().children(':eq(1)').slideDown();
		}
		if(e || email.length==0){
			if(e){
				$('#tbEmail').removeClass('poruka-border');
				$('#tbEmail').next().children(':eq(1)').slideUp();
			}
		}else{
			$('#tbEmail').addClass('poruka-border');
			$('#tbEmail').next().children(':eq(1)').slideDown();
		}
		if(i && p && e){
			return true;
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------	
});

