@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-100">
                <div class="card">
                    <div class="card-header">Lista de Invitados</div>
                    <div class="card-body" style="overflow-x:auto;">
                        <button id="print" class="btn-success p-1 float-right mb-4">Imprimir Lista</button>
                        <table class="tabla-invitados">
                            <thead>
                                <th>Invitado</th>
                                <th>Enviar Invitación</th>
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
                                            <a href="{{ $invitado['url'] }}" target="_blank">
                                                <img class="enviar-whats" src="{{ URL::to('/') }}/images/enviar.svg"
                                                    alt="" />
                                            </a>
                                        </td>
                                        <td>{{ $invitado['pases_disponibles'] }}</td>
                                        <td>{{ $invitado['pases_confirmados'] }}</td>
                                        <td>{{ $invitado['whatsapp'] }}</td>
                                        <td>{{ $invitado['status_texto'] }}</td>
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
