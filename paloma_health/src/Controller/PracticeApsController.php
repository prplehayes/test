<?php
namespace App\Controller;
use App\Controller\AppController;
/**
 * Practice Controller
 *
 * @property \App\Model\Table\PracticeTable $Practice
 */
class PracticeApsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	 /*public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('index');
	}*/
    public function index()
    {
		
    }
	public function ajaxPractice()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		if($loguser['group_id']==1){
			 
		}else{
			//$options = ['Practice.id'=>$loguser['practice_id']];
		}
		$this->paginate = [
            'contain' => ['PracticeStatus'],'limit' =>10
        ];
		if(empty($options)){
			$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>2]);
		}
		else{
			$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>2])->andWhere($options);
		}
        $practice = $this->paginate($query);
		$this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
		$this->viewBuilder()->layout('ajax');
		return;
    }
	public function ajaxCustomer()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		if($loguser['group_id']==1){
			 
		}else{
			//$options = ['Practice.id'=>$loguser['practice_id']];
		}
		$this->paginate = [
            'contain' => ['PracticeStatus'],'limit' =>10
        ];
		if(empty($options)){
			$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>1]);
		}
		else{
			$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>1])->andWhere($options);
		}
        $practice = $this->paginate($query);
		$this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
		$this->viewBuilder()->layout('ajax');
		return;
    }

}
