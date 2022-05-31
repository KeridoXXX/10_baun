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

<nav class="filtermenu">
	<button class="btn1" data-top=10>All tops</button>
	<button class="btn2" data-top=8>Tank top</button>
	<button class="btn3" data-top=7>One shoulder</button>
	<button class="btn4" data-top=9>Long sleeve</button>

</nav>
<section id="tops-loopview"></section>
</main>
<template>
	<article>
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


	const dbUrl = "https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/top?per_page=13";
	const catUrl ="https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/categories";

	

	async function getJson() {
		let topData = await fetch(dbUrl);
		let catData = await fetch(catUrl);
		tops = await topData.json();
		categories = await catData.json();
		showTops();
		btnEvent();
	}

	// function makeBtn() {
	// 	categories.forEach(cat =>{
	// 		document.querySelector(".filtermenu").innerHTML += `<button class="filter" data-top="${cat.id}">${cat.name}</button>`
	// 	})
	// }

	// FUCK DET HER ^

	function btnEvent() {
		document.querySelectorAll(".filtermenu button").forEach(elm =>{
			elm.addEventListener("click", filterTops);
		})
	}

	function filterTops() {
		filterTop = this.dataset.top;
		showTops();
	}


	function showTops() {
		let loopview = document.querySelector("#tops-loopview");
		let template = document.querySelector("template");
		console.log("dataset id til filtrering:", filterTop)
		console.log(tops)
		loopview.innerHTML = "";
		tops.forEach(top=> { 
			if (top.categories.includes(parseInt(filterTop))){


			const clone = template.cloneNode(true).content;


			clone.querySelector("h2").textContent = top.title.rendered;
			clone.querySelector("img").src = top.billede1.guid;
			clone.querySelector(".top-beskrivelse").textContent = top.title.rendered;
			clone.querySelector(".top-pris").textContent = top.pris;


			clone.querySelector("article").addEventListener("click", ()=> {
				location.href = top.link;
			})
			
			
			loopview.appendChild(clone);
				}	

			})

		}
		



	getJson();

</script>

<?php get_footer(); ?>
