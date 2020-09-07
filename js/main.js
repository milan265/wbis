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


function prikaziLozinku(){
    var x = document.getElementById("tbLozinka");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
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
          location.reload();
        }else{
          document.getElementById("neuspesna-prijava").style.display = "block";
        }
      }

    };

    xhr.send(params);
  } 
}


function odjaviSe(){
  setCookie("prijavljen",0,86400);
  setCookie("broj_kartice","",-1000);
  setCookie("vrsta_korisnika","",-1000);

  location.reload();
}