<?php
/**
 * CodeGPT Settings class
 */
class CodeGPT_Settings extends WP_Settings_Page {
    /**
     * Constructor
     */
    public function __construct() {
        $this->id           = 'codegpt-settings';
        $this->label        = 'CodeGPT Settings';
        $this->option_group = 'codegpt_settings_group';
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_menu', array( $this, 'create_menu' ) );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        register_setting(
            $this->option_group,
            'codegpt_api_key',
            array( $this, 'sanitize_api_key' )
        );
        add_settings_section(
            'codegpt_api_settings',
            'CodeGPT API Settings',
            array( $this, 'render_api_settings_section' ),
            $this->id
        );
        add_settings_field(
            'codegpt_api_key',
            'CodeGPT API Key',
            array( $this, 'render_api_key_field' ),
            $this->id,
            'codegpt_api_settings'
        );
    }

    /**
     * Sanitize API key
     */
    public function sanitize_api_key( $value ) {
        return sanitize_text_field( $value );
    }

    /**
     * Render API settings section
     */
    public function render_api_settings_section() {
        echo '<p>Enter your CodeGPT API key to enable the plugin functionality.</p>';
    }

    /**
     * Render API key field
     */
    public function render_api_key_field() {
        $value = get_option( 'codegpt_api_key' );
        echo '<input type="text" name="codegpt_api_key" value="' . esc_attr( $value ) . '" />';
    }
}

new CodeGPT_Settings();