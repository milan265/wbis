<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
    }

    $student = getStudent();
    $kartica = getKartica();
?>



<div class="main mainHeight">
    <div id="podaci">
        <div id="podaci-prvi-red">
            <div id="profilna-slika" class="podaci-klasa">
                <?php
                    $profilnaSlika = $student['slika'];
                    echo "<img src=\"data:image/png;base64,".base64_encode($profilnaSlika)."\" alt=\"Profilna slika\"/>";
                ?>
            </div>

            <div id="stanje-racuna" class="podaci-klasa">
                <table>
                    <tr>
                        <td>
                            <span>Doručak</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['dorucak']);?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Ručak</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['rucak']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Večera</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['vecera']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Stanje na računu</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['stanje_na_racunu']); ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div id="podaci-drugi-red">
            <div id="osnovni-podaci" class="podaci-klasa">
            <table>
                    <tr>
                        <td>
                            <span>Ime</span>
                        </td>
                        <td>
                            <span><?php print_r($student['ime']);?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Prezime</span>
                        </td>
                        <td>
                            <span><?php print_r($student['prezime']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Pol</span>
                        </td>
                        <td>
                            <span><?php print_r($student['pol']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Datum rođenja</span>
                        </td>
                        <td>
                            <span><?php print_r($student['datum_rodjenja']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Fakultet</span>
                        </td>
                        <td>
                            <span><?php print_r($student['fakultet']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Broj indeksa</span>
                        </td>
                        <td>
                            <span><?php print_r($student['broj_indeksa']); ?></span>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div id="podaci-kartica" class="podaci-klasa">
            <table>
                    <tr>
                        <td>
                            <span>Broj kartice</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['broj_kartice']);?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Datum izdavanja</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['datum_izdavanja']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Važi do</span>
                        </td>
                        <td>
                            <span><?php print_r($kartica['vazi_do']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Validna</span>
                        </td>
                        <td>
                            <span><?php echo $kartica['validna']?"Da":"Ne";?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Beogradska</span>
                        </td>
                        <td>
                            <span><?php echo $kartica['beogradska']?"Da":"Ne"; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Budžet</span>
                        </td>
                        <td>
                            <span><?php echo $kartica['budzet']?"Da":"Ne"; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Dom</span>
                        </td>
                        <td>
                            <span><?php echo $kartica['dom_id']?"Da":"Ne"; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        
    </div>

</div>