<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Imagefly extends Controller {

	public function action_index()
	{
		$file = $this->request->param('image');
		$width = (int) $this->request->param('width');
		$height = (int) $this->request->param('height');
		
		$rendered = FALSE;
		if ($file AND $width AND $height)
		{
			$filename = DOCROOT.'uploads/'.$file.'.jpg';
			
			if (is_file($filename))
			{
				$this->_render_image($filename, $width, $height);
				$rendered = TRUE;
			}
		}
		
		if ( ! $rendered)
		{
			$this->response->status(404);
		}
	}
	
	protected function _render_image($filename, $width, $height)
	{
		// Calculate ETag from original file padded with the dimension specs
		$etag_sum = md5(base64_encode(file_get_contents($filename)).$width.','.$height);
		
		// Render as image and cache for 1 hour
		$this->response->headers('Content-Type', 'image/jpeg')
			->headers('Cache-Control', 'max-age='.Date::HOUR.', public, must-revalidate')
			->headers('Expires', gmdate('D, d M Y H:i:s', time() + Date::HOUR).' GMT')
			->headers('Last-Modified', date('r', filemtime($filename)))
			->headers('ETag', $etag_sum);
		
		if (
			$this->request->headers('if-none-match') AND
			(string) $this->request->headers('if-none-match') === $etag_sum)
		{
			$this->response->status(304)
				->headers('Content-Length', '0');
		}
		else
		{
			$result = Image::factory($filename)
				->resize($width, $height)
				->render('jpg');
				
			$this->response->body($result);
		}
	}
}