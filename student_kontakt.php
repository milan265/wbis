<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
		header("Location: ./");
	}
?>

<div class="main mainHeight">
    <div id="kontakt-levo">
        <div id="kontakt-tekst">
            <h1>Kontakt</h1>
            <p>Za više informacija možete nam pisati na: <a href="mailto:info@sc.rs" >info&#64;sc.rs</a></p>
        </div>	
        <div id="kontakt-mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.9495057438357!2d20.45988331492439!3d44.80221768539083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a71b417b418a9%3A0x86b8a1db436e5f5a!2sStudentski+centar+Beograd!5e0!3m2!1sen!2srs!4v1565105648403!5m2!1sen!2srs" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <div id="kontakt-desno">
        <form method="post" name="kontakt-forma" id="kontakt-forma">
            <?php
                $const = APP_KEY;
                echo "<input type='hidden' id='const' name='const' value=\"$const\"/>";
            ?>
            <table>
                <tr>
                    <td>
                        <label for="tbIme">Ime</label>
                    </td>
                    <td>
                        <input type="text" id="tbIme" class="desno" name="tbIme" maxlength="255" placeholder="Ime" autocomplete="off"/>
                        <div class="poruka">
                            <span>Morate da unesete ime</span>
                            <span>Ime nije u dobrom formatu</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tbPrezime">Prezime</label>
                    </td>
                    <td>
                        <input type="text" id="tbPrezime" class="desno" name="tbPrezime" maxlength="255" placeholder="Prezime" autocomplete="off"/>
                        <div class="poruka">
                            <span>Morate da unesete prezime</span>
                            <span>Prezime nije u dobrom formatu</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tbEmail">Email</label>
                    </td>
                    <td>
                        <input type="text" id="tbEmail" class="desno" name="tbEmail" maxlength="255" placeholder="Email" autocomplete="off"/>
                        <div class="poruka">
                            <span>Morate da unesete email</span>
                            <span>Email nije u dobrom formatu</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tbNaslov">Naslov poruke</label>
                    </td>
                    <td>
                        <input type="text" id="tbNaslov" class="desno" name="tbNaslov" maxlength="255" autocomplete="off"/>
                        <div class="poruka">
                            <span>Morate da unesete naslov poruke</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tbPrezime">Poruka</label>
                    </td>
                    <td>
                        <textarea id="taPoruka" class="desno" name="taPoruka" maxlength="65535" cols="22" rows="3">
                        </textarea>
                        <div class="poruka">
                            <span>Morate da unesete sadržaj poruke</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <button id="posalji" type="button" onclick="posaljiPoruku()">Pošalji</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="cistac">
    </div>
    <div id="snackbar"></div>

</div>