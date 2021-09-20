$(function () {
    const url = "http://localhost/vakcinacija/api/";
    let novoVremeTimestamp;
    let korisnik;
    ucitaj();

    $('#prijava-form').submit(function (e) {
        e.preventDefault();
        const prijava = {
            ime: $('#ime').val(),
            prezime: $('#prezime').val(),
            jmbg: $('#jmbg').val(),
            ustanovaId: $('#ustanove-select').val(),
            zeliVakcinaciju: $('input[name="zeliVakcinaciju"]:checked').val(),
        }
        if (prijavaValidacija(prijava))
            dodajPrijavu(prijava);
    });

    $('.prihvati').click(function (e) {
        e.preventDefault();
        promeniVreme(novoVremeTimestamp, korisnik.id_korisnik)
    });

    /* Pomocne funkcije */
    function ucitaj() {
        getUstanove();
    }


    function getUstanove() {
        $.ajax({
            type: "GET",
            url: url + "ustanove.php",
            dataType: "JSON",
            success: function (response) {
                napuniSelectUstanova(response);
            }
        });
    }

    function napuniSelectUstanova(ustanove) {
        ustanove.forEach(element => {
            $('#ustanove-select').append(
                `
                <option value="${element.id_ustanova}">${element.grad}, ${element.adresa}</option>
                `
            );
        });
    }

    function dodajPrijavu(prijava) {
        $.ajax({
            type: "POST",
            url: url + "nova-prijava.php",
            data: {
                ime: prijava.ime,
                prezime: prijava.prezime,
                jmbg: prijava.jmbg,
                ustanovaId: prijava.ustanovaId,
            },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.postoji) {
                    $('#vec-prijavljen-modal').modal('show');
                    $('#modal-text').text(
                        `
                        Ako Vam ne odgovara trenutno vreme, mozemo Vam ponuditi vreme: ${res.novoVreme}
                        `
                    )


                }
                else alert(res.poruka);

                korisnik = res.korisnik;
                novoVremeTimestamp = res.novoVremeTimestamp;

            },
        });
    }

    function prijavaValidacija(prijava) {
        if (!(prijava.zeliVakcinaciju === "true")) {
            alert("Hvala Vam na prijavi.");
            return false;
        }
        if (prijava.ime == "" || prijava.jmbg == "" || prijava.prezime == "" || prijava.ustanovaId == "") {
            alert("Greska prilikom popunjavanja forme. Popunite sva polja.");
            return false;
        }
        else return true;
    }

    function promeniVreme(novoVremeTimestamp, korisnikId) {
        $.ajax({
            type: "POST",
            url: url + "promena-vremena.php",
            data: {
                novoVreme: novoVremeTimestamp,
                korisnikId
            },
            success: function (response) {
                alert(response)
                $('#vec-prijavljen-modal').modal('hide');
            }
        });
    }

});