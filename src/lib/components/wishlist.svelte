<script>
</script>

<div class="wish-container">
	<slot>Should contain wishes</slot>
</div>

<style>
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
		overflow-y: auto;
		overflow-x: hidden;
		scrollbar-gutter: stable;
	}

	/* Responsive tweaks */
	@media (max-width: 900px) {
		.wish-container {
			grid-template-columns: 1fr;
		}
	}
</style>
