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

<main id="main">

	<article class="single-top">
		<div class="col-left">
				<img class="billede1" src="" alt="">
				<img class="billede2" src="" alt="">
				<img class="billede3" src="" alt="">
		</div>
		<div class="col-right">
			<h2></h2>
			<h3></h3>
			<p class="top-beskrivelse"></p>
			<p class="top-pris"></p>
			<div class="sizes">
				<button class="small">S</button>
				<button class="medium">M</button>
				<button class="large">L</button>
			</div>
			<p>All bodies are perfect - <a href="https://lehmannen.dk/kea/10_baun/size-guide/">see our sizeguide</a></p>
			
			<p> 20% Nylon 80% Elastene <br> Designed in Denmark by Alberte Muff</p>
			<p>The model is 183cm and wears a size M</p>
			<img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/05/1280px-Chris_Hemsworth_Signature.png" alt="">
		</div>
	</article>

</main>




<script>

	let topSingular;
	 //let id = <?php echo get_the_ID()?>;

	async function getJson() {
		console.log("id er:", <?php echo get_the_ID()?> )
		//console.log(id)
		let jsonData = await fetch("https://lehmannen.dk/kea/10_baun/wp-json/wp/v2/top/<?php echo get_the_ID()?>");
		topSingular = await jsonData.json();
		showTopSingular();
	}

	function showTopSingular() {
		console.log(topSingular)
		document.querySelector(".billede1").src = topSingular.billede1.guid;
		document.querySelector(".billede2").src = topSingular.billede2.guid;
		document.querySelector(".billede3").src = topSingular.billede3.guid;
		document.querySelector("h2").textContent = topSingular.title.rendered;
		document.querySelector(".top-beskrivelse").textContent = topSingular.title.rendered;
		document.querySelector(".top-pris").textContent = topSingular.pris;
	}



	getJson();

</script>

<?php get_footer(); ?>
