<?php

function jetpack_register_module( $slug, $args ) {
	$jetpack_module_regestry = Jetpack_Modules_Registry::get_intance();
	$jetpack_module_regestry->register( $slug, $args );
}

/**
 * Class Jetpack_Modules_Registry
 *
 * Class for keeping the state of all things modules in memory
 */
class Jetpack_Modules_Registry {
	private $modules;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// Loads all the necessery modules files
	public function load() {
		$active_modules = Jetpack_Options::get_option( 'active_modules' );
		$this->set_modules_as_active( $active_modules );
	}

	public function set_modules_as_active( $active_modules ) {
		foreach( $active_modules as $slug ) {
			$this->modules[ $slug ]->is_active = true;
		}
	}

	public function get_all() { // Jetpack::get_available_modules
		// todo

	}

	public function get_default_modules() {
		// todo
	}

	public function get( $slug ) {
		return $this->modules[ $slug ];
	}

	public function register( $slug, $args ) {
		$this->modules[ $slug ] = new Jetpack_Module( $slug, $args );
	}

	public function is_active( $slug ) {
		$this->modules[$slug]->is_active;
	}

	public function get_all_active() {
		$active_modules = array_filter( self::$modules, array( __CLASS__, 'filter_is_active' ) );
		// filltering?
		return $active_modules;
	}

	static function filter_is_active( $module ) {
		return isset( $module->is_active ) && $module->is_active;
	}

	static function activate( $slug ) {
		// todo
	}

	static function deactivate_all() {
		// todo
	}

	static function deactivate( $slug ) {
		// todo
	}
}


class Jetpack_Module {
	public $slug;

	public $name;                       // Module Name
	public $description;                // Module Description
	public $jumpstart_desc;             // Jumpstart Description
	public $sort;                       // Sort Order
	public $recommendation_order;       // Recommendation Order
	public $introduced;                 // First Introduced
	public $changed;                    // Major Changes In
	public $deactivate;                 // Deactivate
	public $free;                       // Free
	public $requires_connection;        // Requires Connection
	public $auto_activate;              // Auto Activate
	public $module_tags;                // Module Tags
	public $feature;                    // Feature
	public $additional_search_queries;  // Additional Search Queries
	public $plan_classes;               // Plans
	public $is_active;
	public $is_avalable;

	public function __construct( $module, $args = array() ) {
		$this->slug = $module;

		$this->set_props( $args );
		$this->is_avalable = $this->is_module_available( $module );
	}

	private function set_props( $args ) {
		foreach ( $args as $property_name => $property_value ) {
			$this->$property_name = $property_value;
		}

	}
	// check if module is available by checking that the file exits.
	private function is_module_available( $module ) {
		// todo
		return true;
	}
}