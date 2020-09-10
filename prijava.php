<?php
    //lozinka za studente: 12345abc
    //lozinka za administratora: admin123
    
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }
    echo "<script>document.title='Prijava'</script>";
    session_start();
    $_SESSION["app_key"] = APP_KEY;
    include('pocetak.php');
?>

<div class="main mainHeight">
    <div id="login">
        <form method="post" id="prijava-forma" name="prijava-forma">
            <?php
                $const = APP_KEY;
                echo "<input type='hidden' id='app_key' name='app_key' value=\"$const\"/>";
            ?>
            <div>
                <label for="tbBrKartice"><b>Broj kartice</b></label>
                <input class="border-ccc" type="text" id="tbBrKartice" name="tbBrKartice" maxlength="9">
                <div id="tbBrKarticePoruka" class="poruka">
                    <span>Broj kartice nije u dobrom formatu</span>
                </div>
            </div>
            <div>
                <label for="tbLozinka"><b>Lozinka</b></label>
                <input class="border-ccc" type="password" id="tbLozinka" name="tbLozinka">
                <input type="checkbox" onclick="prikaziLozinku('tbLozinka')">Prikaži lozinku
                <div id="tbLozinkaPoruka" class="poruka">
                    <span>Polje mora biti popunjeno</span>
                </div>
            </div>

            <div>
                <button id="btnPrijaviSe" class="dugme" name="btnPrijaviSe" type="button" onclick="proveraPrijave()">Prijavi se</button>
            </div>
            <div class="poruka">
                <span id="neuspesna-prijava">Korisnik sa unetim podacima ne postoji</span>
            </div>
        </form>
        
    </div>
</div>
<?php
    include('kraj.php');
?>