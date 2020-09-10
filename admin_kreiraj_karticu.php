<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }

    $fakulteti = getFakulteti();
    $domovi = getDomovi();
?>

<div class="main mainHeight">
    <div id="kreiraj-karticu">
        <form method="post" id="kreiraj-karticu-forma" name="kreiraj-karticu-forma">
            <?php
                $const = APP_KEY;
                echo "<input type='hidden' id='kk-app-key' name='kk-app-key' value=\"$const\"/>";
            ?>
            <div>
                <label for="kkIme"><b>Ime</b></label>
                <input class="border-ccc" type="text" id="kkIme" name="kkIme">
            </div>
            <div>
                <label for="kkPrezime"><b>Prezime</b></label>
                <input class="border-ccc" type="text" id="kkPrezime" name="kkPrezime">
            </div>

            <div>
                <label for="kkDatum"><b>Datum rođenja</b></label>
                <input class="border-ccc" type="date" id="kkDatum" name="kkDatum">
            </div>

            <div class="kkFlex">
                <label><b>Pol</b></label>
                <span>
                    <label for="kkMuski">Muški</label>
                    <input class="border-ccc" type="radio" id="kkMuski" name="pol" value="muski">
                    <label for="kkZenski">Ženski</label>
                    <input class="border-ccc" type="radio" id="kkZenski" name="pol" value="zenski">
                </span>
            </div>

            <div class="kkFlex">
                <label><b>Beogradska</b></label>
                <span>
                    <label for="kkBeogradskaDa">Da</label>
                    <input class="border-ccc" type="radio" id="kkBeogradskaDa" name="beogradska" value="da">
                    <label for="kkBeogradskaNe">Ne</label>
                    <input class="border-ccc" type="radio" id="kkBeogradskaNe" name="beogradska" value="ne">
                </span>
            </div>

            <div class="kkFlex">
                <label><b>Budžetska</b></label>
                <span>
                    <label for="kkBudzetskaDa">Da</label>
                    <input class="border-ccc" type="radio" id="kkBudzetskaDa" name="budzetska" value="da">
                    <label for="kkBudzetskaNe">Ne</label>
                    <input class="border-ccc" type="radio" id="kkBudzetskaNe" name="budzetska" value="ne">
                </span>
            </div>

            <div>
                <label for="fakultet">Fakultet</label>
                <select name="fakultet" class="border-ccc" id="fakultet">
                    <option value="0">Naziv fakulteta</option>
                    <?php
                        foreach($fakulteti AS $fakultet){
                            echo "<option value='".$fakultet['fakultet_id']."'>".$fakultet['naziv']."</option>";
                        }
                    ?>      
                </select>
            </div>
            
            <div>
                <label for="dom">Dom</label>
                <select name="dom" class="border-ccc" id="dom">
                    <option value="0">Naziv doma</option>
                    <?php
                        foreach($domovi AS $dom){
                            echo "<option value='".$dom['dom_id']."'>".$dom['naziv']."</option>";
                        }
                    ?>           
                </select>
            </div>
        
            <div>
                <button id="btnKreirajKarticu" class="dugme" name="btnKreirajKarticu" type="button" onclick="kreirajKarticu()">Kreiraj karticu</button>
            </div>

            <div class="poruka">
                <span id="kreiraj-karticu-poruka">Sva polja moraju biti popunjena</span>
            </div>
        </form>
        
    </div>

</div>