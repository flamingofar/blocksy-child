<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blocksy
 */

get_header();
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main">
		
		<section class="single_section">
			<div class="text">
				<h2 class="navn">DET VI TILBYDER</h2>
				<h3 class="navn"></h3>
				<img src="#" alt="" />
			</div>
			<div class="details_container">
				<div class="details">
					<div class="icon"></div>
					<p class="varighed"></p>
				</div>
				<div class="details">
					<div class="icon"></div>
					<p class="pris"></p>
				</div>
				<div class="details">
					<div class="icon"></div>
					<p class="antal"></p>
				</div>
			</div>
		</section>

		<script>
			/** @format */
			const url = "http://testsite.test/wp-json/wp/v2/ret/" + <?php echo get_the_ID() ?>;

			let kursus;
			
			// Rest API Call
			async function loadJSON() {
				const JSONData = await fetch(url);
				kursus = await JSONData.json();
				
				vis();
			}

			function vis() {
                document.querySelector(".navn").textContent = kursus.titel;
                document.querySelector(".beskrivelse").innerHTML = kursus.beskrivelse;
                document.querySelector(".pris").textContent = `${kursus.pris}kr`;
				document.querySelector(".antal").textContent = `${kursus.antal_deltagere}kr`;
				document.querySelector(".varihed").textContent = `${kursus.varighed}kr`;
				
			}
			loadJSON()
			</script>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();