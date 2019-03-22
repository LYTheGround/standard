<?php

namespace App\Http\Controllers\Premium;

use App\Http\Requests\Premium\TokenRequest;
use App\Token;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{

    public function index(Token $token)
    {
        $this->authorize('view',Token::class);

        return view('token.index',[
            'tokens' => $token->liste()
        ]);
    }

    public function create()
    {
        $this->authorize('view',Token::class);

        return view('token.create',[
            'company' => auth()->user()->member->company
        ]);
    }

    public function store(TokenRequest $request,Token $token)
    {
        $this->authorize('view',Token::class);

        $token->onCreate($request->company,$request->range,$request->category);

        session()->flash('status',__('token.store'));

        return redirect()->route('token.index');
    }

    public function destroy(Token $token)
    {
        $this->authorize('delete',$token);

        $token->onDelete();

        session()->flash('status', __('token.delete_success'));

        return redirect()->route('token.index');
    }

}
