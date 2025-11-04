<script>
	import Navbar from '$lib/components/navbar.svelte';
	import NavbarDesktop from '$lib/components/navbarDesktop.svelte';
	import View from '$lib/components/view.svelte';
	import Wish from '$lib/components/wish.svelte';
	import Wishlist from '$lib/components/wishlist.svelte';
</script>

<View>
	<div style="display: flex; height: 100%; width: 100%;">
		<NavbarDesktop></NavbarDesktop>
		<Wishlist>
			<Wish></Wish>
			<Wish></Wish>
			<Wish></Wish>
		</Wishlist>
	</div>
</View>
