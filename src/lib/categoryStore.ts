import { writable } from 'svelte/store';

export type Categories = 'Home' | 'Electronics' | 'Tools' | '3dPrint' | 'Clothes';
export let categories: Categories[] = ['Home', 'Electronics', 'Tools', '3dPrint', 'Clothes'];
export const selectedCategory = writable<Record<Categories, boolean>>({
  Home: true,
  Electronics: true,
  Tools: true,
  '3dPrint': true,
  Clothes: true
});
