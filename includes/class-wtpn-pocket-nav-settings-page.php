<?php

/**
 * Class WTPN_Pocket_Nav_Settings_Page
 *
 * This class controls all the cycle at the settings page.
 */

class WTPN_Pocket_Nav_Settings_Page {

    public function __construct() {

        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'init_settings'  ) );

    }

    /**
     * Add Admin Settings Menu
     */
    public function add_admin_menu() {

        add_options_page(
            esc_html__( 'WordsTree Pocket Navigator', 'wtpn_pocket_nav' ),
            esc_html__( 'WTPN Settings', 'wtpn_pocket_nav' ),
            'manage_options',
            'wtpn-pocket-nav',
            array( $this, 'wtpn_page_layout' )
        );

    }

    public function init_settings() {

        register_setting(
            'wtpn_settings_group',
            'wtpn_pocket_nav_settings'
        );

        add_settings_section(
            'wtpn_pocket_nav_settings_section',
            '',
            false,
            'wtpn_pocket_nav_settings'
        );

        add_settings_field(
            'wtpn_pocket_nav_client_key',
            'Consumer Key',
            array( $this, 'render_wtpn_pocket_nav_client_key_field' ),
            'wtpn_pocket_nav_settings',
            'wtpn_pocket_nav_settings_section'
        );

    }

    public function wtpn_page_layout() {

        // Check required user capability
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wtpn_pocket_nav' ) );
        }

        // Admin Page Layout
        echo '<div class="wrap">';
        echo '	<h1>' . get_admin_page_title() . '</h1>';
        echo '	<form action="options.php" method="post">';

        settings_fields( 'wtpn_settings_group' );
        do_settings_sections( 'wtpn_pocket_nav_settings' );
        submit_button();

        echo '	</form>';
        echo '</div>';

    }

    function render_wtpn_pocket_nav_client_key_field() {

        // Retrieve data from the database.
        $options = get_option( 'wtpn_pocket_nav_settings' );

        // Set default value.
        $value = isset( $options['wtpn_pocket_nav_consumer_key'] ) ? $options['wtpn_pocket_nav_consumer_key'] : '';

        // Field output.
        echo '<input type="text" name="wtpn_pocket_nav_settings[wtpn_pocket_nav_consumer_key]" class="regular-text wtpn_pocket_nav_consumer_key_field" placeholder="' . esc_attr__( 'Paste your Consumer Key here!', 'wtpn_pocket_nav' ) . '" value="' . esc_attr( $value ) . '">';
        echo '<p class="description">This is the Consumer Key that you can get at https://getpocket.com/developer.</p>';

    }

}

// new WTPN_Pocket_Nav_Settings_Page;