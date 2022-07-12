@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-100">

                <div class="card">
                    <div class="card-header">Lista de Invitados</div>
                    <div class="w-100 pr-4 mt-4">
                        <button id="print" class="btn-success p-1 float-right mb-4">Imprimir Lista</button>
                    </div>
                    <div class="card-body" style="overflow-x:auto;">
                        <table class="tabla-invitados">
                            <thead>
                                <th>Invitado</th>
                                <th>Enviar Invitación</th>
                                <th>Ver Invitación</th>
                                <th>Pases Disponibles</th>
                                <th>Pases Aceptados</th>
                                <th>WhatsApp</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($invitados as $invitado)
                                    <tr>
                                        <td>{{ $invitado['invitado'] }}</td>
                                        <td>
                                            @if ($invitado['status'] != 0)
                                                <img class="enviar-whats" src="{{ URL::to('/') }}/images/wn.svg"
                                                    alt="" />
                                            @else
                                                <a href="{{ $invitado['url'] }}" target="_blank">
                                                    <img class="enviar-whats" src="{{ URL::to('/') }}/images/enviar.svg"
                                                        alt="" />
                                                </a>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ $invitado['link'] }}" target="_blank">
                                                <img class="enviar-whats" src="{{ URL::to('/') }}/images/ver.svg"
                                                    alt="" />
                                            </a>
                                        </td>
                                        <td>{{ $invitado['pases_disponibles'] }}</td>
                                        <td>{{ $invitado['pases_confirmados'] }}</td>
                                        <td>{{ $invitado['whatsapp'] }}</td>
                                        @if ($invitado['status'] == 0)
                                            <td>{{ $invitado['status_texto'] }}</td>
                                        @elseif($invitado['status'] == 1)
                                            <td class="text-success">{{ $invitado['status_texto'] }}</td>
                                        @else
                                            <td class="text-danger">{{ $invitado['status_texto'] }}</td>
                                        @endif


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $("#print").click(function() {
            window.print();
        });
    </script>
@endsection
