<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= url('css/app.css') ?>" />
    <title>Confirmar Asistencia.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="qr">
        <h1>PARA PODER VER ESTA INVITACIÓN DIGITAL POR FAVOR ESCANEÉ EL SIGUIENTE CÓDIGO QR EN SU CELULAR.</h1>
        <?php
        echo QrCode::size(250)->generate("'" . $data['link'] . "'");
        ?>
    </div>
    <div class="show-contenido">
        <section id="header" class="text-center">
            <div class="bg-header"></div>
            <div class="ryr">
                <img src="{{ URL::to('/') }}/images/ryr.svg" alt="" />
                <?php
                $now = time(); // or your date as well
                $your_date = strtotime('2022-09-03');
                $datediff = $your_date - $now;
                $res = round($datediff / (60 * 60 * 24));
                ?>
                @if ($res > 0)
                    <p>FALTAN <?= $res ?> DIAS</p>
                @else
                    ¡ Hoy es el gran día !
                @endif
            </div>
        </section>
        <section class="we-marry padding-center">
            <h1>¡ NOS CASAMOS !</h1>
            <p>
                Hola <strong><span>{{ $data['invitado'] }}</span></strong>, te invitamos a que vivas
                este momento tan especial junto a padres y amigos.
            </p>
        </section>

        <section class="block" data-aos="fade-up">
            <h1>¿DÓNDE & CUÁNDO?</h1>
            <img src="{{ URL::to('/') }}/images/iglesia.jpg" alt="" />
            <div class="datos">
                <h2>CEREMONIA RELIGIOSA</h2>
                <p class="fecha">03 SEPTIEMBRE 2022 | 16:00 H</p>
                <p class="direccion">PARROQUIA DEL ESPÍRITU SANTO</p>
                <p class="salon">
                    Calle Pino No. 31, Col. Gustavo Díaz Ordaz, Mazatlán, Sin.
                </p>
                <a href="https://goo.gl/maps/mERqjFYxS4YYCAcK9" target="_blank"> ver en el mapa </a>
            </div>
        </section>

        <section class="block" data-aos="fade-down">
            <img src="{{ URL::to('/') }}/images/2.jpg" alt="" />
            <div class="datos">
                <h2>CEREMONIA CIVIL</h2>
                <p class="fecha">03 SEPTIEMBRE 2022 | 19:00 H</p>
                <p class="direccion">TERRAZA, CLUB DE PLAYA</p>
                <p class="salon">Hotel El CID Mazatlán</p>
                <a href="https://g.page/el-cid-castilla-mazatlan?share" target="_blank"> ver en el mapa </a>
            </div>
        </section>

        <section class="block" data-aos="fade-down">
            <img src="{{ URL::to('/') }}/images/salon.jpg" alt="" />
            <div class="datos">
                <h2>RECEPCIÓN</h2>
                <p class="fecha">03 SEPTIEMBRE 2022 | 20:00 H</p>
                <p class="direccion">SALÓN, CLUB DE PLAYA</p>
                <p class="salon">Hotel El CID Mazatlán</p>
                <a href="https://g.page/el-cid-castilla-mazatlan?share" target="_blank"> ver en el mapa </a>
            </div>
        </section>

        <section class="block" data-aos="fade-down">
            <img src="{{ URL::to('/') }}/images/1.jpg" alt="" />
        </section>

        <section class="confirmar padding-center">

            <div class="codigo">
                <p>CÓDIGO DE VESTIMENTA</p>
                <img class="img-svg" src="{{ URL::to('/') }}/images/vestido.svg" alt="" />
                <p><span><strong>DAMAS:</strong></span> VESTIDO LARGO</p>
                <p><span><strong>CABALLEROS:</strong></span> TRAJE O ROPA FORMAL (No Mezclilla) </p>
                <h2>- NO NIÑOS -</h2>
            </div>
            <div class="cena codigo">
                <p>MENÚ DEL EVENTO</p>
                <h2>Primer Tiempo</h2>
                <img class="img-svg" src="{{ URL::to('/') }}/images/menu.svg" alt="" />
                <p><STRong><span>CREMA SUIZA:</span></STRong></p>
                <P>Crema de 3 Quesos (Roquefort, chéddar y de cabra) con pimiento.</P>
                <h2>Segundo Tiempo</h2>
                <p><STRong><span>SUPREMA DE POLLO PHILADELPHIA:</span></STRong></p>
                <p>Rellena con un mousse de camarón y espárragos acompañada con pure de papa y crocante de queso
                    parmesano.</p>
            </div>


            @if ($data['status'] == 0)
                <div id="aceptar">
                    <h1>CONFIRMA TU ASISTENCIA</h1>
                    <form id="SubmitForm">
                        <label for="#slAsiste">¿Asistirá?</label>
                        <select name="slAsiste" id="slAsiste">
                            <option value="1">Si, asistiré. Gracias.</option>
                            <option value="2">No podré asistir.</option>
                        </select>
                        <label for="#slPAses">Pases Disponibles Confirmados</label>
                        <select name="slPAses" id="slPAses">
                            @for ($i = $data['pases_disponibles']; $i > 0; $i--)
                                @if ($i > 1)
                                    <option value="{{ $i }}">{{ $i }} Pases</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }} Pase</option>
                                @endif
                            @endfor
                        </select>
                        <div class="d-none spinner-border my-3 pb-7"
                            style="width: 3rem; height: 3rem; margin:0 auto 0 auto;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <button>
                            CONFIRMAR INVITACIÓN
                        </button>
                    </form>
                </div>
                <div class="alert alert-success mt-4 d-none" role="alert">
                    Se ha confirmado su asistencia a nuestra boda. Gracias.
                </div>
                <div class="alert alert-danger  mt-4 d-none" role="alert">
                    Lamentamos que no puedas asistir a nuestra boda.
                </div>
            @endif
        </section>

        <section class="block regalo" data-aos="fade-down">
            <img class="" src="{{ URL::to('/') }}/images/4.jpg" alt="" />
            <div class="datos">
                <h2>MESA DE REGALOS</h2>
                <p class="fecha">El mejor regalo es tu presencia, pero si deseas hacernos llegar un bonito detalle lo
                    recibiremos con mucho cariño.</p>
                <p class="direccion">$ MONETARIO EFECTIVO $</p>
                <img class="img-svg" src="{{ URL::to('/') }}/images/money.svg" alt="" />
            </div>
        </section>

        <section class="footer">
            <img src="{{ URL::to('/') }}/images/ryr.svg" alt="" />
        </section>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
