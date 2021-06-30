<?php

namespace App\Http\Controllers\API;

use App\Invitations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvitationsController extends Controller
{
    public function store(Request $request)
    {
        $invitation = new Invitations([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'country' => $request->input('country'),
            'programs' => $request->input('programs'),
        ]);
        $invitation->save();

        return response()->json('Success!');
    }
}
