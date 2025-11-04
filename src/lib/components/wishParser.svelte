<script lang="ts">
	import Wish from './wish.svelte';
	let url = '';
	let images: string[] = [];
	let text: string[] = [];
	let title: string | null = null;

	let selectedImage: any;
	let selectedTitle: any;
	let desc = '';

	function handleParagraphClick(event: MouseEvent) {
		const target = event.target as HTMLElement;
		if (!target) return;

		const paragraph = target.closest('p') as HTMLParagraphElement | null;

		if (!paragraph) {
			console.log('No paragraph found nearby.');
			return;
		}

		const text = paragraph.textContent?.trim() || '';
		console.log('Selected paragraph text:', text);

		selectedTitle = text;
	}

	function handleImageClick(event: MouseEvent) {
		const target = event.target as HTMLElement;

		if (!target) return;

		const img = target.closest('img') as HTMLImageElement | null;

		if (!img) {
			console.log('No image found nearby.');
			return;
		}

		const src = img.src;
		console.log('Selected image src:', src);

		selectedImage = src;
	}

	function createWish() {
		if (!selectedImage || !selectedTitle || !desc || !url) {
			alert('Please select an image, title, enter a URL and description');
			return;
		}

		const wish = {
			url,
			imgUrl: selectedImage,
			title: selectedTitle,
			desc
		};

		console.log('Wish created:', wish);

		selectedImage = '';
		selectedTitle = '';
		desc = '';
		url = '';
		images = [];
		text = [];
		title = null;
	}

	async function fetchWebsite() {
		if (!url) return;

		const res = await fetch(`http://127.0.0.1:8000/fetch.php?url=${encodeURIComponent(url)}`);
		const data: { html?: string; error?: string } = await res.json();

		if (data.error) {
			console.error('PHP error:', data.error);
			return;
		}

		if (data.html) {
			// Parse HTML in browser
			const parser = new DOMParser();
			const doc = parser.parseFromString(data.html, 'text/html');

			// Extract images
			images = Array.from(doc.querySelectorAll('img')).map((img) => img.src);

			// Get the <title> tag text
			const titleTag = doc.querySelector('title');
			title = titleTag ? titleTag.textContent?.trim() || null : null;

			// Extract all text
			text = Array.from(doc.querySelectorAll('h1, h2, h3, h4, h5, h6'))
				.map((h) => h.textContent?.trim() || '')
				.filter(Boolean);
		}
	}
</script>

<div class="container">
	<div class="sub-container">
		<div class="input">
			<input
				type="text"
				bind:value={url}
				placeholder="Enter website URL"
				class="desc input-search"
			/>
			<button onclick={fetchWebsite} class="create-button input-button">Fetch</button>
		</div>
		<div class="images" onclick={handleImageClick}>
			<h3>Images:</h3>
			{#each images as src}
				<img {src} width="150" />
			{/each}
		</div>
		<div class="headings" onclick={handleParagraphClick}>
			<h3>Headings:</h3>
			<p>{title}</p>
			{#each text as heading}
				<p>{heading}</p>
			{/each}
		</div>
	</div>

	<div class="creation-container">
		<h3>Preview:</h3>
		<div class="preview">
			<div class="wish-limiter">
				<Wish {url} imgUrl={selectedImage} {desc} title={selectedTitle}></Wish>
			</div>
		</div>
		<h3>Description:</h3>
		<textarea class="desc" bind:value={desc}></textarea>
		<button class="create-button" onclick={createWish}>Create wish</button>
	</div>
</div>

<style>
	.container {
		width: 100%;
		height: 100%;
		display: flex;
		gap: 1em;
		font-family:
			system-ui,
			-apple-system,
			'Segoe UI',
			Roboto,
			'Helvetica Neue',
			Arial;
	}

	.creation-container {
		width: 30%;
		height: 100%;
		display: flex;
		flex-direction: column;
		background-color: #ffffff;
		border-radius: 1em;
		align-items: center;
		box-sizing: border-box;
		padding: 2em;
		gap: 1em;
	}
	.creation-container h3 {
		align-self: flex-start;
	}

	.preview {
		width: 100%;
		height: 50%;
		background-color: #f5f5f5;
		padding: 2em;
		border-radius: 1em;
		box-sizing: border-box;
		display: flex;
		align-items: center;
		justify-content: center;
		overflow: hidden;
	}

	.wish-limiter {
		width: 100%;
		max-width: 350px;
	}

	.desc {
		background-color: #f5f5f5;
		border-style: none;
		border-radius: 1em;
		width: 100%;
		height: 30%;
		box-sizing: border-box;
		padding: 2em;
		resize: none;
		outline: none;
		font-size: 20px;
		font-family:
			system-ui,
			-apple-system,
			'Segoe UI',
			Roboto,
			'Helvetica Neue',
			Arial;
	}

	.create-button {
		text-decoration: none;
		text-align: center;
		padding: 10px 12px;
		border-radius: 8px;
		font-weight: 600;
		font-size: 13px;
		border: 1px solid transparent;
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

	.create-button:hover,
	.create-button:focus {
		transform: translateY(-2px);
		box-shadow: 0 10px 20px rgba(11, 110, 253, 0.18);
	}
	.sub-container {
		display: flex;
		flex-direction: column;
		gap: 1em;
		width: 70%;
		height: 100%;
	}

	.headings {
		background-color: #ffffff;
		border-radius: 1em;
		width: 100%;
		height: 45%;
		box-sizing: border-box;
		padding: 2em;
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
		grid-auto-rows: min-content;
		gap: 2em;
		overflow-y: scroll;
		overflow-x: hidden;
	}

	.title {
		background-color: #ffffff;
		border-radius: 1em;
		width: 100%;
		height: 10%;
		box-sizing: border-box;
		padding: 2em;
	}

	.images {
		background-color: #ffffff;
		border-radius: 1em;
		width: 100%;
		height: 45%;
		box-sizing: border-box;
		padding: 2em;
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
		grid-auto-rows: min-content;
		gap: 2em;
		overflow-y: scroll;
		overflow-x: hidden;
	}

	.images img:hover {
		background-color: #f2f2f2;
		padding: 2em;
		box-sizing: border-box;
		border-radius: 1em;
	}
	.headings p:hover {
		background-color: #f2f2f2;
		box-sizing: border-box;
		padding: 1em;
		border-radius: 1em;
	}
	.input {
		background-color: #ffffff;
		border-radius: 1em;
		width: 100%;
		height: 10%;
		box-sizing: border-box;
		padding: 2em;
		display: grid;
		align-content: center;
		justify-content: center;
		place-items: center;
		grid-template-columns: 90% 1fr;
		gap: 1em;
	}

	.input-button {
		margin-top: 0;
		height: 80%;
		border-radius: 1em;
	}

	.input-search {
		text-overflow: ellipsis;
		overflow: hidden;
	}
</style>
