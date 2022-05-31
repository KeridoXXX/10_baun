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
		<img class="billede1" src="" alt="">
		<img class="billede2" src="" alt="">
		<img class="billede3" src="" alt="">
		<h2></h2>
		<p class="top-beskrivelse"></p>
		<p class="top-pris"></p>
		
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
		// console.log(topSingular.title.rendered)
		// console.log(topSingular.billede1.guid)
		document.querySelector(".billede1").src = topSingular.billede1.guid;
		document.querySelector(".billede2").src = topSingular.billede2.guid;
		document.querySelector(".billede3").src = topSingular.billede3.guid;
	}



	getJson();

</script>

<?php get_footer(); ?>
