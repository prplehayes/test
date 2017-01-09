<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	 public function initialize()
	{
		parent::initialize();
	
		$this->Auth->allow('forgot');
	}
    public function index()
    {
         $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,7))){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['action' => 'access-denied']);
		 }
		 $options=array();
		 if( $loguser['group_id']==7){
			$options[] =array('group_id NOT IN '=>array(1));
		}
		else{
			
		}
		$this->paginate = [
            'contain' => ['Groups'],'conditions'=>$options,'limit'=>10
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
	public function myaccount()
    {
       $id=$this->Auth->user('id');
	   $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
	public function login() {
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            //return $this->redirect($this->Auth->redirectUrl());
			if($user['group_id']==2){
				return $this->redirect(['controller'=>'claim','action' => 'claimviewcues']);
			}
			return $this->redirect(['action' => 'myaccount']);
        }
			$this->Flash->error(__('Your username or password was incorrect.'));
		}
	}
	public function logout() {
		$this->Flash->success(__('Good-Bye'));
		$this->redirect($this->Auth->logout());
	}

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups', 'Notes', 'Review']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,7))){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['action' => 'access-denied']);
		 }
		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
		$PT = TableRegistry::get('Practice');
        $practice = $PT->find('list',array('fields'=>array('Practice.id','Practice.Identifier')),['limit' => 200]);
		if( $loguser['group_id']==7){
			$groups = $this->Users->Groups->find('list', ['limit' => 200])->where(['id NOT IN '=>array(1)]);
		}
		else{
			$groups = $this->Users->Groups->find('list', ['limit' => 200]);
		}
		
        $this->set(compact('user', 'groups','practice'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
		if($this->request->data['password']==$this->request->data['h_password']){
			
			
			unset($this->request->data['password']);
			unset($this->request->data['h_password']);
			//print_r($this->request->data);

		}
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $PT = TableRegistry::get('Practice');
        $practice = $PT->find('list',array('fields'=>array('Practice.id','Practice.Identifier')),['limit' => 200]);
        if( $loguser['group_id']==7){
			$groups = $this->Users->Groups->find('list', ['limit' => 200])->where(['id NOT IN '=>array(1)]);
		}
		else{
			$groups = $this->Users->Groups->find('list', ['limit' => 200]);
		}
        $this->set(compact('user', 'groups','practice'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,7))){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['action' => 'access-denied']);
		 }
		$user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function accessDenied()
    {
         
    }
	public function changepassword()
    {
         
    }
	public function forgot()
    {
		if($this->request->data['email']!=''){
			 $dentist = $this->Users->find('all')->where(['email'=>$this->request->data['email']])->first();
			 if(count( $dentist)>0)
			{
				$password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
				$pass = substr(str_shuffle($password_string), 0, 8);
				$hasher = new DefaultPasswordHasher;
				$npassword = $hasher->hash($pass);
		
				$query = $this->Users->query();
				$query->update()
				->set(['password' => $npassword])
				->where(['id' => $dentist->id])
				->execute();
				
				$email = new Email();
				$email->sender('paloma@gantzer-inc.com', 'Premier Health');
				$email = new Email('default');
				$email->from(['paloma@gantzer-inc.com' => 'Premier Health'])
				->to($this->request->data['email'])
				->subject('Forgot password')
				->send('Hi, Please check your password :'.$pass);
				$this->Flash->success(__('Please check your inbox for new password.'));
			}
			else{
				$this->Flash->error(__('Sorry ! no such user found'));
				
			}
			return $this->redirect(['action' => 'forgot']);
		}

    }
}
