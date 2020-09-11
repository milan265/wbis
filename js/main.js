/*cookie*/
function setCookie(cname, cvalue, sec) {
    var d = new Date();
    d.setTime(d.getTime() + (sec*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

function prihvatiCookie(){
    document.getElementById("cookie-info").style.display = "none";
    setCookie("cookie",1,86400);
  
}

if(getCookie('cookie')==0){
    document.getElementById("cookie-info").style.display = "block";
}else{
    document.getElementById("cookie-info").style.display = "none";
}


/*----------------------------------------------*/

function prikaziLozinku(id){
    var x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

/*----------------------------------------------*/

var input = document.getElementById("login");
if(input){
  input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {//kod za enter je 13
      event.preventDefault();
      document.getElementById("btnPrijaviSe").click();
    }
  });
}

function proveraPrijave(){
  var app_key = document.getElementById("app_key").value;
  var brKartice = document.getElementById("tbBrKartice").value;
  var lozinka = document.getElementById("tbLozinka").value;

  var brKarticeRegExp= new RegExp(/^[0-9]{9}$/);
  var b = brKarticeRegExp.test(brKartice);
  
  if(b && lozinka!=""){
    var params = "app_key="+app_key+"&tbBrKartice="+brKartice+"&tbLozinka="+lozinka;
    var xhr = new XMLHttpRequest();
    xhr.open("POST","obrada_prijave.php",true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200) {
        if(xhr.responseText==1){
          document.getElementById("neuspesna-prijava").style.display = "none";
          window.location.href = "http://localhost/wbis/";
        }else{
          document.getElementById("neuspesna-prijava").style.display = "block";
        }
      }

    };

    xhr.send(params);
  } 
}

/*----------------------------------------------*/

function odjaviSe(){
  setCookie("prijavljen",0,86400);
  setCookie("broj_kartice","",-1000);
  setCookie("vrsta_korisnika","",-1000);

  window.location.href = "http://localhost/wbis/";
}

/*----------------------------------------------*/

/*snackbar student_kontakt_obrada.php*/

  var podaciOOsobi="";
	
	function proveri(){
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
	};
		
	
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



function posaljiPoruku() {
  if(proveri()){
    var app_key = document.getElementById("const").value;
    var tbIme = document.getElementById("tbIme").value;
    var tbPrezime = document.getElementById("tbPrezime").value;
    var tbEmail = document.getElementById("tbEmail").value;
    var tbNaslov = document.getElementById("tbNaslov").value;
    var taPoruka = document.getElementById("taPoruka").value;

    var params = "const="+app_key+"&tbIme="+tbIme+"&tbPrezime="+tbPrezime+"&tbEmail="+tbEmail+"&tbNaslov="+tbNaslov+"&taPoruka="+taPoruka;
    var xhr = new XMLHttpRequest();
    xhr.open("POST","student_kontakt_obrada.php",true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200) {
        var x = document.getElementById("snackbar");
        if(xhr.responseText==1){
          x.innerHTML = "Poruka je poslata";
        }else{
          x.innerHTML = "Greška prilikom slanja poruke";
        }
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        document.getElementById("const").value = "";
        document.getElementById("tbIme").value = "";
        document.getElementById("tbPrezime").value = "";
        document.getElementById("tbEmail").value = "";
        document.getElementById("tbNaslov").value = "";
        document.getElementById("taPoruka").value = "";
      }

    };

    xhr.send(params);
  }
  
}

/*----------------------------------------------*/


/*promena_lozinke */

