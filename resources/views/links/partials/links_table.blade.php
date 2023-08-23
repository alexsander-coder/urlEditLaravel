<style>
  .contForm {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 15px;
  }

  .resultDiv {
    display: flex;
    justify-content:space-between;
    align-items: center;
    width: 80%;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .button-container {
    display: flex;
    gap: 10px;
  }
  .nome-ficticio{
    font-weight: 600;
    background-color:aliceblue;
  }
</style>

<div class="contForm">
  @foreach ($links as $link)
    <div class="resultDiv">
      <div>ID: {{ $link->id }}</div>

     <div class="url-text" data-url="{{ url($link->short_link) }}">
      @if ($link->nome_ficticio)
        <div class="nome-ficticio"><span>{{ $link->nome_ficticio }}</span></div>
      @endif
      
      {{ url($link->short_link) }}
      <a style="margin-left:4px;" href="#" class="copy-button" onclick="copyUrl(this);">
        <img src="{{ asset('img/copy.svg') }}" alt="copiar">
      </a>
    </div>
      
      <div style="background: rgb(225, 225, 225); padding: 5px; border-radius:5px;">
        Clicks: {{ $link->clicks }}
      </div>
     
      <div class="button-container">
        <a href="{{ route('links.edit', $link->id) }}">
          <img src="{{ asset('img/edit.svg') }}" alt="Editar">
        </a>
        
        <a href="{{ route('links.show', $link->id) }}" class="icon-link">
          <img src="{{ asset('img/icons8-lupa.svg') }}" alt="Visualizar">
        </a>
        <form action="{{ route('links.destroy', $link->id) }}" method="post" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="icon-link" style="border: none; background: none; cursor: pointer;">
            <img src="{{ asset('img/trash.svg') }}" alt="Excluir">
          </button>
        </form>
      </div>
    </div>
  @endforeach
</div>

<script>

  function copyUrl(link) {

    const urlCopy = link.parentElement.dataset.url;
    const tempInput = document.createElement("input");

    document.body.appendChild(tempInput);
    tempInput.value = urlCopy;
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
  }

</script>