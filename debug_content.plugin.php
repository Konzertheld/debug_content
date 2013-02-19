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
	
	public function configure()
	{
		$form = new FormUI(__CLASS__);
		$form->append('text', 'postnumber', 'null:null', 'Number of posts to create per content type');
		$form->append('submit', 'submit', 'Do it!');
		$form->on_success(array($this,'create_posts'));
		$form->out();
	}
	
	public function create_posts($form)
	{
		if(!isset($form->postnumber)) return;
		$post_types = Post::list_active_post_types();
		foreach($post_types as $name => $number)
		{
			if(0 === $number) continue;
			for($i=0;$i<$form->postnumber->value;$i++)
			{
				$post = new Post();
				$post->user_id = User::identify()->id;
				$post->title = "$name test entry";
				$post->content = "Random content to insert here";
				$post->pubdate = DateTime::date_create();
				$post->insert();
				$post->publish();
			}
		}
	}
}
?>