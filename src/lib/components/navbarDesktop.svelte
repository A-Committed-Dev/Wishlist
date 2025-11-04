<script lang="ts">
	let categories: Array<string> = ['Home', 'Electronics', 'Tools', '3dPrint', 'Cloths'];
	let maxPrice: number = 50;
</script>

<div class="navbar">
	<h1 class="nav-title">Claus's Wishlist</h1>

	<div class="nav-checkboxes">
		<h3>Categories</h3>
		{#each categories as category}
			<div class="checkbox-item">
				<label for={category}>{category}</label>
				<input type="checkbox" id={category} name={category} checked />
			</div>
		{/each}
	</div>

	<div class="price-slider">
		<h3>Max price</h3>
		<div class="price-display">{maxPrice} .kr</div>
		<input type="range" min="0" max="500" bind:value={maxPrice} />
	</div>
</div>

<style>
	.nav-title {
		font-size: 25px;
	}

	.navbar {
		border-radius: 1em;
		background-color: #ffffff;
		width: 20%;
		height: 100%;
		padding: 1em;
		box-sizing: border-box;
		margin-right: 1em;
		display: flex;
		flex-direction: column;
		gap: 1em;
		align-items: center;
		font-family:
			system-ui,
			-apple-system,
			'Segoe UI',
			Roboto,
			'Helvetica Neue',
			Arial;
		overflow-y: scroll;
		overflow-x: hidden;
	}

	.nav-checkboxes {
		background-color: #f2f2f2f2;
		border-radius: 1em;
		display: flex;
		flex-direction: column;
		gap: 1em;
		box-sizing: border-box;
		padding: 2em;
		width: 90%;

		align-items: center;
	}

	.price-slider {
		width: 100%;
		display: flex;
		flex-direction: column;
		align-items: center;
		background-color: #f2f2f2f2;
		border-radius: 1em;
		box-sizing: border-box;
		padding: 2em;
		width: 90%;
		height: 20%;
	}

	.price-display {
		font-size: 20px;
		color: #434343;
		margin-bottom: 0.5em;
	}

	input[type='range'] {
		width: 100%;
		accent-color: #689aef;
	}

	.checkbox-item {
		width: 100%;
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0.4em 0.6em;
		border-radius: 0.5em;
		transition: background 0.2s;
	}

	.checkbox-item:hover {
		background-color: #e6e6e6;
	}

	.checkbox-item label {
		font-size: 20px;
		color: #434343;
	}

	input[type='checkbox'] {
		width: 22px;
		height: 22px;
		cursor: pointer;
		accent-color: #689aef;
		border-radius: 2em;
	}
</style>