function promeniLozinku(){
  var app_key = document.getElementById("app-key-promena-lozinke").value;
  var tbStaraLozinka = document.getElementById('tbStaraLozinka').value;
  var tbNovaLozinka1 = document.getElementById('tbNovaLozinka1').value;
  var tbNovaLozinka2 = document.getElementById('tbNovaLozinka2').value;

  if(tbStaraLozinka.length>0){
    $('#tbStaraLozinka').removeClass('poruka-border');
    $('#tbStaraLozinka').addClass('border-ccc');
    $('#trenutna-lozinka-poruka').children(':first').slideUp();
    if(tbNovaLozinka1.length>0){
      $('#tbNovaLozinka1').removeClass('poruka-border');
      $('#tbNovaLozinka1').addClass('border-ccc');
      $('#nova-lozinka-poruka').children(':first').slideUp();
      if(tbNovaLozinka1 == tbNovaLozinka2){
        $('#tbNovaLozinka1').removeClass('poruka-border');
        $('#tbNovaLozinka1').addClass('border-ccc');
        $('#tbNovaLozinka2').removeClass('poruka-border');
        $('#tbNovaLozinka2').addClass('border-ccc');
        $('#nova-lozinka2-poruka').children(':first').slideUp();
        
        var params = "app_key="+app_key+"&stara_lozinka="+tbStaraLozinka+"&nova_lozinka="+tbNovaLozinka1;
        var xhr = new XMLHttpRequest();
        xhr.open("POST","promeni_lozinku.php",true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
          if(xhr.readyState == 4 && xhr.status == 200) {
            var x = document.getElementById("snackbar-promena-lozinke");
            if(xhr.responseText==1){
              x.innerHTML = "Lozinka je promenjena";
              document.getElementById("tbStaraLozinka").value = "";
              document.getElementById("tbNovaLozinka1").value = "";
              document.getElementById("tbNovaLozinka2").value = "";
            }else if(xhr.responseText==0){
              x.innerHTML = "Greška prilikom promene lozinke";
              document.getElementById("tbStaraLozinka").value = "";
              document.getElementById("tbNovaLozinka1").value = "";
              document.getElementById("tbNovaLozinka2").value = "";
            }else if(xhr.responseText==-1){
              x.innerHTML = "Trenutna lozinka nije dobra";
            }
  
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
          }
    
        };
    
        xhr.send(params);
      }else{
        $('#tbNovaLozinka1').removeClass('border-ccc');
        $('#tbNovaLozinka1').addClass('poruka-border');
        $('#tbNovaLozinka2').removeClass('border-ccc');
        $('#tbNovaLozinka2').addClass('poruka-border');
        $('#nova-lozinka2-poruka').children(':first').slideDown();
      }
    }else{
      $('#tbNovaLozinka1').removeClass('border-ccc');
      $('#tbNovaLozinka1').addClass('poruka-border');
      $('#nova-lozinka-poruka').children(':first').slideDown();
    }
  }else{
    $('#tbStaraLozinka').removeClass('border-ccc');
    $('#tbStaraLozinka').addClass('poruka-border');
    $('#trenutna-lozinka-poruka').children(':first').slideDown();
    if(tbNovaLozinka1.length>0){
      $('#tbNovaLozinka1').removeClass('poruka-border');
      $('#tbNovaLozinka1').addClass('border-ccc');
      $('#nova-lozinka-poruka').children(':first').slideUp();
    }else{
      $('#tbNovaLozinka1').removeClass('border-ccc');
      $('#tbNovaLozinka1').addClass('poruka-border');
      $('#nova-lozinka-poruka').children(':first').slideDown();
    }
  }
  
}

/*----------------------------------------------*/


/*uplata obroka*/
function dodajObrok(id, korak, maxBrojObroka, budzet){
  var x = document.getElementById(id);
  var n = parseInt(x.innerText);
  var y = document.getElementById('iznos');
  var racun = parseInt(y.innerText);
  var z = document.getElementById('stanje');
  var stanje = parseInt(z.innerText);
 
  n += korak;
  if(n <= maxBrojObroka){
    x.innerText = n;
    if(budzet){
      if(id=='dorucak'){
        racun += korak * 40;
      }else if(id=='rucak'){
        racun += korak * 72;
      }else if(id=="vecera"){
        racun += korak * 59;
      }
    }else{
      if(id=='dorucak'){
        racun += korak * 95;
      }else if(id=="rucak"){
        racun += korak * 205;
      }else if(id=="vecera"){
        racun += korak * 175;
      }
    }
    y.innerText = racun;
    if(racun>stanje){
      y.style.border = '2px solid red';
    }else{
      y.style.border = 'none';
    }
  } 
}

function smanjiObrok(id,korak, budzet){
  var x = document.getElementById(id);
  var n = parseInt(x.innerText);
  var y = document.getElementById('iznos');
  var racun = parseInt(y.innerText);
  var z = document.getElementById('stanje');
  var stanje = parseInt(z.innerText);

  n -= korak;
  if(n >= 0){
    x.innerText = n;
    if(budzet){
      if(id=='dorucak'){
        racun -= korak * 40;
      }else if(id=='rucak'){
        racun -= korak * 72;
      }else if(id=="vecera"){
        racun -= korak * 59;
      }
    }else{
      if(id=='dorucak'){
        racun -= korak * 95;
      }else if(id=="rucak"){
        racun -= korak * 205;
      }else if(id=="vecera"){
        racun -= korak * 175;
      }
    }
    y.innerText = racun;
    if(racun>stanje){
      y.style.border = '2px solid red';
    }else{
      y.style.border = 'none';
    }
  } 
}

function uplatiObrok(){

  var app_key = document.getElementById('app-key-uplata-obroka').value;
  var dorucak = parseInt(document.getElementById('dorucak').innerText);
  var rucak = parseInt(document.getElementById('rucak').innerText);
  var vecera = parseInt(document.getElementById('vecera').innerText);
  var stanje = parseInt(document.getElementById('stanje').innerText);
  var racun = parseInt(document.getElementById('iznos').innerText);
  var x = document.getElementById("snackbar-uplata-obroka");
  
  if(dorucak>0 || rucak>0 || vecera>0){
    if(racun <= stanje){
      var params = "app_key="+app_key+"&dorucak="+dorucak+"&rucak="+rucak+"&vecera="+vecera+"&stanje="+stanje+"&racun="+racun;
  
      var xhr = new XMLHttpRequest();
      xhr.open("POST","student_uplata_obroka_obrada.php",true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText);
          if(xhr.responseText > 0){
            x.innerHTML = "Uspešno ste izvršili kupovinu obroka";
            document.getElementById('dorucak').innerText = "0";
            document.getElementById('rucak').innerText = "0";
            document.getElementById('vecera').innerText = "0";
            document.getElementById('stanje').innerText = xhr.responseText;
            document.getElementById('iznos').innerText = "0";
          }else{
            x.innerHTML = "Došlo je do greške. Pokušajte ponovo.";
          }
    
          };
      }
      xhr.send(params);
    }else{
      x.innerHTML = "Na računu nemate dovoljno sredstava";
    }
  }else{
    x.innerHTML = "Morate da izaberete količinu obroka";
  }
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  

}

