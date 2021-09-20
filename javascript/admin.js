$(function () {
    const urlAdmin = "http://localhost/vakcinacija/api/admin/";
    const url = "http://localhost/vakcinacija/api/";

    getPrijave();
    getUstanove();


    $('#ustanove-select').change(function (e) { 
        e.preventDefault();
        console.log()
        searchPoUstanovi($('#ustanove-select').val())
    });

    function getPrijave() {
        $.ajax({
            type: "GET",
            url: urlAdmin + "prijave.php",
            dataType: "JSON",
            success: function (response) {
                formatirajTabelu(response);
            }
        });
    }

    function formatirajTabelu(prijave) {
        $('.table tbody').html('');
        prijave.forEach(p => {
            $('.table tbody').append(
                `
                <tr>
                    <td scope="row">${p.jmbg}</td>
                    <td>${p.ime}</td>
                    <td>${p.prezime}</td>
                    <td>${p.adresa}</td>
                    <td>${p.zakazano_u}</td>
                    <td>
                        <button id="${p.id_prijava}" class="btn btn-danger del" >Izbrisi</button>
                    </td>
                </tr>
             `);
        });
    }

    $('body').on('click', '.del', function (e) {
        const id = $(this).attr('id');

        $.ajax({
            type: "POST",
            url:  urlAdmin+ "izbrisi-prijavu.php",
            data: {
                id_prijava: id
            },
            success: function (response) {
                alert(response);
                getPrijave();
            }
        });
    });

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

    function searchPoUstanovi(ustanovaId) {
        $.ajax({
            type: "GET",
            url: urlAdmin + "search-ustanova.php",
            data: {
                id_ustanova: ustanovaId
            },
            dataType: "JSON",
            success: function (response) {
                formatirajTabelu(response);
            }
        });
    }

});