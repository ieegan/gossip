@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
    <div class="box">
        <a href="/login" class="button is-primary">Login to start a gossip!</a>
    </div>
    @else
    <div class="box">
        <h1 class="subtitle">Let's Gossip!</h1>

        <form method="post" action="/post-gossip" @submit.prevent="popMessage">

            <div class="field">
                <p class="control">
                    <textarea name="body" class="textarea" id="body" rows="3" required="required" v-model="body"></textarea>
                </p>
            </div>

            <div class="field">
                <p class="control">
                    <label class="checkbox">
                        <input name="anonymous" type="checkbox" v-model="anonymous">
                        Post Anonymously
                    </label>
                </p>
            </div>

            <div class="field">
                <p class="control">
                    <button type="submit" class="button is-primary">Send Gossip</button>
                </p>
            </div>

        </form>
    </div>
    @endif
    <gossip-list></gossip-list>
</div>
@endsection
