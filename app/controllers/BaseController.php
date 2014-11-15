<?php
use NS\Messages\MessageRepository;
use NS\Messages\Message;
class BaseController extends Controller {
protected $layout = 'layouts.base';
protected $title = '';
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
protected $messages;
   public function __construct(){
        $messages = new MessageRepository(new Message());
        $this->$messages = $messages->getByUserID(Auth::user()->id);
        
    }


	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function view($path, $data = [])
    {
      
        $this->layout->content = View::make($path, array('data'=>$data,'messages'=>$this->messages));
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
