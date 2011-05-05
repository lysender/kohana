<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Image extends Controller {

	public function action_index()
	{
		$this->response->body('Image index');
	}
	
	public function action_render()
	{
		$img = Image::factory(DOCROOT.'uploads/colorado-farm-1920x1200.jpg');
		
		$this->response->headers('Content-Type', 'image/jpg');
		
		$this->response->body(
			$img->resize(300, 300)
				->render('jpg')
		);
	}
	
	public function action_save()
	{
		$img = Image::factory(DOCROOT.'uploads/colorado-farm-1920x1200.jpg');
		
		$filename = DOCROOT.'uploads/img-'.uniqid().'.jpg';
		
		$img->resize(300, 300)
			->save($filename, 80);
	}

} // End Welcome
