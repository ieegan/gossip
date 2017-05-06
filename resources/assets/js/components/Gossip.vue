<template>
	<div class="box">
		<article class="media">
			<div class="media-content">
				<div class="content">
					<p>
						<strong><slot name="name">Anonymous</slot></strong> <small><slot name="time"></slot></small>
						<br>
						<slot></slot>
					</p>
				</div>
			</div>
		</article>
	</div>
</template>