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


<section id="pants-loopview"></section>
</main>
<template class="pants-template">
	<article>
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
			clone.querySelector(".pant-beskrivelse").textContent = pant.title.rendered;
			clone.querySelector(".pant-pris").textContent = pant.pris;
			clone.querySelector("article").addEventListener("click", ()=> {
				location.href = pant.link;
			})
			pantsLoopview.appendChild(clone);
					

			})

		}
		
	getJsonPants();

</script>

<?php get_footer(); ?>
