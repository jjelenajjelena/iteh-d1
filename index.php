<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Prijava za vakcinu</title>
</head>

<body>

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div id="prijava-box">
            <form id="prijava-form">
                <div class="form-group">
                    <label for="ime">Ime</label>
                    <input type="ime" class="form-control" id="ime" placeholder="Marko">
                </div>
                <div class="form-group">
                    <label for="prezime">Prezime</label>
                    <input type="prezime" class="form-control" id="prezime" placeholder="Markovic">
                </div>
                <div class="form-group">
                    <label for="jmbg">Jmbg</label>
                    <input type="text" class="form-control" id="jmbg" placeholder="1234567891011">
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <label class="form-check-label">

                            <input type="radio" class="form-check-input" name="zeliVakcinaciju" id="" value=true checked>
                            Zelim da se vakcinisem
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">

                            <input type="radio" class="form-check-input" name="zeliVakcinaciju" id="" value=false>
                            Ne zelim da se vakcinisem
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Izaberite ustanovu</label>
                    <select class="form-control form-control-sm" name="" id="ustanove-select">

                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>

        </div>
    </div>

  
    <div class="modal fade" id="vec-prijavljen-modal" tabindex="-1" role="dialog" aria-labelledby="vec-prijavljen-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Vec ste prijavljeni!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-text" class="modal-body">
                    test
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nazad</button>
                    <button type="button"  class="btn btn-primary prihvati">Prihvati</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="./javascript/index.js"></script>

</body>

</html>