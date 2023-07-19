<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Mail\MailToLead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all()); solo per testare

        // validare i dati del lead

        // salvare i dati del lead nel database
        $data = $request->all();

        $newLead = new Lead();
        $newLead->email = $data['email'];
        $newLead->name = $data['name'];
        $newLead->message = $data['message'];
        $newLead->newsletter = $data['newsletter'];
        $newLead->save();

        // inviare la mail al lead
        Mail::to($newLead->email)->send(new MailToLead($newLead));

        // inviare la mail all'amministratore per gestire la richiesta del lead

        // ritornare un valore di conferma al frontend
    }
    
}
