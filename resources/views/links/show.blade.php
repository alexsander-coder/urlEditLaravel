@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="text-align:center;">Detalhes do Link</h2>
    <p>ID: {{ $link->id }}</p>
    <p>Link Original: {{ $link->original_link }}</p>
    <p>Link Encurtado: {{ url($link->short_link) }}</p>
    <p>Clicks: {{ $link->clicks }}</p>
    <p>Nome de identificação da URL: {{ $link->nome_ficticio }}</p>

   <h3>Detalhes dos Acessos</h3>
<ul>
    @if ($linkAccesses)
        @foreach ($linkAccesses as $access)
            <li>
                IP: {{ $access->ip }} | User Agent: {{ $access->user_agent }} | Data e Hora: {{ $access->created_at }}
            </li>
        @endforeach
    @else
        <li>Nenhum acesso registrado</li>
    @endif
</ul>

<div>
  <button onclick="window.location='{{ route('links.create') }}'" 
  class="btn btn-primary">Voltar</button>
</div>
