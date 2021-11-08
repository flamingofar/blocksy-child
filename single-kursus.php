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
			<h2 class="navn">Hej</h2>
			<article class="ret" style="cursor: initial">
				<img src="#" alt="" />

				<div class="details">
					<p class="kort"></p>

					<div class="single-details">
						<p class="beskrivelse"></p>
						<div class="pris">-</div>
					</div>
				</div>
			</article>
			<button>Tilbage</button>
		</section>

		<script>
			/** @format */
			const url = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/kursus/" + <?php echo get_the_ID() ?>;

			let kursus;
			
			// Rest API Call
			async function loadJSON() {
				const JSONData = await fetch(url);
				kursus = await JSONData.json();
				console.log(kursus)
				vis();
			}

			function vis() {
                // document.querySelector(".navn").textContent = ret.titel;
                // document.querySelector("article img").src = ret.billede.guid;
                // document.querySelector(".beskrivelse").textContent = ret.beskrivelse;
                // document.querySelector(".pris").textContent = `${ret.pris}kr`;

				document.querySelector(".single_section button").addEventListener("click", () => {
					console.log("hej")
					history.back();
				});
			}
			loadJSON()
			</script>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();