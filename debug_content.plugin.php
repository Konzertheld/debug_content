<?php
namespace Habari;

class DebugContent extends Plugin
{
	public function action_admin_header($theme)
	{
		Stack::add('admin_header_javascript', $this->get_url(true) . 'jsdump.js', 'jsdump');
	}
	
	public function theme_header($theme)
	{
		Stack::add('template_header_javascript', $this->get_url(true) . 'jsdump.js', 'jsdump');
	}
}
?>