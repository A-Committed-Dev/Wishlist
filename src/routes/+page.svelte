<script lang="ts">
	import { onMount } from 'svelte';
	import Navbar from '$lib/components/navbar.svelte';
	import NavbarDesktop from '$lib/components/navbarDesktop.svelte';
	import View from '$lib/components/view.svelte';
	import Wish from '$lib/components/wish.svelte';
	import Wishlist from '$lib/components/wishlist.svelte';
	import { selectedCategory, type Categories } from '$lib/categoryStore';

	let showNavbar = false;
	let screenWidth: number = 0;

	// Update screen width on resize
	function updateWidth() {
		screenWidth = window.innerWidth;
		if (screenWidth >= 1500) {
			showNavbar = true;
		} else {
			showNavbar = false;
		}
	}

	onMount(() => {
		fetchWishes();

		updateWidth();
		window.addEventListener('resize', updateWidth);
		return () => window.removeEventListener('resize', updateWidth);
	});

	interface Wish {
		url: string;
		imgUrl: string;
		title: string;
		desc: string;
		category: Categories;
	}
	let wishes: Wish[] = [];

	async function fetchWishes() {
		try {
			const response = await fetch('http://localhost:8000/wishStore.php'); // URL of your PHP script
			if (!response.ok) {
				throw new Error('Failed to fetch wishes');
			}

			const data = await response.json();
			// Access the wishes array from the wrapped object
			wishes = data.wishes;

			console.log('Fetched wishes:', wishes);

			return wishes;
		} catch (error) {
			console.error('Error fetching wishes:', error);
			return [];
		}
	}

	$: filteredWishes = wishes.filter((wish) => $selectedCategory[wish.category]);
</script>

<View>
	<Navbar bind:showNavbar />

	<div style="display: flex; height: 90%; width: 100%;">
		{#if showNavbar}
			<NavbarDesktop />
		{/if}

		<Wishlist>
			{#each filteredWishes as wish}
				<Wish
					imgUrl={wish.imgUrl}
					url={wish.url}
					desc={wish.desc}
					title={wish.title}
					id={wish.category}
				></Wish>
			{/each}
		</Wishlist>
	</div>
</View>
