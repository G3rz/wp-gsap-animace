<?php

if (!defined('WPINC')) {
    die;
}


//-----------------------------------------------------------
// Přidání nové položky do admin menu

add_action('admin_menu', function () {
    add_options_page('Nastavení animací', '[G3] - Animace', 'manage_options', 'g3-animace', 'g3__animace_render_plugin_settings_page');
});


//-----------------------------------------------------------
// Obsah navěšený na novou položku v admin menu

function g3__animace_render_plugin_settings_page() {
    ?>
    <h1>[G3] - Animace | Nastavení</h1>
    <p style="margin-bottom: 64px;"><small><u>&editace</u> je možná přes parametr</small></p>
    <form action="options.php" method="post">
        <?php
settings_fields('g3__animace_plugin_options');
    do_settings_sections('g3__animace_plugin');?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save');?>" />
    </form>
<?php
}

//-----------------------------------------------------------
// Registrace nových záznamů do wp_options

function g3__animace_register_settings() {
    register_setting('g3__animace_plugin_options', 'g3__animace_plugin_options');

    add_settings_section('animace_settings', 'Nastavení obsahu', 'g3__animace_plugin_section_text', 'g3__animace_plugin');

    add_settings_field('g3__animace_plugin_setting_js', 'JS', 'g3__animace_plugin_setting_js', 'g3__animace_plugin', 'animace_settings');


}
add_action('admin_init', 'g3__animace_register_settings');


//-----------------------------------------------------------
//Tvorba polí

function g3__animace_plugin_section_text() {
    echo '<p>Zde je možné vyplnit JS obsah, který se bude na stránce zpracovávat.</p>';
}

function g3__animace_plugin_setting_js() {
    $options = get_option('g3__animace_plugin_options');
    $editace = $_GET['editace'];
    echo '<textarea rows="20" ' . (isset($editace) ? '' : 'disabled') . ' style="width:max(300px,70%);" id="g3__animace_plugin_setting_js" name="g3__animace_plugin_options[js]">' . esc_attr($options['js']) . '</textarea>';
}