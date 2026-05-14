<?php
/**
 * Travel Vlogger Theme - Admin Panel
 * Menu personnalisé et panneau de configuration
 */

if (!defined('ABSPATH')) {
    exit;
}

// Ajouter le menu personnalisé
function travel_vlogger_admin_menu() {
    add_menu_page(
        'Travel Vlogger',
        'Travel Vlogger',
        'manage_options',
        'travel-vlogger-settings',
        'travel_vlogger_settings_page',
        'dashicons-globe',
        58
    );

    // Sous-menus
    add_submenu_page(
        'travel-vlogger-settings',
        'Paramètres Généraux',
        'Paramètres Généraux',
        'manage_options',
        'travel-vlogger-settings',
        'travel_vlogger_settings_page'
    );

    add_submenu_page(
        'travel-vlogger-settings',
        'Couleurs',
        'Couleurs',
        'manage_options',
        'travel-vlogger-colors',
        'travel_vlogger_colors_page'
    );

    add_submenu_page(
        'travel-vlogger-settings',
        'Démo',
        'Démo',
        'manage_options',
        'travel-vlogger-demo',
        'travel_vlogger_demo_page'
    );
}
add_action('admin_menu', 'travel_vlogger_admin_menu');

// Page Paramètres Généraux
function travel_vlogger_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Accès refusé');
    }

    // Sauvegarder les paramètres
    if (isset($_POST['travel_vlogger_nonce']) && wp_verify_nonce($_POST['travel_vlogger_nonce'], 'travel_vlogger_save')) {
        update_option('travel_vlogger_logo', esc_url($_POST['travel_vlogger_logo'] ?? ''));
        update_option('travel_vlogger_tagline', sanitize_text_field($_POST['travel_vlogger_tagline'] ?? ''));
        update_option('travel_vlogger_posts_per_page', intval($_POST['travel_vlogger_posts_per_page'] ?? 9));
        update_option('travel_vlogger_grid_columns', intval($_POST['travel_vlogger_grid_columns'] ?? 3));
        update_option('travel_vlogger_show_sidebar', isset($_POST['travel_vlogger_show_sidebar']));
        update_option('travel_vlogger_show_excerpt', isset($_POST['travel_vlogger_show_excerpt']));
        echo '<div class="notice notice-success"><p>✅ Paramètres sauvegardés !</p></div>';
    }

    $logo = get_option('travel_vlogger_logo', '');
    $tagline = get_option('travel_vlogger_tagline', '');
    $posts_per_page = get_option('travel_vlogger_posts_per_page', 9);
    $grid_columns = get_option('travel_vlogger_grid_columns', 3);
    $show_sidebar = get_option('travel_vlogger_show_sidebar', 1);
    $show_excerpt = get_option('travel_vlogger_show_excerpt', 1);
    ?>
    <div class="wrap">
        <h1>🌍 Travel Vlogger - Paramètres Généraux</h1>

        <div class="travel-vlogger-dashboard">
            <form method="POST" action="">
                <?php wp_nonce_field('travel_vlogger_save', 'travel_vlogger_nonce'); ?>

                <div class="travel-vlogger-section">
                    <h2>📸 Logo et Identité</h2>

                    <div class="form-group">
                        <label for="travel_vlogger_logo">URL du Logo</label>
                        <input type="text" name="travel_vlogger_logo" id="travel_vlogger_logo" 
                               value="<?php echo esc_attr($logo); ?>" class="regular-text" />
                        <p class="description">Entrez l'URL complète de votre logo (ex: https://example.com/logo.png)</p>
                    </div>

                    <div class="form-group">
                        <label for="travel_vlogger_tagline">Tagline (Sous-titre)</label>
                        <input type="text" name="travel_vlogger_tagline" id="travel_vlogger_tagline" 
                               value="<?php echo esc_attr($tagline); ?>" class="regular-text" 
                               placeholder="Explorez le monde avec nous" />
                        <p class="description">Aparaîtra sous le titre du site</p>
                    </div>
                </div>

                <div class="travel-vlogger-section">
                    <h2>📝 Blog</h2>

                    <div class="form-group">
                        <label for="travel_vlogger_posts_per_page">Articles par page</label>
                        <input type="number" name="travel_vlogger_posts_per_page" id="travel_vlogger_posts_per_page" 
                               value="<?php echo intval($posts_per_page); ?>" min="1" max="50" />
                    </div>

                    <div class="form-group">
                        <label for="travel_vlogger_grid_columns">Colonnes de la grille</label>
                        <select name="travel_vlogger_grid_columns" id="travel_vlogger_grid_columns">
                            <option value="1" <?php selected($grid_columns, 1); ?>>1 colonne</option>
                            <option value="2" <?php selected($grid_columns, 2); ?>>2 colonnes</option>
                            <option value="3" <?php selected($grid_columns, 3); ?>>3 colonnes</option>
                            <option value="4" <?php selected($grid_columns, 4); ?>>4 colonnes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="travel_vlogger_show_sidebar" 
                                   <?php checked($show_sidebar, 1); ?> />
                            Afficher la barre latérale
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="travel_vlogger_show_excerpt" 
                                   <?php checked($show_excerpt, 1); ?> />
                            Afficher les extraits des articles
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="button button-primary">💾 Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .travel-vlogger-dashboard {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .travel-vlogger-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .travel-vlogger-section:last-child {
            border-bottom: none;
        }
        .travel-vlogger-section h2 {
            margin-top: 0;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            max-width: 400px;
        }
    </style>
    <?php
}

