<?php

/*
Plugin Name: Animace
Description: Rozšíření na přidávání animací. Obsahuje knihovnu GSAP, která je hostována a načtena přes cdnjs.com. Tyto scripty nejsou fyzickou součástí rozšíření, pouze se na ně odkazuje. Povolením rozšíření souhlasíte s <a target="_blank" rel="noopener noreferrer nofollow" href="https://greensock.com/standard-license/">podmínkami použití</a> a přijímáte veškerou odpovědnost – včetně rizika nedostupnosti skriptu, zranitelnosti a ztráty dat.
Version: 1.0.0
Author: Michal Gerz
*/




// -----------------------------------------------------------
// Přidání knihoven GSAP
function theme_gsap_script() {
    // Základní GSAP soubor
    wp_enqueue_script('gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js', array(), false, false);
    // ScrollTrigger
    wp_enqueue_script('gsap-st', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js', array('gsap-js'), false, false);
}
add_action('wp_enqueue_scripts', 'theme_gsap_script');


// -----------------------------------------------------------
// Přidání druhého scriptu s nastavením backendu
include 'backend.php';


// -----------------------------------------------------------
// Přidání scriptu do patičky stránek s obsahem, který je vyplněn v adminu

add_action('init', function(){

    if (get_option('g3__animace_plugin_options')['js']) {

        add_action( 'wp_footer', function(){
            echo '
            <script>

                document.addEventListener("DOMContentLoaded", function() {
                    ' . get_option('g3__animace_plugin_options')['js'] . '
                });

            </script>
            ';
        }, 9999 );

    }

});