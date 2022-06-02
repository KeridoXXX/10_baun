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

	<article class="single">
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
			<button class="køb"><a href="https://lehmannen.dk/kea/10_baun/cart/">Buy now!</a></button>
			<p> 20% Nylon 80% Elastene. <br> Designed in Denmark by Alberte Muff.</p>
			<p>The model is 183cm and wears a size M.</p>
			<img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/underskrift.png" alt="">
		</div>
	</article>
	<div class="instafeed-singleview">
			<h3 class="insta-title">Babes rocking the look!</h3>
			<div>
				<a href="https://www.instagram.com/accounts/login/?next=/baunbabes/"><img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/2F195F46-A241-4601-913F-ECEDA279F833-2.jpg" alt="pink top for insta feed"></a>
			</div>
			<div>			
				<a href="https://www.instagram.com/accounts/login/?next=/baunbabes/"><img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/IMG_5870-2.jpg" alt="another pink top for insta feed"></a>
			</div>
			<div>			
				<a href="https://www.instagram.com/accounts/login/?next=/baunbabes/"><img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/4DC4C452-C2E7-42CE-99DF-F08AD501083F-2.jpg" alt="yet another pink top for insta feed"></a>
			</div>
			<div>	
				<a href="https://www.instagram.com/accounts/login/?next=/baunbabes/"><img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/IMG_5467-2.jpg" alt="one more pink top for insta feed"></a>
			</div>
			<div>
				<a href="https://www.instagram.com/accounts/login/?next=/baunbabes/"><img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/6E321DCC-7DFC-46A3-BEA6-DC031012F1B6-2.jpg" alt="the last pink top for insta feed"></a>
			</div>
			<div class="insta-logo">
				<a href="https://www.instagram.com/accounts/login/?next=/baunbabes/"><img src="http://lehmannen.dk/kea/10_baun/wp-content/uploads/2022/06/image4-1.png" alt="BABES LOGO"></a>
			</div>
		</div>
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
		document.querySelector(".top-beskrivelse").textContent = topSingular.top_navn;
		document.querySelector(".top-pris").textContent = "kr " +  topSingular.pris;
		document.querySelector(".billede1").addEventListener("click", skiftBillede)
		document.querySelector(".billede2").addEventListener("click", skiftBillede)
		document.querySelector(".billede3").addEventListener("click", skiftBillede)
	}

	function skiftBillede() {
		console.log(this.src)
		const bigImg = document.querySelector(".billede1")
		const bigPic = bigImg.src;
		bigImg.src = this.src;
		this.src = bigPic;
	}

	getJson();

</script>

<?php get_footer(); ?>
