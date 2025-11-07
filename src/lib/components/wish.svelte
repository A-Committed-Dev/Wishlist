<script>
	import { categories } from '$lib/categoryStore';
	export let category = '';
	export let imgUrl = 'https://placehold.co/600x400/EEE/31343C';
	export let title = '';
	export let url = '';
	export let desc = '';
	export let id = '';
	export let edit = false;
	export let preview = false;
	export let deleteable = false;

	let changeUrl = false;
	let tmpDesc =
		"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";

	function changeUrlToggle() {
		changeUrl = !changeUrl;
	}
</script>

<div class="wish-card" {id}>
	{#if deleteable}
		<button class="wish-delete-button">X</button>
	{/if}

	{#if edit}
		<select class="wish-edit-category-box" name="category" bind:value={category}>
			<option value="" disabled selected hidden>Select a Category</option>
			{#each categories as category}
				<option value={category}>{category}</option>
			{/each}
		</select>
		{#if changeUrl}
			<input
				class="wish-edit-imgUrl"
				type="text"
				bind:value={imgUrl}
				placeholder="imgUrl:"
				autocomplete="off"
				autofocus
				onkeydown={(e) => {
					if (e.key === 'Enter' || e.key === 'Escape') changeUrlToggle();
				}}
			/>
		{/if}
		<img class={['wish-card-img', { edit }]} src={imgUrl} alt="Product" onclick={changeUrlToggle} />
		<div class="wish-card-body">
			<input
				class="wish-edit-title"
				type="text"
				bind:value={title}
				placeholder="Title:"
				autocomplete="off"
			/>
			<div class="wish-edit-outer">
				<textarea
					class="wish-edit-desc"
					rows="3"
					bind:value={desc}
					placeholder={tmpDesc}
					autocomplete="off"
				></textarea>
			</div>

			<a class="wish-card-button" href={url} aria-label="Find product">find her</a>
		</div>
	{:else}
		<img class="wish-card-img" src={imgUrl} alt="Product" />
		<div class="wish-card-body">
			<h3 class={['wish-card-title', { preview }]}>{title}</h3>
			<p class={['wish-card-desc', { preview }]}>{desc}</p>
			<a class="wish-card-button" href={url} aria-label="Find product">find her</a>
		</div>
	{/if}
</div>

<style>
	.wish-card {
		width: 100%;
		height: 100%;
		border-radius: 1em;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
		background: white;
		display: flex;
		flex-direction: column;
		font-family:
			system-ui,
			-apple-system,
			'Segoe UI',
			Roboto,
			'Helvetica Neue',
			Arial;
		position: relative;
	}

	.wish-card-img {
		width: 100%;
		height: 60%;
		display: block;
		object-fit: cover;
		border-top-left-radius: 1em;
		border-top-right-radius: 1em;
	}

	.wish-card-img.edit {
		cursor: pointer;
	}

	.wish-card-body {
		width: 100%;
		height: 40%;
		padding: 1em;
		display: flex;
		flex-direction: column;
		gap: 1em;
		flex-grow: 1;
		position: relative;
		box-sizing: border-box;
	}

	.wish-card-title {
		height: 20%;
		margin: 0;
		font-size: 20px;
		font-weight: 600;
		color: #111;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 6px;
	}

	.wish-card-title.preview {
		font-size: 25px;
	}

	.wish-card-desc {
		margin: 0;
		font-size: 14px;
		line-height: 1.35;
		color: #222;
		position: relative;
		display: flex;
		align-items: flex-start;
		justify-content: space-between;
		gap: 0.5em;
		overflow: hidden;
		overflow-y: scroll;
	}

	.wish-card-desc.preview {
		font-size: 20px;
	}

	.wish-card-button {
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
		box-shadow: 0 6px 12px rgba(11, 110, 253, 0.14);
		width: 100%;
		box-sizing: border-box;
		margin-top: auto;
	}

	.wish-card-button:hover,
	.wish-card-button:focus {
		transform: translateY(-2px);
		box-shadow: 0 10px 20px rgba(11, 110, 253, 0.18);
	}

	.wish-edit-title,
	.wish-edit-imgUrl,
	.wish-edit-desc {
		background-color: #f5f5f5;
		border-style: none;
		border-radius: 1em;
		width: 100%;
		height: 100%;
		box-sizing: border-box;
		padding: 1em;
		resize: none;
		outline: none;
		font-size: 18px;
		font-family:
			system-ui,
			-apple-system,
			'Segoe UI',
			Roboto,
			'Helvetica Neue',
			Arial;
	}

	.wish-edit-outer {
		height: 100%;
		width: 100%;
		overflow: hidden;
		border-radius: 1em;
		font-size: 18px;
	}

	.wish-edit-title {
		height: 20%;
		font-weight: bold;
		font-size: 20px;
	}

	.wish-edit-imgUrl {
		position: absolute;
		height: 10%;
		width: 90%;
		align-self: center;
		top: 25%;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
	}

	.wish-edit-category-box {
		position: absolute;
		top: 1em;
		right: 1em;
		border-style: none;
		background-color: #689aef;
		color: white;
		border-radius: 1em;
		padding: 1em;
		font-size: 16px;
		cursor: pointer;
	}

	.wish-delete-button {
		border-radius: 99%;
		background-color: red;
		color: #ffffff;
		padding: 0.5em;
		font-size: 20px;
		position: absolute;
		top: -1em;
		left: -1em;
		border-style: none;
	}
</style>
