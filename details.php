<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Streams_sample extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Streams Sample'
			),
			'description' => array(
				'en' => 'Sample PyroCMS module using the Streams core for CRUD.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content',
			'shortcuts' => array(
				'create' => array(
					'name' 	=> 'streams_sample:new',
					'uri' 	=> 'admin/streams_sample/create',
					'class' => 'add'
					)
				)
		);
	}

	public function install()
	{
		// We're using the streams API to
		// do data setup.
		$this->load->driver('Streams');
		
		$this->load->language('streams_sample/streams_sample');
	
		// Add dogs streams
		if ( ! $this->streams->streams->add_stream(
										lang('streams_sample:dogs'),
										'dogs',
										'streams_sample',
										'sample_',
										NULL
									)) return FALSE;
									
		// Add some fields
		$fields = array(
				
				array(
					'name'		=> 'Name',
					'slug'		=> 'name',
					'namespace'	=> 'streams_sample',
					'type'		=> 'text',
					'assign'	=> 'dogs'
			)
		);
		
		$this->streams->fields->add_fields($fields);
		
		return TRUE;
	}

	public function uninstall()
	{
		$this->load->driver('Streams');
		$this->streams->debug = FALSE;
		
		$this->streams->streams->delete_stream('dogs', 'streams_sample');
		
		return TRUE;
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}