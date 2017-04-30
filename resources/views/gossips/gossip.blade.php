<div class="gossip">
	<p class="gossip-meta">
		by 
		@if ($gossip->anonymous)
		Anonymous
		@else
		{{ $gossip->user->name }}
		@endif
		 on {{ $gossip->created_at->toFormattedDateString() }}
	</p>
	<p class="gossip-body">
		{{ $gossip->body }}
	</p>
</div>

