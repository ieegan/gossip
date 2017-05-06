@extends('layouts.app')

@section('content')
@if (Auth::guest())
<div class="box">
    <a href="/login" class="button is-primary">Login to start a gossip!</a>
</div>
@else
<div class="box">
    <h1 class="subtitle">Let's Gossip!</h1>

    <form method="post" action="/post-gossip" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

        <div class="field">
            <p class="control">
                <textarea name="body" class="textarea" id="body" rows="3" v-model="form.body"></textarea>

                <span class="help is-danger" v-text="form.errors.get('body')" v-if="form.errors.has('body')"></span>
            </p>
        </div>

        <div class="field">
            <p class="control">
                <label class="checkbox">
                    <input name="anonymous" type="checkbox" v-model="form.anonymous">
                    Post Anonymously
                </label>
            </p>
        </div>

        <div class="field">
            <p class="control">
                <button type="submit" class="button is-primary" :disabled="form.errors.any()">Send Gossip</button>
            </p>
        </div>

    </form>
</div>
@endif
<gossip-list :gossips="gossips"></gossip-list>
<div id="bottom" v-if="lastpagereached"></div>
@endsection