<script>
    $('#SubmitForm').on('submit', function(e) {
        e.preventDefault();
        //let nombre = $('#txtNombre').val();
        let confirmar = $('#slAsiste').val();
        let pases = $('#slPAses').val();
        $.ajax({
            beforeSend: function() {
                $('.alert-danger').addClass('d-none');
                $('.alert-success').addClass('d-none');
                $('.spinner-border').removeClass('d-none');
            },
            url: "/submit-form",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                //nombre: nombre,
                confirmar: confirmar,
                pases: pases,
                key: "{{ $data['key'] }}"
            },
            success: function(response) {
                setTimeout(() => {
                    $('.spinner-border').addClass('d-none');
                    if (response.success == 1) {
                        $("#aceptar").hide();
                        $('.alert-success').removeClass('d-none');
                    } else {
                        $('.alert-danger').removeClass('d-none');
                        //console.log(response);
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 5000);
                }, 2000);
            },
            error: function(response) {
                /*
                $('#nameErrorMsg').text(response.responseJSON.errors.name);
                $('#emailErrorMsg').text(response.responseJSON.errors.email);
                $('#mobileErrorMsg').text(response.responseJSON.errors.mobile);
                $('#messageErrorMsg').text(response.responseJSON.errors.message);
                */
                //console.log(response);
            }
        });
    });
</script>
