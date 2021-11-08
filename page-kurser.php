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
	<main id="main" class="site-main filter-main">
    <nav id="filtrering"><button class="filter" data-cat="alle"> Alle </button>
		</nav> 
		<div id="liste" ></div>

        <template>
                <article >
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
            const url_test = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/kursus"
            const catUrl = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/omrde";

            let data, categories;
            let filter = "alle"

            const url = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/kursus"
            // Rest API Call
                async function loadJSON() {
                        const JSONData = await fetch(url);
                        const catJSONData = await fetch(catUrl);
                        categories = await catJSONData.json()
                    data = await JSONData.json();
                    vis(data);
                    opretKnapper();
                }

                function vis() {

                    const retterTemplate = document.querySelector("template");
                    const container = document.querySelector("#liste")

                    container.textContent ="";

                    data.forEach((el) => {
                        console.log(el)
                        if(filter === "alle" || el._institut.includes(filter)){
            
                        let klon = retterTemplate.cloneNode(true).content;
                        klon.querySelector(".navn").textContent = el._titel;
                        klon.querySelector("img").src = el._billede.guid;
                        klon.querySelector(".beskrivelse").textContent = el._info_tekst;
                
            
                        //Appender alle elementerne
                        container.appendChild(klon);
                        }
                        })
                    }

                function opretKnapper() {
                    categories.forEach(el => {
                        document.querySelector("#filtrering").innerHTML +=`<button class="filter" data-cat="${el.name}">${el.name}</button>`

                        
                    })
                    addEventlistenersToButtons()
                }

                function addEventlistenersToButtons() {
                    document.querySelectorAll("#filtrering button").forEach( el => {
                        
                        el.addEventListener("click", filtrering);
                        
                    })
                }
                function filtrering() {
                    filter = this.dataset.cat;
                    console.log(filter)
                    vis()
                }

                loadJSON();
        </script>

	</main>
</div>
<?php
get_footer();