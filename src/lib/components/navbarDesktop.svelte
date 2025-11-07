<script lang="ts">
	import { selectedCategory, categories } from '$lib/categoryStore';
	let maxPrice: number = 50;
</script>

<div class="navbar-outside">
	<div class="navbar">
		<div class="nav-checkboxes">
			<h3>Categories</h3>
			{#each categories as category}
				<div class="checkbox-item">
					<label for={category}>{category}</label>
					<input
						type="checkbox"
						id={category}
						name={category}
						bind:checked={$selectedCategory[category]}
					/>
				</div>
			{/each}
		</div>

		<!-- <div class="price-slider"> -->
		<!-- 	<h3>Max price</h3> -->
		<!-- 	<div class="price-display">{maxPrice} .kr</div> -->
		<!-- 	<input type="range" min="0" max="500" bind:value={maxPrice} /> -->
		<!-- </div> -->
	</div>
</div>

<style>
	.navbar-outside {
		width: 20%;
		height: 100%;
		border-radius: 1em;
		overflow: hidden;
		padding-right: 1em;
		padding-top: 1em;
		background-color: transparent;
		box-sizing: border-box;
	}
	.navbar {
		border-radius: 1em;
		background-color: #ffffff;
		width: 100%;
		height: 100%;
		padding: 2em;
		box-sizing: border-box;
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

	@media (max-width: 1500px) {
		.navbar {
			position: fixed;

			width: calc(100% - 2rem);
			height: calc(91% - 2rem);

			z-index: 1000;

			background-color: rgba(255, 255, 255, 0.95);
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
		}
	}
</style>
