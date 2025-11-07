<script>
</script>

<div class="wish-container-outside">
	<div class="wish-container-scroll">
		<div class="wish-container">
			<slot>Should contain wishes</slot>
		</div>
	</div>
</div>

<style>
	.wish-container-outside {
		width: 100%;
		height: 100%;
		border-radius: 1em;
		overflow: hidden;
		padding-top: 1em;
		background-color: transparent;
		box-sizing: border-box;
	}

	.wish-container-scroll {
		border-radius: 1em;
		overflow: hidden;
		height: 100%;
		width: 100%;
	}

	.wish-container {
		border-radius: 1em;
		background-color: #ffffff;
		width: 100%;
		height: 100%;
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
		grid-auto-rows: min-content;
		gap: 2em;
		padding: 2em;
		justify-items: center;
		box-sizing: border-box;
		overflow-x: hidden;
		overflow-y: scroll;
	}

	/* Responsive tweaks */
	@media (max-width: 900px) {
		.wish-container {
			grid-template-columns: 1fr;
			padding: 1em;
			grid-auto-rows: 70%;
		}

		.wish-container-outside {
			padding-top: 0.5em;
		}
	}
</style>
