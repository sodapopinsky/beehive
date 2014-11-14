<?php

class BaseController extends Controller {
protected $layout = 'layouts.base';
protected $title = '';
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function view($path, $data = [])
    {
       $this->layout->title = $this->title;
        $this->layout->content = View::make($path, $data);
    }

    protected function dump($data){
    	print_r($data);
    }

 	protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

        protected function redirectAction($action, $data = [])
    {
        return Redirect::action($action, $data);
    }

}