// Page Couleurs
function travel_vlogger_colors_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Accès refusé');
    }

    // Sauvegarder
    if (isset($_POST['travel_vlogger_nonce']) && wp_verify_nonce($_POST['travel_vlogger_nonce'], 'travel_vlogger_save')) {
        update_option('travel_vlogger_primary_color', sanitize_hex_color($_POST['travel_vlogger_primary_color'] ?? '#FF6B6B'));
        update_option('travel_vlogger_secondary_color', sanitize_hex_color($_POST['travel_vlogger_secondary_color'] ?? '#4A90E2'));
        update_option('travel_vlogger_text_color', sanitize_hex_color($_POST['travel_vlogger_text_color'] ?? '#333333'));
        update_option('travel_vlogger_footer_bg', sanitize_hex_color($_POST['travel_vlogger_footer_bg'] ?? '#1a1a1a'));
        echo '<div class="notice notice-success"><p>✅ Couleurs sauvegardées !</p></div>';
    }

    $primary = get_option('travel_vlogger_primary_color', '#FF6B6B');
    $secondary = get_option('travel_vlogger_secondary_color', '#4A90E2');
    $text = get_option('travel_vlogger_text_color', '#333333');
    $footer_bg = get_option('travel_vlogger_footer_bg', '#1a1a1a');
    ?>
    <div class="wrap">
        <h1>🎨 Travel Vlogger - Couleurs</h1>

        <div class="travel-vlogger-dashboard">
            <form method="POST" action="">
                <?php wp_nonce_field('travel_vlogger_save', 'travel_vlogger_nonce'); ?>

                <div class="form-group">
                    <label for="travel_vlogger_primary_color">Couleur Primaire</label>
                    <input type="color" name="travel_vlogger_primary_color" id="travel_vlogger_primary_color" 
                           value="<?php echo esc_attr($primary); ?>" />
                    <p class="description">Utilisée pour les boutons et accents</p>
                </div>

                <div class="form-group">
                    <label for="travel_vlogger_secondary_color">Couleur Secondaire</label>
                    <input type="color" name="travel_vlogger_secondary_color" id="travel_vlogger_secondary_color" 
                           value="<?php echo esc_attr($secondary); ?>" />
                </div>

                <div class="form-group">
                    <label for="travel_vlogger_text_color">Couleur du Texte</label>
                    <input type="color" name="travel_vlogger_text_color" id="travel_vlogger_text_color" 
                           value="<?php echo esc_attr($text); ?>" />
                </div>

                <div class="form-group">
                    <label for="travel_vlogger_footer_bg">Fond du Pied de Page</label>
                    <input type="color" name="travel_vlogger_footer_bg" id="travel_vlogger_footer_bg" 
                           value="<?php echo esc_attr($footer_bg); ?>" />
                </div>

                <div class="form-group">
                    <button type="submit" class="button button-primary">💾 Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .travel-vlogger-dashboard {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input[type="color"] {
            width: 100px;
            height: 50px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <?php
}

// Page Démo
function travel_vlogger_demo_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Accès refusé');
    }

    // Importer la démo
    if (isset($_POST['import_demo']) && wp_verify_nonce($_POST['travel_vlogger_nonce'], 'travel_vlogger_save')) {
        travel_vlogger_import_demo();
        echo '<div class="notice notice-success"><p>✅ Démo importée avec succès !</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>📦 Travel Vlogger - Démo</h1>

        <div class="travel-vlogger-dashboard">
            <h2>Importer le contenu de démonstration</h2>
            <p>Cliquez sur le bouton ci-dessous pour importer 6 articles de voyage + 3 catégories.</p>

            <form method="POST" action="">
                <?php wp_nonce_field('travel_vlogger_save', 'travel_vlogger_nonce'); ?>
                <button type="submit" name="import_demo" class="button button-primary button-large" 
                        onclick="return confirm('Êtes-vous sûr ? Cela créera 6 articles et 3 catégories.')">
                    🚀 Importer la Démo
                </button>
            </form>

            <hr style="margin: 30px 0;">

            <h3>Qu'est-ce qui sera importé ?</h3>
            <ul style="list-style: disc; margin-left: 20px;">
                <li>6 articles de blog sur les destinations (Paris, Bangkok, Tanzanie, Barcelone, Bali, Maroc)</li>
                <li>3 catégories (Europe, Asie, Afrique)</li>
                <li>Contenu formaté et prêt à utiliser</li>
                <li>Images exemple (à remplacer)</li>
            </ul>
        </div>
    </div>

    <style>
        .travel-vlogger-dashboard {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>
    <?php
}

// Fonction pour importer la démo
function travel_vlogger_import_demo() {
    // Créer les catégories
    $categories = array(
        'europe' => array('name' => 'Europe', 'description' => 'Destinations en Europe'),
        'asie' => array('name' => 'Asie', 'description' => 'Destinations en Asie'),
        'afrique' => array('name' => 'Afrique', 'description' => 'Destinations en Afrique'),
    );

    $cat_ids = array();
    foreach ($categories as $slug => $cat) {
        $result = wp_insert_term($cat['name'], 'category', array(
            'description' => $cat['description'],
            'slug' => $slug,
        ));
        if (!is_wp_error($result)) {
            $cat_ids[$slug] = $result['term_id'];
        }
    }

    // Articles de démo
    $articles = array(
        array(
            'title' => 'Découvrez Paris en 3 Jours',
            'content' => 'Paris, la capitale française, est l\'une des destinations les plus visitées au monde. Avec ses monuments iconiques comme la Tour Eiffel, Notre-Dame, et le Louvre, Paris offre une expérience inoubliable. <h2>Les incontournables</h2><ul><li>La Tour Eiffel</li><li>Le Louvre</li><li>Les Champs-Élysées</li><li>Montmartre</li></ul><p>Visitez Paris au printemps ou en automne pour profiter du meilleur climat.</p>',
            'excerpt' => 'La Ville Lumière vous appelle avec ses monuments historiques et sa gastronomie exceptionnelle.',
            'category' => 'europe',
        ),
        array(
            'title' => 'Bangkok : Le Cœur de la Thaïlande',
            'content' => 'Bangkok est la capitale vibrante de la Thaïlande, célèbre pour ses marchés flottants, ses temples bouddhistes et sa vie nocturne animée. <h2>À voir absolument</h2><ul><li>Grand Palais Royal</li><li>Wat Arun (Temple de l\'Aube)</li><li>Marché flottant de Damnoen Saduak</li></ul><p>La nourriture de rue à Bangkok est mondialement réputée. Essayez le pad thai et les mango sticky rice.</p>',
            'excerpt' => 'Temples bouddhistes, street food délicieuse et vie nocturne vibrante vous attendent à Bangkok.',
            'category' => 'asie',
        ),
        array(
            'title' => 'Safari en Tanzanie : Une Expérience Inoubliable',
            'content' => 'La Tanzanie est l\'une des destinations de safari les plus spectaculaires d\'Afrique. <h2>Parcs nationaux</h2><ul><li>Serengeti National Park</li><li>Cratère du Ngorongoro</li><li>Tarangire National Park</li></ul><p>Observez les "Big Five" : lions, éléphants, buffles, léopards et rhinocéros. La saison sèche (juin à octobre) est idéale pour les safaris.</p>',
            'excerpt' => 'Partez à la découverte de la faune africaine lors d\'un safari inoubliable en Tanzanie.',
            'category' => 'afrique',
        ),
        array(
            'title' => 'Barcelone : Architecture et Plages',
            'content' => 'Barcelone combine l\'architecture moderniste, les plages magnifiques et l\'ambiance méditerranéenne. <h2>Attractions principales</h2><ul><li>Sagrada Familia</li><li>Park Güell</li><li>Casa Batlló</li><li>Montjuïc</li></ul><p>La cuisine catalane est réputée mondialement. Goûtez la paella et les tapas. Visitez en mai ou septembre pour éviter les foules.</p>',
            'excerpt' => 'Les œuvres de Gaudí et les plages méditerranéennes font de Barcelone une destination unique.',
            'category' => 'europe',
        ),
        array(
            'title' => 'Bali : L\'île des Dieux',
            'content' => 'Bali est une île indonésienne qui fascine avec ses temples hindous, ses traditions anciennes et sa beauté naturelle époustouflante. <h2>Lieux incontournables</h2><ul><li>Tanah Lot (temple sur la roche)</li><li>Tegallalang Rice Terraces</li><li>Ubud Arts Market</li><li>Mont Batur</li></ul><p>Découvrez les traditions hindoues balinaises. Yoga, méditation, surf et plongée sont parmi les activités populaires.</p>',
            'excerpt' => 'Temples sacrés, rizières magnifiques et plages paradisiaques vous attendent à Bali.',
            'category' => 'asie',
        ),
        array(
            'title' => 'Le Maroc : Entre Désert et Méditerranée',
            'content' => 'Le Maroc offre une diversité remarquable : des medinas historiques, des palais magnifiques, et le désert du Sahara. <h2>Villes à explorer</h2><ul><li>Marrakech - la "ville rouge"</li><li>Fès - médina ancienne</li><li>Casablanca - modernité côtière</li><li>Merzouga - porte du désert</li></ul><p>Balade à dos de chameau, nuit dans un riad traditionnel. La meilleure période est octobre à avril.</p>',
            'excerpt' => 'Explorez les souks colorés et traversez les dunes du Sahara dans ce pays envoûtant.',
            'category' => 'afrique',
        ),
    );

    // Créer les articles
    foreach ($articles as $article) {
        $post_id = wp_insert_post(array(
            'post_title' => $article['title'],
            'post_content' => $article['content'],
            'post_excerpt' => $article['excerpt'],
            'post_status' => 'publish',
            'post_type' => 'post',
        ));

        if ($post_id && isset($cat_ids[$article['category']])) {
            wp_set_post_categories($post_id, array($cat_ids[$article['category']]));
        }
    }
}

// CSS personnalisé basé sur les options
function travel_vlogger_theme_options_css() {
    $primary = get_option('travel_vlogger_primary_color', '#FF6B6B');
    $secondary = get_option('travel_vlogger_secondary_color', '#4A90E2');
    $text = get_option('travel_vlogger_text_color', '#333333');
    $footer_bg = get_option('travel_vlogger_footer_bg', '#1a1a1a');

    $css = "<style>
        :root {
            --tv-primary-color: {$primary};
            --tv-secondary-color: {$secondary};
            --tv-text-color: {$text};
            --tv-footer-bg: {$footer_bg};
        }
        body {
            color: {$text};
        }
        .btn-primary, .button-primary {
            background-color: {$primary} !important;
        }
        .btn-primary:hover, .button-primary:hover {
            background-color: {$secondary} !important;
        }
        .site-footer {
            background-color: {$footer_bg} !important;
        }
        a {
            color: {$primary};
        }
        a:hover {
            color: {$secondary};
        }
    </style>";

    echo $css;
}
add_action('wp_head', 'travel_vlogger_theme_options_css');
add_action('admin_head', 'travel_vlogger_theme_options_css');

?>