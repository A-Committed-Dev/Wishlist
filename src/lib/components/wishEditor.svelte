<script lang="ts">
	import Wish from './wish.svelte';
	import { type IWish, wishes, selectedWish } from '$lib/wishStore';

	export let wish: IWish;
	const oldWish = wish;

	function updateWish() {
		$wishes[$wishes.indexOf(oldWish)] = wish;
		$selectedWish = null;
	}

	function deleteWish() {
		$wishes.splice($wishes.indexOf(oldWish), 1);
		$wishes = [...$wishes];
		$selectedWish = null;
	}
</script>

<div class="wish-edit-backdrop">
	<div class="wish-edit-container">
		<Wish
			edit={true}
			bind:category={wish.category}
			bind:title={wish.title}
			bind:desc={wish.desc}
			bind:imgUrl={wish.imgUrl}
			bind:id={wish.id}
		/>
		<div class="wish-edit-button-container">
			<button class="wish-edit-button delete-button" onclick={deleteWish}>Delete wish</button>
			<button class="wish-edit-button" onclick={updateWish}>Update wish</button>
		</div>
	</div>
</div>

<style>
	.wish-edit-container {
		display: flex;
		width: 35%;
		height: 80%;
		gap: 1em;
	}
	.wish-edit-backdrop {
		position: absolute;
		z-index: 1000;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100%;
		height: 100%;
		background-color: rgba(92, 92, 92, 0.8);
	}

	.wish-edit-button {
		text-decoration: none;
		text-align: center;
		padding: 1.2em;
		border-radius: 1em;
		font-weight: 600;
		font-size: 13px;
		border-style: none;
		transition:
			transform 120ms ease,
			box-shadow 120ms ease;
		background: #689aef;
		color: white;

		height: 8em;
		width: 8em;
		box-sizing: border-box;
		margin-top: auto;
		cursor: pointer;
	}

	.wish-edit-button:hover {
		transform: translateY(-2px);
	}

	.delete-button {
		background: #ef6868;
	}

	.wish-edit-button-container {
		margin-top: auto;
		gap: 1em;
		flex-direction: column;
		display: flex;
	}
</style>
