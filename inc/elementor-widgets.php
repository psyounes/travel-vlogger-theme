<?php
/**
 * Widgets Elementor personnalisés
 */

if (!defined('ELEMENTOR_VERSION')) {
    return;
}

// Widget 1: Video Hero
class Travel_Vlogger_Video_Hero_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'travel_video_hero';
    }

    public function get_title() {
        return esc_html__('Video Hero', 'travel-vlogger');
    }

    public function get_icon() {
        return 'eicon-video-camera';
    }

    public function get_categories() {
        return ['travel-vlogger'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Contenu', 'travel-vlogger'),
        ]);

        $this->add_control('video_url', [
            'label'       => esc_html__('URL de la vidéo', 'travel-vlogger'),
            'type'        => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__('https://www.youtube.com/watch?v=...', 'travel-vlogger'),
        ]);

        $this->add_control('title', [
            'label'       => esc_html__('Titre', 'travel-vlogger'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__('Mon Incroyable Voyage', 'travel-vlogger'),
        ]);

        $this->add_control('description', [
            'label'   => esc_html__('Description', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('Découvrez mes aventures autour du monde', 'travel-vlogger'),
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('Style', 'travel-vlogger'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('text_color', [
            'label'   => esc_html__('Couleur du texte', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .video-hero-content' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('bg_color', [
            'label'   => esc_html__('Couleur de fond', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .video-hero' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $video_url = $settings['video_url']['url'] ?? '';
        ?>
        <div class="video-hero">
            <?php if ($video_url) : ?>
                <div class="video-hero-wrapper">
                    <iframe width="100%" height="600" src="<?php echo esc_url($video_url); ?>" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
            <?php endif; ?>
            <div class="video-hero-content">
                <?php if ($settings['title']) : ?>
                    <h1><?php echo wp_kses_post($settings['title']); ?></h1>
                <?php endif; ?>
                <?php if ($settings['description']) : ?>
                    <p><?php echo wp_kses_post($settings['description']); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

// Widget 2: Destination Card
class Travel_Vlogger_Destination_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'travel_destination';
    }

    public function get_title() {
        return esc_html__('Carte Destination', 'travel-vlogger');
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return ['travel-vlogger'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Contenu', 'travel-vlogger'),
        ]);

        $this->add_control('image', [
            'label'   => esc_html__('Image', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::MEDIA,
        ]);

        $this->add_control('destination_name', [
            'label'   => esc_html__('Nom de la destination', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Paris, France', 'travel-vlogger'),
        ]);

        $this->add_control('location', [
            'label'   => esc_html__('Localisation', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Europe', 'travel-vlogger'),
        ]);

        $this->add_control('description', [
            'label'   => esc_html__('Description', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('Une destination magnifique à découvrir', 'travel-vlogger'),
        ]);

        $this->add_control('button_text', [
            'label'   => esc_html__('Texte du bouton', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('En savoir plus', 'travel-vlogger'),
        ]);

        $this->add_control('button_url', [
            'label'   => esc_html__('URL du bouton', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::URL,
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('Style', 'travel-vlogger'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('overlay_color', [
            'label'   => esc_html__('Couleur de l\'overlay', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::COLOR,
            'default' => 'rgba(0, 0, 0, 0.5)',
            'selectors' => [
                '{{WRAPPER}} .destination-overlay' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image = $settings['image']['url'] ?? '';
        $button_url = $settings['button_url']['url'] ?? '#';
        ?>
        <div class="destination-card">
            <?php if ($image) : ?>
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($settings['destination_name']); ?>">
            <?php endif; ?>
            <div class="destination-overlay"></div>
            <div class="destination-content">
                <h3><?php echo wp_kses_post($settings['destination_name']); ?></h3>
                <p class="location"><?php echo esc_html($settings['location']); ?></p>
                <p class="description"><?php echo wp_kses_post($settings['description']); ?></p>
                <a href="<?php echo esc_url($button_url); ?>" class="btn-primary">
                    <?php echo esc_html($settings['button_text']); ?>
                </a>
            </div>
        </div>
        <?php
    }
}

// Widget 3: Travel Stats
class Travel_Vlogger_Stats_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'travel_stats';
    }

    public function get_title() {
        return esc_html__('Statistiques Voyage', 'travel-vlogger');
    }

    public function get_icon() {
        return 'eicon-number-field';
    }

    public function get_categories() {
        return ['travel-vlogger'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Contenu', 'travel-vlogger'),
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('number', [
            'label'   => esc_html__('Nombre', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => '150',
        ]);

        $repeater->add_control('label', [
            'label'   => esc_html__('Étiquette', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Pays visités', 'travel-vlogger'),
        ]);

        $this->add_control('stats', [
            'label'   => esc_html__('Statistiques', 'travel-vlogger'),
            'type'    => \Elementor\Controls_Manager::REPEATER,
            'fields'  => $repeater->get_controls(),
            'default' => [
                [
                    'number' => '150',
                    'label'  => esc_html__('Pays visités', 'travel-vlogger'),
                ],
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="travel-stats">
            <?php foreach ($settings['stats'] as $stat) : ?>
                <div class="stat-item">
                    <h3 class="stat-number"><?php echo esc_html($stat['number']); ?></h3>
                    <p class="stat-label"><?php echo esc_html($stat['label']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

// Enregistrer les widgets
function travel_vlogger_register_elementor_widgets() {
    \Elementor\Plugin::instance()->widgets_manager->register(new Travel_Vlogger_Video_Hero_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register(new Travel_Vlogger_Destination_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register(new Travel_Vlogger_Stats_Widget());
}
add_action('elementor/widgets/widgets_registered', 'travel_vlogger_register_elementor_widgets');

// Enregistrer la catégorie
function travel_vlogger_register_elementor_category() {
    \Elementor\Plugin::instance()->elements_manager->add_category(
        'travel-vlogger',
        [
            'title' => esc_html__('Travel Vlogger', 'travel-vlogger'),
            'icon'  => 'fa fa-globe',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'travel_vlogger_register_elementor_category');

?>