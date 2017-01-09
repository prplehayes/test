<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       $loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
		 
	    $this->paginate = [
            'contain' => ['Users']
        ];
        $orders = $this->paginate($this->Orders);
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
        $this->set(compact('orders','userslist'));
        $this->set('_serialize', ['orders']);
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
		$order = $this->Orders->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
		$order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users'));
        $this->set('_serialize', ['order']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
		$order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users'));
        $this->set('_serialize', ['order']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       $loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
	    $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
