<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Hitlink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorelinkRequest;
use App\Http\Requests\UpdatelinkRequest;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',[

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelinkRequest $request)
    {
        $validateData=$request->validate([
            'name'=>'required',
            'link'=>'required|url',
            'shortlink'=>'required|unique:links|alpha_dash',
        ]);
        if($request->shortlink==null)
        {
            $validateData['link']=Str::random(5);
        }
        $validateData['pemilik']="Arya Gading";
        $stored=Link::create($validateData);
        Hitlink::create([
            'link_id'=>$stored->id,
            'linkhit'=>0
        ]);
        return redirect('/')->with('success','Berhasil memperpendek link, lihat kunjungan di'.route('detail',$validateData['shortlink']));
    }
    
    public function goLink($id)
    {
       $getLink=Link::where('shortlink',$id)->first();
       if($getLink)
       {
        $addHit=Hitlink::where('link_id',$getLink->id)->first();
        // dd($addHit);
        Hitlink::where('link_id',$getLink->id)->update([
            'linkhit'=>$addHit->linkhit+1
        ]);
        return view('redir',[
        'link'=>$getLink
       ]);
       }else{
        abort('404');
       }
       
    }
    public function detail($link)
    {
        $data=Link::where('shortlink',$link)->with('hit')->first();
        if($data)
        {
        return view('mylink',[
        'data'=>$data
        ]);
        }else{
            abort(404);
        }
    }
    public function cek(Request $req)
    {
        if($req->get('shortlink'))
        {
            $validate=Validator::make($req->all(),[
                'shortlink'=>'required|unique:links|alpha_dash'
            ]);
            if($validate->fails())
            {
                return response()->json([
                    'status'=>'error',
                    'msg'=>$validate->messages()
                ]);
            }else{
                return response()->json([
                    'status'=>'success',
                    'msg'=>'Lolos Validasi'
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelinkRequest  $request
     * @param  \App\Models\link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelinkRequest $request, link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(link $link)
    {
        //
    }
}
