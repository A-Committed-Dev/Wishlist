<script>
	export let showNavbar = false;

	function toggleNavbar() {
		if (showNavbar) {
			showNavbar = false;
		} else {
			showNavbar = true;
		}
	}
</script>

<div class="navbar">
	<button class="nav-burgermenu" onclick={toggleNavbar}>≡</button>
	<h1 class="nav-title">Claus's Wishlist</h1>
</div>

<style>
	.nav-title {
		font-size: 25px;
	}

	.nav-burgermenu {
		background-color: #f2f2f2f2;
		box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
		border-style: none;
		font-size: 25px;
		border-radius: 0.5em;
		width: 2em;
		height: 2em;
		box-sizing: border-box;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.nav-burgermenu:hover {
		background-color: #e6e6e6;
	}

	.navbar {
		border-radius: 1em;
		background-color: #ffffff;
		width: 100%;
		height: 10%;
		padding: 1em;
		box-sizing: border-box;
		margin-bottom: 1em;
		display: flex;
		flex-direction: row;
		gap: 2em;
		align-items: center;
	}
</style>
