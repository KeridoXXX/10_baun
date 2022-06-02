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

<main id="pants-main">

<h2 class="shop-title">Pants</h2>
<section id="pants-loopview"></section>
</main>
<template class="pants-template">
	<article class="article-loop">
		<img src="" alt="">
		<h2></h2>
		<p class="pant-beskrivelse"></p>
		<p class="pant-pris"></p>
	</article>
</template>

<script>

	let pants;
	const dbUrlPants = "https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/pant";

	async function getJsonPants() {
		let topData = await fetch(dbUrlPants);
		pants = await topData.json();

		showPants();
	}

	function showPants() {
		let pantsLoopview = document.querySelector("#pants-loopview");
		let pantsTemplate = document.querySelector(".pants-template");
		console.log(pants)
		pants.forEach(pant=> { 
			const clone = pantsTemplate.cloneNode(true).content;
			clone.querySelector("h2").textContent = pant.title.rendered;
			clone.querySelector("img").src = pant.billede1.guid;
			clone.querySelector(".pant-beskrivelse").textContent = pant.pant_navn;
			clone.querySelector(".pant-pris").textContent = "kr " + pant.pris;
			clone.querySelector("article").addEventListener("click", ()=> {
				location.href = pant.link;
			})
			pantsLoopview.appendChild(clone);
					

			})

		}
		
	getJsonPants();

</script>

<?php get_footer(); ?>
