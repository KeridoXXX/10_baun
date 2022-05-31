<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="dresses-main">


<section id="dresses-loopview"></section>
</main>
<template class="dresses-template">
	<article>
		<img src="" alt="">
		<h2></h2>
		<p class="beskrivelse"></p>
		<p class="pris"></p>
	</article>
</template>

<script>

	let dresses;
	const dbUrlDress = "https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/dress";

	async function getJsonDresses() {
		let topData = await fetch(dbUrlDress);
		dresses = await topData.json();

		showdresses();
	}

	function showdresses() {
		let dressLoopview = document.querySelector("#dresses-loopview");
		let dressTemplate = document.querySelector(".dresses-template");
		console.log(dresses)
		dresses.forEach(dress=> { 
			const clone = dressTemplate.cloneNode(true).content;
			clone.querySelector("h2").textContent = dress.title.rendered;
			clone.querySelector("img").src = dress.billede1.guid;
			clone.querySelector(".beskrivelse").textContent = dress.title.rendered;
			clone.querySelector(".pris").textContent = dress.pris;
			clone.querySelector("article").addEventListener("click", ()=> {
				location.href = dress.link;
			})
			dressLoopview.appendChild(clone);
					

			})

		}
		
	getJsonDresses();

</script>

<?php get_footer(); ?>
