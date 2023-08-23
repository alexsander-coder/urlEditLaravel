<style>
  *{
    margin:0;
  }
  .container{
    display: flex;
    justify-content:center;
    background: aliceblue;
    height:70px;
    margin: 0 0 4% 0;
  }

  .vert{
    margin-top:3%;
  }

  form input{
    border-radius: 5px;
    box-shadow: 0 0 0 0;
    border: 1px solid gray;
    outline: 0;
  }

</style>

<div class="container">
  <div class="vert">
    <form action="{{ route('links.store') }}" method="post">
        @csrf
        <input type="text" name="original_link" placeholder="Digite o link original" value="{{ old('original_link') }}" required>
        <input type="text" name="nome_ficticio" placeholder="Dê um nome a sua URL" value="{{ old('nome_ficticio') }}">
        <input style="max-width:5rem;" type="text" name="custom_alias" placeholder="Digite um slug único (opcional)" value="{{ old('custom_alias') }}">
        <button type="submit">Encurtar</button>
    </form>
  </div>
</div>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<h3 style="text-align:center; margin-top:12%">Links existentes:</h3>
@include('links.partials.links_table')
