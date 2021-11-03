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


?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div id="liste"></div>

        <template>
                <article>
                    <div class="name">
                        <h2 class="navn"></h2>
                        <img src="#" alt="" />
                    </div>
                            
                    <div class="details">
                        <p class="beskrivelse"></p>
                        <p class="pris"></p>
                    </div>
                </article>
        </template>

        <script>
            const url_test = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/child_themes/wp-json/pods/v1/pods/retter"

            async function testJSON() {
                const JSONData = await fetch(url_test);
                data = await JSONData.json()
                console.log(data)

            }
            testJSON()



            const url = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/child_themes/wp-json/wp/v2/retter"
            // Rest API Call
                async function loadJSON() {
                        const JSONData = await fetch(url);

                    wp_data = await JSONData.json();
                    vis(wp_data);
                }

                function vis(json) {
                    console.log(json)

                    const retterTemplate = document.querySelector("template");
                    const container = document.querySelector("#liste")

                    json.forEach((el) => {
            
                        let klon = retterTemplate.cloneNode(true).content;
                        klon.querySelector(".navn").textContent = el.title.rendered;
                        klon.querySelector("img").src = el.guid.rendered;
                        klon.querySelector(".beskrivelse").textContent = "";
                        // klon.querySelector(".pris").textContent = `Årgang: ${el.year}`;
                
            
                        //Appender alle elementerne
                        container.appendChild(klon);
                        })
                    }

                loadJSON();
        </script>

	</main>
</div>