import { writable } from 'svelte/store';
import type { Categories } from './categoryStore';

export interface IWish {
  url: string;
  imgUrl: string;
  title: string;
  desc: string;
  category: Categories;
  id: string;
}

export const wishes = writable<IWish[]>([]);

export const selectedWish = writable<IWish | null>(null);
