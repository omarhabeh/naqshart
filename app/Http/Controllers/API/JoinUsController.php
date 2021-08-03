<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArtistRequest as RequestsCreateArtistRequest;
use Illuminate\Http\Request;
use App\Models\Appliedartist;
use App\Models\joinus_Text;
use Illuminate\Support\Facades\Validator;
use App\Mail\joinusNotification;
use Illuminate\Support\Facades\Mail;
class JoinUsController extends Controller
{
        /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function get_join_content(){
      $data=joinus_Text::latest()->first();
      return response()->json(['data'=>$data]);
    }
    public function crete_request(RequestsCreateArtistRequest $request)
    {
          $applied =  Appliedartist::create($request->only(['name','email','phone','socialLink']));
          if($applied)
          {
            Mail::to($request->email)->send(new joinusNotification($request->name));
            return response()->json(['status'=>true,'data'=>$applied]);

          }else{
            return response()->json(['status'=>false,'eroors'=>['wrong in saving data']]);

          }
    }
}
