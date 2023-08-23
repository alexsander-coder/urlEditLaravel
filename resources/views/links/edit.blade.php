@extends('layouts.app')

@section('content')
<h2 style="text-align:center;">Editar Link</h2>
<div style="display:flex; justify-content:center;">

    <form action="{{ route('links.update', $link->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="text" name="original_link" value="{{ $link->original_link }}" required>
        <input type="text" name="nome_ficticio" value="{{ $link->nome_ficticio }}" required>
        <input type="text" name="short_link" value="{{ $link->short_link }}" required>
        
        <button type="submit">Atualizar</button>
    </form><br><br>

  </div>
  <div style="display:flex; justify-content:center; margin-top:3%;">
      <button onclick="window.location='{{ route('links.create') }}'" class="btn btn-primary">Cancelar</button>
  </div>
@endsection
