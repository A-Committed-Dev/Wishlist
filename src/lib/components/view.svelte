<div class="view-container">
	<slot>all content in view is here</slot>
</div>

<style>
	:global(html),
	:global(body) {
		height: 100%;
		width: 100%;
		margin: 0;
	}

	.view-container {
		font-family: Arial, Helvetica, sans-serif;
		height: 100%;
		width: 100%;
		padding: 1rem;
		box-sizing: border-box;
		background-color: #e3ecfc;
		display: flex;
		flex-direction: column;
	}

	@media (max-width: 900px) {
		.view-container {
			padding: 0.5rem;
		}
	}
</style>
