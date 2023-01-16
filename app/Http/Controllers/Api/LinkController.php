<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorelinkRequest;
use Illuminate\Http\Request;
use App\Models\link;
use App\Models\Hitlink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LinkResource;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function store(StorelinkRequest $request)
    {
        if ($request->token!='357203')
        {
            return response()->json('Unauthenticated',403);
        }
        $validated=$request->validated();
        $stored=Link::create([
            'name'=>$validated->name,
            'link'=>$validated->link,
            'shortlink'=>$validated->shortlink,
            'pemilik'=>"Arya gading"
        ]);
        Hitlink::create([
            'link_id'=>$stored->id,
            'linkhit'=>0
        ]);
        return new LinkResource(true,'Berhasil memendekkan link',$stored);
    }
    public function index()
    {
        $links=Link::all();
        return response()->json($links,200);
    }
}
