<script lang="ts">
	import Wish from './wish.svelte';
	import { type IWish, wishes, selectedWish } from '$lib/wishStore';

	export let wish: IWish;
	const oldWish = wish;

	async function pushWishes() {
		try {
			const res = await fetch('http://localhost:8000/wishUpdate.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify({ wishes: $wishes })
			});

			if (!res.ok) {
				const err = await res.json().catch(() => ({}));
				throw new Error(err.error || `HTTP ${res.status}`);
			}
		} catch (err) {
			console.error('Failed to sync wishes:', err);
		}
	}

	function updateWish() {
		$wishes[$wishes.indexOf(oldWish)] = wish;
		$wishes = [...$wishes]; // trigger reactivity
		pushWishes();
		closeEditor();
	}

	function deleteWish() {
		$wishes.splice($wishes.indexOf(oldWish), 1);
		$wishes = [...$wishes]; // trigger reactivity
		pushWishes();
		closeEditor();
	}

	function closeEditor() {
		$selectedWish = null;
	}
</script>

<!-- svelte-ignore a11y-click-events-have-key-events -->
<!-- svelte-ignore a11y-no-static-element-interactions -->
<div class="wish-edit-backdrop" onclick={closeEditor}>
	<div class="wish-edit-container" onclick={(e) => e.stopPropagation()}>
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
			<button class="wish-edit-button close-button" onclick={closeEditor}>Close</button>
		</div>
	</div>
</div>

<style>
	.wish-edit-container {
		display: flex;
		width: 90%;
		height: 90%;
		max-width: 800px;
		max-height: 1500px;
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

	.close-button {
		background: #ffffff;
		color: #000000;
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

	@media (max-width: 900px) {
		.wish-edit-container {
			flex-direction: column;
			align-items: center;
		}

		.wish-edit-button-container {
			flex-direction: row;
		}
	}
</style>
