<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvtarRequest;
use Illuminate\Support\Facades\Storage;

class AvtarController extends Controller
{
    //
    public function update(UpdateAvtarRequest $request) {
        //return back()->with(['message'=>'Avtar save success']);
        //dd($request->all());
        
        //Method-new
        $path = Storage::disk('public')->put('avtars',$request->file('avtar'));
        //Method-old
        //$path = $request->file('avtar')->store('avtars','public');

        if($oldAvtar = $request->user()->avtar)
        {
            Storage::disk('public')->delete($oldAvtar);
        }

        auth()->user()->update(['avtar'=>"$path"]);
        return redirect(route('profile.edit'))->with('message','Avtar image updated !!');
    }
}
