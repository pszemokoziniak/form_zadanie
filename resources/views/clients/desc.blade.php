<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

    <title>Formularz</title>
</head>
<body>
@if(Session::has('saveform'))
    <script>
        swal("Dobra Robota", "Formularz Zapisany", "success");
    </script>
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-md-offset-8" style="margin-left: auto;margin-right: auto;">
            <h4>Dodaj opis klienta</h4><hr>
            <h4>{{$id_client}} TEST</h4>
                <form action="{{ route('client.save_desc') }}" method="post" id="client_form">
                @csrf
                    <input type="hidden" name="id" value="{{$id_client}}">

                    <div class="form-group purple-border">
                        <label for="opis_osoby">Opis Klienta</label>
                        <textarea class="form-control" id="opis" name="opis_osoby" rows="3"></textarea>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-block btn-primary">Zapisz</button>
                </form>
        </div>
    </div>
</div>

</body>
</html>