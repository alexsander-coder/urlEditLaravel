<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Models\LinkAccess;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
    public function show(Link $link)
    {
        $linkAccesses = $link->linkAccesses;

        return view('links.show', compact('link', 'linkAccesses'));
    }


    // public function index()
    // {
    //     $links = Link::all();
    //     return view('links.index', compact('links'));
    // }


    public function create()
    {
        $links = Link::all();
        return view('links.create', compact('links'));
    }

    public function store(Request $request)
    {
        $rules = [
            'original_link' => 'required|url',
            'custom_alias' => 'nullable|alpha_num|between:6,8|unique:links,short_link',
            'nome_ficticio' => 'nullable',

        ];

        $messages = [
            'custom_alias.between' => 'O identificador único deve ter entre 6 e 8 caracteres.',
            'custom_alias.unique' => 'Identificador único já em uso'
        ];

            $data = $request->validate($rules, $messages);

        // Se custom_alias estiver vazio, gera um automaticamente. Caso contrário, usa o fornecido.
        $shortLink = empty($data['custom_alias']) ? Str::random(6) : $data['custom_alias'];

        Link::create([
            'original_link' => $data['original_link'],
            'short_link' => $shortLink,
            'nome_ficticio' => $data['nome_ficticio']
        ]);

        return redirect()->route('links.create');
    }

    public function redirect($shortLink)
    {
        $link = Link::where('short_link', $shortLink)->firstOrFail();

        $ip = request()->ip();
        $userAgent = request()->header('User-Agent');

        LinkAccess::create([
            'link_id' => $link->id,
            'ip' => $ip,
            'user_agent' => $userAgent
        ]);

        $link->increment('clicks');

        return redirect($link->original_link);
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.create')->with('success', 'Link excluído com sucesso!');
    }

    public function edit($id)
    {
    $link = Link::findOrFail($id);
    return view('links.edit', compact('link'));
    }

  public function update(Request $request, $id)
{
    $link = Link::findOrFail($id);

    // Validação (ajuste conforme necessário)
    $rules = [
        'original_link' => 'required|url',
        'short_link' => [
            'required',
            'alpha_num',
            'between:6,8',
            Rule::unique('links')->ignore($link->id)
        ],
        'nome_ficticio' => 'nullable',
    ];

    $data = $request->validate($rules);

    $link->update($data);

    return redirect()->route('links.create')->with('success', 'Link atualizado com sucesso!');
}

}

