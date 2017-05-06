<?php

namespace App\Http\Controllers;

use App\Gossip;
use Illuminate\Http\Request;

class GossipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Gossip::with('user','user.socialaccounts')->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['anonymous'] = $request['anonymous'] ? 1 : 0;

        $this->validate(request(),[
         'body' => 'required',
         'anonymous' => 'boolean',
         ]);

        auth()->user()->publish(
            new Gossip(request(['body','anonymous']))
            );

        return Gossip::with('user','user.socialaccounts')->latest()->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\gossip  $gossip
     * @return \Illuminate\Http\Response
     */
    public function show(gossip $gossip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\gossip  $gossip
     * @return \Illuminate\Http\Response
     */
    public function edit(gossip $gossip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gossip  $gossip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gossip $gossip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\gossip  $gossip
     * @return \Illuminate\Http\Response
     */
    public function destroy(gossip $gossip)
    {
        //
    }
}
