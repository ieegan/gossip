<template>
	<div class="box">
		<article class="media">
			<div class="media-content">
				<div class="content">
					<p>
						<strong><slot name="name">Anonymous</slot></strong> <small>34m</small>
						<br>
						<slot></slot>
					</p>
				</div>
				<nav class="level is-mobile">
					<div class="level-left">
						<a class="level-item">
							<span class="icon is-small"><i class="fa fa-reply"></i></span>
						</a>
						<a class="level-item">
							<span class="icon is-small"><i class="fa fa-retweet"></i></span>
						</a>
						<a class="level-item">
							<span class="icon is-small"><i class="fa fa-heart"></i></span>
						</a>
					</div>
				</nav>
			</div>
		</article>
	</div>
</template>