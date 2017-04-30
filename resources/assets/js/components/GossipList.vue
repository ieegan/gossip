<template>

	<div>
		<gossip v-for="gossip in gossips" :key="gossip.id">
			<template slot="name" v-if="!gossip.anonymous">
				{{ gossip.user.name }}
				<ul v-if="gossip.user.socialaccounts">
					<li v-for="socialaccount in gossip.user.socialaccounts">
						<a target="_blank" :href="'https://www.facebook.com/' + socialaccount.provider_user_id" v-if="socialaccount.provider === 'FacebookProvider'">Facebook</a>
						<a target="_blank" :href="'https://twitter.com/intent/user?user_id=' + socialaccount.provider_user_id" v-else-if="socialaccount.provider === 'TwitterProvider'">Twitter</a>
					</li>
				</ul>
			</template>
			{{ gossip.body }}
		</gossip>
	</div>

</template>

<script>

	export default {
		methods: {
			fetchGossips() {
				var self = this;
				axios.post('/show-gossip', {
					page: self.page
				})
				.then(function (response) {
					console.log(response);
					self.gossips = response.data.data
					self.page++
				})
				.catch(function (error) {
					console.log(error);
				});
			}
		},
		data() {
			return {
				page: 0,
				gossips: []
			};
		},
		mounted: function(){
			this.fetchGossips();
		}
	}
</script>