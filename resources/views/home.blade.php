@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-100">
                <div class="card">
                    <div class="card-header">Lista de Invitados</div>
                    <div class="card-body">

                        <table class="tabla-invitados">
                            <thead>
                                <th>#</th>
                                <th>Invitado</th>
                                <th>Pases Disponibles</th>
                                <th>Pases Confirmados</th>
                                <th>WhatsApp</th>
                                <th>Status</th>
                                <th>Enviar Invitación</th>
                                <th>Link</th>
                            </thead>
                            <tbody>
                                @foreach ($invitados as $invitado)
                                    <tr>
                                        <td>{{ $invitado['id'] }}</td>
                                        <td>{{ $invitado['invitado'] }}</td>
                                        <td>{{ $invitado['pases_disponibles'] }}</td>
                                        <td>{{ $invitado['pases_confirmados'] }}</td>
                                        <td>{{ $invitado['whatsapp'] }}</td>
                                        <td>{{ $invitado['status_texto'] }}</td>
                                        <td>
                                            <a href="{{ $invitado['url'] }}" target="_blank">
                                                <img class="enviar-whats" src="{{ URL::to('/') }}/images/enviar.svg"
                                                    alt="" />
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $invitado['link'] }}" target="_blank">
                                                {{ $invitado['link'] }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
