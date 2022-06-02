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

<main id="bikinis-main">

<h2 class="shop-title">Bikinis</h2>
<section id="bikinis-loopview"></section>
</main>
<template class="bikinis-template">
	<article class="article-loop">
		<img src="" alt="">
		<h2></h2>
		<p class="beskrivelse"></p>
		<p class="pris"></p>
	</article>
</template>

<script>

	let bikinis;
	const dbUrlBikini = "https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/bikini";

	async function getJsonBikini() {
		let topData = await fetch(dbUrlBikini);
		bikinis = await topData.json();

		showBikinis();
	}

	function showBikinis() {
		let bikiniLoopview = document.querySelector("#bikinis-loopview");
		let bikiniTemplate = document.querySelector(".bikinis-template");
		console.log(bikinis)
		bikinis.forEach(bikini=> { 
			const clone = bikiniTemplate.cloneNode(true).content;
			clone.querySelector("h2").textContent = bikini.title.rendered;
			clone.querySelector("img").src = bikini.billede1.guid;
			clone.querySelector(".beskrivelse").textContent = bikini.bikini_navn;
			clone.querySelector(".pris").textContent = "kr " +  bikini.pris;
			clone.querySelector("article").addEventListener("click", ()=> {
				location.href = bikini.link;
			})
			bikiniLoopview.appendChild(clone);
					

			})

		}
		
	getJsonBikini();

</script>

<?php get_footer(); ?>
