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
    <div style="text-align:center">
        <iframe width="600" height="400" src="https://www.youtube.com/embed/XINlEYXA3k0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
    </div>    
    <hr>  
    <div class="row">
        <div class="col-md-8 col-md-offset-8" style="margin-left: auto;margin-right: auto;">
            <h4>Dodaj nowego klienta</h4><hr>
                <form action="{{ route('client.save') }}" method="post" id="client_form">
                @csrf
                    <div class="form-group">
                        <label for="imie">Imię</label>
                        <input type="text" class="form-control" name='imie' placeholder="Wpisz imię">
                        <span class="text-danger error-text imie_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="nazwisko">Nazwisko</label>
                        <input type="text" class="form-control" name='nazwisko' placeholder="Wpisz nazwisko">
                        <span class="text-danger error-text nazwisko_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name='email' placeholder="Wpisz email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <label for="telefon" class="">Telefon</label>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <input id="prefix" class="form-control input-group-lg reg_name" type="text" name="prefix" title="Kierunkowy" placeholder="Kierunkowy">
                            <span class="text-danger error-text prefix_error"></span>
                        </div>       
                        <div class="col-sm-6">
                            <input id="telefon" class="form-control input-group-lg reg_name" type="text" name="telefon" title="Telefon" placeholder="Nr telefonu">
                            <span class="text-danger error-text telefon_error"></span>
                        </div>
                    </div>
                    
                    <input class="form-check-input" type="checkbox" value="1" id="checkbox" name="zgoda">
                    <label class="form-check-label" for="checkbox">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    </label>
                    <span class="text-danger error-text checkbox_error"></span>
                    <hr>
                    <button type="submit" class="btn btn-block btn-primary">Zapisz</button>


                </form>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $("#client_form").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    $('#client_form')[0].reset();
                    window.location.href = "/add_desc_client/"+data.id;
                    // alert(data.id);
                }
            }
        });
    });
});
</script>
</body>
</html>