<template>

	<div>
		<gossip v-for="gossip in gossips" :key="gossip.id">
			<template slot="name" v-if="!gossip.anonymous">
				{{ gossip.user.name }}
				<ul class="socialaccount" v-if="gossip.user.socialaccounts">
					<li v-for="socialaccount in gossip.user.socialaccounts">
						<a class="FacebookProvider" target="_blank" :href="'https://www.facebook.com/' + socialaccount.provider_user_id" v-if="socialaccount.provider === 'FacebookProvider'"></a>
						<a class="TwitterProvider" target="_blank" :href="'https://twitter.com/intent/user?user_id=' + socialaccount.provider_user_id" v-else-if="socialaccount.provider === 'TwitterProvider'"></a>
					</li>
				</ul>
			</template>
			{{ gossip.body }}
		</gossip>
	</div>

</template>

<script>
	export default {
		props: ['gossips']
	}
</script>