/*----------------------------------------------*/


/*paginacija */
function paginacijaNazad(aktivnaStranica,stranica){
  aktivnaStranica--;
  if(aktivnaStranica>0){
    window.location.href = "http://localhost/wbis/index.php?stranica="+stranica+"&paginacija="+aktivnaStranica;
  }
}

function paginacijaNapred(aktivnaStranica,ukupnoStranica,stranica){
  aktivnaStranica++;
  if(aktivnaStranica<=ukupnoStranica){
    window.location.href = "http://localhost/wbis/index.php?stranica="+stranica+"&paginacija="+aktivnaStranica;
  }
}



/*----------------------------------------------*/


/*admin poruke */

function procitajPoruku(appKey, porukaId, id){
  var params = "app_key="+appKey+"&poruka_id="+porukaId;
  var xhr = new XMLHttpRequest();
  xhr.open("POST","admin_procitaj_poruku.php",true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200) {
      if(xhr.responseText==1){
        document.getElementById(id).classList.remove('poruke-b');
      }
    }
  };
  xhr.send(params);  
}


/*----------------------------------------------*/


/*kreiraj karticu */

var kk = document.getElementById("kreiraj-karticu");
if(kk){
  document.getElementById("kkSlika").addEventListener("change", readFile);
}

function kreirajKarticu(){
  var appKey = document.getElementById('kk-app-key').value;
  var ime = document.getElementById('kkIme').value;
  var prezime = document.getElementById('kkPrezime').value;
  var pol = "";
  if(document.getElementById('kkMuski').checked){
    pol = "Muški";
  }else if(document.getElementById('kkZenski').checked){
    pol = "Ženski";
  }
  var beogradska = -1;
  if(document.getElementById('kkBeogradskaDa').checked){
    beogradska = 1;
  }else if(document.getElementById('kkBeogradskaNe').checked){
    beogradska = 0;
  }
  var budzetska = -1;
  if(document.getElementById('kkBudzetskaDa').checked){
    budzetska = 1;
  }else if(document.getElementById('kkBudzetskaNe').checked){
    budzetska = 0;
  }

  var indeks = document.getElementById('kkIndeks').value;

  var slika = document.getElementById('b64').innerHTML;
  
  var datumRodjenja = document.getElementById('kkDatum').value;
  var fakultet = document.getElementById('fakultet').value;
  var dom = document.getElementById('dom').value;
  var lozinka = getNovaLozinka();
  if(ime!="" && prezime!="" && pol!="" && beogradska!=-1 && budzetska!=-1 && datumRodjenja!="" && slika!="" && indeks!="" && fakultet!=0){
    document.getElementById("kreiraj-karticu-poruka").style.display = "none";
    
    var params = "app_key="+appKey+"&ime="+ime+"&prezime="+prezime+"&pol="+pol+"&datum="+datumRodjenja+
                  "&beogradska="+beogradska+"&budzetska="+budzetska+"&fakultet="+fakultet+"&dom="+dom+
                  "&slika="+slika+"&indeks="+indeks+"&lozinka="+lozinka;
    var xhr = new XMLHttpRequest();
    xhr.open("POST","admin_kreiraj_karticu_obrada.php",true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200) {
        if(xhr.responseText!=0){
          console.log(xhr.responseText);
          console.log(lozinka);
        }else{
          console.log("greska");
          console.log(xhr.responseText);
        }
      }
    };
    xhr.send(params);  
    
  }else{
    document.getElementById("kreiraj-karticu-poruka").style.display = "block";
  }
  
}

function readFile() {
  if (this.files && this.files[0]) {
    var FR= new FileReader();
    FR.addEventListener("load", function(e) {
      document.getElementById("b64").innerHTML = e.target.result;
      document.getElementById('btnSlika').style.backgroundColor="seagreen";
      document.getElementById('btnSlika').innerText = "Slika izabrana";
    }); 
    
    FR.readAsDataURL( this.files[0] );
  }
}

function getNovaLozinka(){
  var duzina = 6;
  var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  var lozinka = "";
  var n = charset.length;
  for (var i=0; i<duzina; i++) {
    lozinka += charset.charAt(Math.round(Math.random() * n));
  }
  return lozinka;
}
/*----------------------------------------------*/

