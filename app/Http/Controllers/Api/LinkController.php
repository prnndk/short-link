<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\link;
use App\Models\Hitlink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LinkResource;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        if ($request->token!='API_TOKEN')
        {
            return response()->json('Unauthenticated',403);
        }
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:links',
            'link'=>'required|url',
            'shortlink'=>'required|unique:links|alpha_dash',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }
        $stored=Link::create([
            'name'=>$request->name,
            'link'=>$request->link,
            'shortlink'=>$request->shortlink,
            'pemilik'=>"Arya gading"
        ]);
        Hitlink::create([
            'link_id'=>$stored->id,
            'linkhit'=>0
        ]);
        return new LinkResource(true,'Berhasil memendekkan link',$stored);
    }
}
