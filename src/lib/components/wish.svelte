<script>
	export let imgUrl = '';
	$: if (imgUrl === '') {
		imgUrl = 'https://placehold.co/600x400/EEE/31343C';
	}
	export let title = 'title';
	export let url = '';
	export let desc = '';
	$: if (desc === '') {
		desc =
			"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
	}
</script>

<div class="wish-card">
	<img class="wish-card-img" src={imgUrl} alt="Product" />
	<div class="wish-card-body">
		<h3 class="wish-card-title">{title}</h3>
		<p class="wish-card-desc">
			{desc}
		</p>
		<a class="wish-card-button" href={url} aria-label="Find product">find her</a>
	</div>
</div>

<style>
	.wish-card {
		width: 100%;
		height: 100%;
		border-radius: 12px;
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
	}

	.wish-card-img {
		width: 100%;
		height: 15vw;
		display: block;
		object-fit: cover;
		border-top-left-radius: 12px;
		border-top-right-radius: 12px;
	}

	.wish-card-body {
		padding: 12px 14px 18px;
		display: flex;
		flex-direction: column;
		gap: 10px;
		flex-grow: 1;
	}

	.wish-card-title {
		margin: 0;
		font-size: 20px;
		font-weight: 600;
		color: #111;
	}

	.wish-card-desc {
		margin: 0;
		font-size: 14px;
		line-height: 1.35;
		color: #222;
		min-height: 2.6em;
	}

	.wish-card-button {
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

	.wish-card-button:hover,
	.wish-card-button:focus {
		transform: translateY(-2px);
		box-shadow: 0 10px 20px rgba(11, 110, 253, 0.18);
	}
</style>
