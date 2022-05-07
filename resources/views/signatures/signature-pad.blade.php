<!DOCTYPE html>
<html>

<head>
    <title>Signature Pad</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <link href="{{ asset('css/aaa.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .kbw-signature {
            width: 100%;
            height: 180px;
        }

        #signaturePad canvas {
            width: 100% !important;
            height: auto;
        }

    </style>
</head>

<body class="">
    <div class="container">
        <div class="row justify-content-center mx-2">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="text-center font-weight-light my-4">Signature Pad</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success  alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <form method="POST" action="{{ url('/admin/signature-pad') }}">
                                @csrf
                                <div class="col-md-6 mx-auto">
                                    <div class="form-floating">
                                        <input class="form-control form-group" id="inputName" type="text"
                                            placeholder="Mohammed S" name="name" autocomplete="off" />
                                        <span class="text-danger">@error('name')
                                                {{ $message }}
                                            @enderror</span>
                                        <label for="inputName">Name <i class="bi bi-person"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="text-center text-muted" for="">Signature <i class="bi bi-easel2"></i></h6>
                                    <br />
                                    <div id="signaturePad"></div>
                                    <br />
                                    <button id="clear" class="btn btn-outline-danger btn-sm mt-2">Clear Signature <i
                                            class="bi bi-arrow-clockwise"></i></button>
                                    <textarea id="signature64" name="signed" style="display: none"></textarea>
                                </div>
                                <br />
                                <button class="btn btn-block w-100 btn-outline-success">Save <i class="bi bi-save"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <script type="text/javascript">
        var signaturePad = $('#signaturePad').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.signature('clear');
            $("#signature64").val('');
        });
    </script>
</body>

</html>
