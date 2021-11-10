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
    <nav id="filtrering"><button class="filter valgt" data-cat="alle"> Alle </button>
		</nav> 
        <form>
<select id="selectFilter" name="dropdown">
    <option value="alle" selected>Alle</option>
</select>
</form>
		<div id="liste" ></div>

        

        <template>
                <article class="loop_click">
                    <div class="name">
                        <img src="#" alt="" />
                    </div>
                            
                    <div class="details">
                        <div>
                        <h2 class="navn"></h2>
                        <div class="tags">
                            <span class="institut_1 institut"></span>
                            <span class="institut_2 institut"></span>
                            <span class="fag_1 fag"></span>
                            <span class="fag_2 fag"></span>
                        </div>

                        </div>
                        
                        <p class="beskrivelse"></p>

                        <div>
                            <button class="se_mere">Se Mere</button>
                        </div>
                    </div>
                </article>
        </template>

        <script>
           

            let dataWP, categories, tema;
            let filter = "alle"
            let filterTema = "alle"

            const temaUrl = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/tema?per_page=40";
            const catUrl = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/omrde?per_page=40";
            const url = "https://malteskjoldager.dk/kea/2.Semester/Tema_9/ungebyen/wp-json/wp/v2/kursus?per_page=40"
            // Rest API Call
                async function loadJSON() {
                    const JSONData = await fetch(url);
                    const catJSONData = await fetch(catUrl);
                    const temaJSONData = await fetch(temaUrl);
                    tema = await temaJSONData.json()
                    categories = await catJSONData.json()
                    dataWP = await JSONData.json();
                    vis(dataWP);
                    console.log(dataWP)
                    opretKnapper();
                    opretSelects();
                }

                function vis() {

                    const kursusTemplate = document.querySelector("template");
                    const container = document.querySelector("#liste")
                    container.textContent ="";

                    dataWP.forEach((el) => {
                        if((filter == "alle" || el._institut.includes(filter)) && (filterTema == "alle" || el._tema[0].toLowerCase().includes(filterTema)) ) {
                            

                            
                            
                    

            
                        let klon = kursusTemplate.cloneNode(true).content;
                        klon.querySelector("img").src = el._billede.guid;
                        klon.querySelector(".navn").textContent = el._titel;
                        klon.querySelector(".institut_1").textContent = el._institut[0];
                        klon.querySelector(".institut_2").textContent = el._institut[1];
                        klon.querySelector(".fag_1").textContent = el._skole_fag[0];
                        klon.querySelector(".fag_2").textContent = el._skole_fag[1];

                        klon.querySelector(".beskrivelse").textContent = el._info_tekst;
                        klon
							.querySelector(".loop_click")
							.addEventListener("click", () => {
							location.href = el.link
								});
                
            
                        //Appender alle elementerne
                        container.appendChild(klon);
                        }
                        })
                    }

// ----------- OPRET KNAPPER ----------- //
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

// ----------- OPRET SELECTS ----------- //
                function opretSelects() {
                    tema.forEach(el => {
                        document.querySelector("#selectFilter").innerHTML +=`<option value = "${el.name.toLowerCase()}" selected>${el.name}</option>`

                        
                    })
                    addEventlistenersSelects()
                }

                function addEventlistenersSelects() {
                    document.querySelectorAll("#selectFilter").forEach( el => {
                        
                        el.addEventListener("change", filtreringTema);
                        
                    })
                }

// ----------- FILTRERING NORMAL ----------- //
                function filtrering() {
                    filter = this.dataset.cat.toString();

                    document.querySelectorAll("#filtrering .filter").forEach(elm => {
                        
                        elm.classList.remove("valgt");
                        });
                    //tilføj .valgt til den valgte
                        this.classList.add("valgt");

                    vis()
                }

// ----------- FILTRERING TEMA ----------- //
                function filtreringTema() {
                    // filterTema = this.value.toLowerCase();
                    filterTema = document.querySelector("#selectFilter").value;

                    console.log(filterTema)

                    vis()
                }
                loadJSON();
        </script>

	</main>
</div>
<?php
get_footer();