<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }
?>

<div class="main mainHeight">
    <div id="main-promena-lozinke">
        <form method="post" id="promena-lozinke-forma" name="promena-lozinke-forma">
            <?php
                $const = APP_KEY;
                echo "<input type='hidden' id='app-key-promena-lozinke' name='app-key-promena-lozinke' value=\"$const\"/>";
            ?>
            <div>
                <label for="tbStaraLozinka"><b>Trenutna lozinka</b></label>
                <input class="border-ccc" type="password" id="tbStaraLozinka" name="tbStaraLozinka">
                <input type="checkbox" onclick="prikaziLozinku('tbStaraLozinka')">Prikaži lozinku
                <div id="trenutna-lozinka-poruka" class="poruka poruka-lozinke">
                    <span>Polje mora biti popunjeno</span>
                </div>
            </div>
            <div>
                <label for="tbNovaLozinka1"><b>Nova lozinka</b></label>
                <input class="border-ccc" type="password" id="tbNovaLozinka1" name="tbNovaLozinka1">
                <input type="checkbox" onclick="prikaziLozinku('tbNovaLozinka1')">Prikaži lozinku
                <div id="nova-lozinka-poruka" class="poruka poruka-lozinke">
                    <span>Polje mora biti popunjeno</span>
                </div>
            </div>
            <div>
                <label for="tbNovaLozinka2"><b>Ponovljena nova lozinka</b></label>
                <input class="border-ccc" type="password" id="tbNovaLozinka2" name="tbNovaLozinka2">
                <input type="checkbox" onclick="prikaziLozinku('tbNovaLozinka2')">Prikaži lozinku
                <div id="nova-lozinka2-poruka" class="poruka poruka-lozinke">
                    <span>Unete nove lozinke se ne poklapaju</span>
                </div>
            </div>

            <div>
                <button id="btnPromeniLozinku" name="btnPromeniLozinku" type="button" onclick="promeniLozinku()">Promeni lozinku</button>
            </div>
        </form>
    </div>
    <div id="snackbar-promena-lozinke"></div>        
</div>