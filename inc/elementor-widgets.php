<?php
/**
 * Widgets Elementor - VERSION STABLE
 */

if (!defined('ELEMENTOR_VERSION')) {
    return;
}

// Vérifier que Elementor est chargé
if (!class_exists('\Elementor\Widget_Base')) {
    return;
}

// Widget 1: Video Hero
class TV_Video_Hero_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'tv_video_hero';
    }

    public function get_title() {
        return 'Video Hero';
    }

    public function get_icon() {
        return 'eicon-video-camera';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            ['label' => 'Contenu']
        );

        $this->add_control(
            'video_url',
            [
                'label' => 'URL Vidéo',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://www.youtube.com/watch?v=...',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'Titre',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Mon Voyage',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => 'Description',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Découvrez mes aventures',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $url = !empty($settings['video_url']['url']) ? $settings['video_url']['url'] : '';
        ?>
        <div class="video-hero">
            <?php if ($url) : ?>
                <div class="video-hero-wrapper">
                    <iframe width="100%" height="600" src="<?php echo esc_url($url); ?>" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
            <?php endif; ?>
            <div class="video-hero-content">
                <h1><?php echo esc_html($settings['title']); ?></h1>
                <p><?php echo esc_html($settings['description']); ?></p>
            </div>
        </div>
        <?php
    }
}

// Enregistrer les widgets
function tv_register_elementor_widgets($widgets_manager) {
    if (!class_exists('TV_Video_Hero_Widget')) {
        return;
    }
    
    try {
        $widgets_manager->register(new TV_Video_Hero_Widget());
    } catch (\Exception $e) {
        error_log('Erreur Elementor: ' . $e->getMessage());
    }
}

add_action('elementor/widgets/register', 'tv_register_elementor_widgets');

// Enregistrer la catégorie
function tv_register_elementor_category($elements_manager) {
    $elements_manager->add_category(
        'travel-vlogger',
        [
            'title' => 'Travel Vlogger',
            'icon' => 'fa fa-globe',
        ]
    );
}

add_action('elementor/elements/categories_registered', 'tv_register_elementor_category');

// CSS Elementor
function travel_vlogger_elementor_styles() {
    if (defined('ELEMENTOR_PATH')) {
        wp_enqueue_style('travel-vlogger-elementor', TRAVEL_VLOGGER_THEME_URI . '/css/elementor-integration.css', array(), TRAVEL_VLOGGER_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'travel_vlogger_elementor_styles');

?>