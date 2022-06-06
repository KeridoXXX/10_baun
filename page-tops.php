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

<main id="tops-main">

<h2 class="shop-title1">All tops</h2>

<nav class="filtermenu">
	<button class="btn1" data-top=10>All tops</button>
	<button class="btn2" data-top=8>Tank top</button>
	<button class="btn3" data-top=7>One shoulder</button>
	<button class="btn4" data-top=9>Long sleeve</button>

</nav>
<section id="tops-loopview"></section>
</main>
<template>
	<article class="article-loop">
		<img src="" alt="">
		<h2></h2>
		<p class="top-beskrivelse"></p>
		<p class="top-pris"></p>
	</article>
</template>

<script>

	let tops;
	let categories;
	let filterTop = 10
	let title = document.querySelector(".shop-title1")


	const dbUrl = "https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/top?per_page=13";
	const catUrl ="https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/categories";

	
	// henter alle tops-posts i JSON
	async function getJson() {
		let topData = await fetch(dbUrl); // fetcher data fra endpoint
		let catData = await fetch(catUrl);
		tops = await topData.json(); 
		categories = await catData.json();
		showTops(); // kalder næste funktion 
		btnEvent();
	}

	// tilføjer en event på knapperne som laver filter
	function btnEvent() {
		document.querySelectorAll(".filtermenu button").forEach(elm =>{
			elm.addEventListener("click", filterTops);
		})
	}

	// løber showTops funktionen ud fra et filtreret dataset
	function filterTops() {
		filterTop = this.dataset.top;
		showTops();
		title.textContent = this.textContent;
	}


	// sætter indhold ind i en template som vi kloner for hver beklædningsgenstand 
	function showTops() {

		let loopview = document.querySelector("#tops-loopview"); // definere variabler
		let template = document.querySelector("template"); // definere variabler
 
		console.log("dataset id til filtrering:", filterTop) // logger kategorier
		console.log(tops) // logger array

		loopview.innerHTML = ""; // tømmer vores loopview evt tidligere appendede kloner 

		tops.forEach(top=> { 
			if (top.categories.includes(parseInt(filterTop))){ // if statement der definere filtrering efter en kategori 
			const clone = template.cloneNode(true).content;
			clone.querySelector("h2").textContent = top.title.rendered; // indsætter dataen
			clone.querySelector("img").src = top.billede1.guid;
			clone.querySelector(".top-beskrivelse").textContent = top.top_navn;
			clone.querySelector(".top-pris").textContent = "kr " + top.pris; 
			clone.querySelector("article").addEventListener("click", ()=> {
				location.href = top.link; // click event der leder til singleview
			})
			loopview.appendChild(clone); // appender (tilføjer) det klonede content til loopview
				}	

			})

		}
		



	getJson();

</script>

<?php get_footer(); ?>
