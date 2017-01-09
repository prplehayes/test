<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Configure;
require_once('../vendor/Stripe/init.php');
/**
 * Practice Controller
 *
 * @property \App\Model\Table\PracticeTable $Practice
 */
class PracticeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $loguser = $this->request->session()->read('Auth.User');
		 if($loguser['group_id']!=1){
		 $this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$this->paginate = [
            'contain' => ['PracticeStatus'],'limit'=>10
        ];
        $practice = $this->paginate($this->Practice);

        $this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
    }

    public function initialize() {
        parent::initialize();
        $this->Auth->allow('registration');
		$this->Auth->allow('createaccount');
		$this->Auth->allow('signup');
		$this->Auth->allow('makepayment');
		$this->Auth->allow('thankyou');
    }
    
    public function registration()
    {
       $id=$this->Auth->user('id');
       
//       $groups = $this->Groups->get($id, ['contain' => ['Groups']]);
//
//        $this->set('user', $groups);
//        $this->set('_serialize', ['user']);
    }
    
    
    public function registration_user()
    {
       $id=$this->Auth->user('id');
       
//       $groups = $this->Groups->get($id, ['contain' => ['Groups']]);
//
//        $this->set('user', $groups);
//        $this->set('_serialize', ['user']);
    }
    
    
    /**
     * View method
     *
     * @param string|null $id Practice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => ['PracticeStatus', 'Patient', 'PracticeContract', 'PracticePaymentInfo', 'Users']
        ]);
		$practiceStatus = $this->Practice->PracticeStatus->find('list',array('fields'=>array('PracticeStatus.id','PracticeStatus.status')), ['limit' => 200]);
		$practiceStatusName = $practiceStatus->toArray();
		//$status=$practiceStatusName[$practice->practice_status_id];

		$this->set('practiceStatus',$practiceStatusName);
        $this->set('practice', $practice);
        $this->set('_serialize', ['practice']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$practice = $this->Practice->newEntity();
        if ($this->request->is('post')) {
		$this->request->data['practice_status_id']=2;
            $practice = $this->Practice->patchEntity($practice, $this->request->data);
           $prdata= $this->Practice->save($practice);
			if ($prdata) {
                $this->Flash->success(__('The practice has been saved.'));
                ///return $this->redirect(['action' => 'index']);
				$this->redirect(array('controller'=>'practice','action' => 'practice_account',$prdata->id));
				//$this->redirect([$prdata->id,'/practice_account']);
            } else {
                $this->Flash->error(__('The practice could not be saved. Please, try again.'));
            }
        }
        $practiceStatus = $this->Practice->PracticeStatus->find('list',array('fields'=>array('PracticeStatus.id','PracticeStatus.status')), ['limit' => 200]);
        $this->set(compact('practice', 'practiceStatus'));
        $this->set('_serialize', ['practice']);
    }
public function signup()
    {
        $practice = $this->Practice->newEntity();
        if ($this->request->is('post')) {
		$this->request->data['practice_status_id']=2;
            $practice = $this->Practice->patchEntity($practice, $this->request->data);
           $prdata= $this->Practice->save($practice);
			if ($prdata) {
                $this->Flash->success(__('The practice has been saved.'));
                ///return $this->redirect(['action' => 'index']);
				$this->redirect(array('controller'=>'practice','action' => 'createaccount',$prdata->id));
				//$this->redirect([$prdata->id,'/practice_account']);
            } else {
                $this->Flash->error(__('The practice could not be saved. Please, try again.'));
            }
        }
        $practiceStatus = $this->Practice->PracticeStatus->find('list',array('fields'=>array('PracticeStatus.id','PracticeStatus.status')), ['limit' => 200]);
        $this->set(compact('practice', 'practiceStatus'));
        $this->set('_serialize', ['practice']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Practice id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$practice = $this->Practice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $practice = $this->Practice->patchEntity($practice, $this->request->data);
            if ($this->Practice->save($practice)) {
                $this->Flash->success(__('The practice has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The practice could not be saved. Please, try again.'));
            }
        }
        $practiceStatus = $this->Practice->PracticeStatus->find('list',array('fields'=>array('PracticeStatus.id','PracticeStatus.status')), ['limit' => 200]);
        $this->set(compact('practice', 'practiceStatus'));
        $this->set('_serialize', ['practice']);
    }
	 public function editpractice()
    {
        $loguser = $this->request->session()->read('Auth.User');
		$id=$loguser['practice_id'];
		$practice = $this->Practice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $practice = $this->Practice->patchEntity($practice, $this->request->data);
            if ($this->Practice->save($practice)) {
                $this->Flash->success(__('The practice has been saved.'));
                return $this->redirect(['action' => 'mypractice']);
            } else {
                $this->Flash->error(__('The practice could not be saved. Please, try again.'));
            }
        }
        $practiceStatus = $this->Practice->PracticeStatus->find('list',array('fields'=>array('PracticeStatus.id','PracticeStatus.status')), ['limit' => 200]);
        $this->set(compact('practice', 'practiceStatus'));
        $this->set('_serialize', ['practice']);
    }
	public function practiceAccount($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
		$userdata = TableRegistry::get('Users');
		$saveuser = $userdata->newEntity();
		$this->request->data['practice_id']=$id;
		$this->request->data['group_id']=5;
		$this->request->data['username']=$this->request->data['email'];
            $practice = $userdata->patchEntity($saveuser, $this->request->data);
            $saveduser=$userdata->save($practice);
			if ($saveduser) {
                $this->Flash->success(__('The account has been saved.'));
                //return $this->redirect(['action' => 'index']);
			$_SESSION['newuser']=$saveduser->id;
			$this->redirect(array('controller'=>'practice','action' => 'practice_payment',$id));
				//$this->redirect(array('controller'=>'practice','action' => 'practice_contract',$id));
            } else {
                $this->Flash->error(__('The account could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
    }
	public function createaccount($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
		$userdata = TableRegistry::get('Users');
		$saveuser = $userdata->newEntity();
		$this->request->data['practice_id']=$id;
		$this->request->data['group_id']=5;
		$this->request->data['username']=$this->request->data['email'];
            $practice = $userdata->patchEntity($saveuser, $this->request->data);
            $saveduser=$userdata->save($practice);
			if ($saveduser) {
                $this->Flash->success(__('The account has been saved.'));
                //return $this->redirect(['action' => 'index']);
			$_SESSION['newuser']=$saveduser->id;
			$this->redirect(array('controller'=>'practice','action' => 'makepayment',$id));
				//$this->redirect(array('controller'=>'practice','action' => 'practice_contract',$id));
            } else {
                $this->Flash->error(__('The account could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
    }
	public function practiceContract($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (move_uploaded_file($this->request->data['docusign_url']['tmp_name'],WWW_ROOT . 'uploads' . DS . $this->request->data['docusign_url']['name'])){
				$this->request->data['docusign_url'] = str_replace(" ","_",$this->request->data['docusign_url']['name']);	
			}
			$PC = TableRegistry::get('PracticeContract');
		$savepc = $PC->newEntity();
		$this->request->data['practice_id']=$id;
		$this->request->data['status']='Signed';
		$this->request->data['signed']=date("Y-m-d h:i:s");
		$this->request->data['rate_id']=1;
		$this->request->data['docusign_templateId']=1;
		$this->request->data['docusign_brandId']=1;
		
            $practice1 = $PC->patchEntity($savepc, $this->request->data);
           
		   $ddd=$PC->save($practice1);
		    if ($ddd) {
                $this->Flash->success(__('The contract has been saved.'));
                //return $this->redirect(['action' => 'index']);
				$this->redirect(array('controller'=>'practice','action' => 'practice_payment',$id));
            } else {
                $this->Flash->error(__('The contract could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
    }
	public function makepayment($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => []
        ]);
		$error = '';
		$success = '';
        $publickey=Configure::read('Stripe.PublicKey');
		$amount=Configure::read('Stripe.price');
		if ($this->request->is(['patch', 'post', 'put'])) {
		//stripe payment
		$prkey=Configure::read('Stripe.PrivateKey');
		\Stripe\Stripe::setApiKey($prkey);//Replace with your Secret Key
		try {
			if (!isset($_POST['stripeToken']))
			  throw new RecordNotFoundException("The Stripe Token was not generated correctly");
				//Create Customer:
				$dentist = TableRegistry::get('Users')->find('all')->where(['practice_id'=>$id,"group_id"=>5])->first()->toArray();
				$token=$_POST['stripeToken'];
				$email=$dentist['email'];
				$amount=Configure::read('Stripe.price');
				$customer = \Stripe\Customer::create(array(
					'source'   => $token,
					'email'    => $email,
					'plan'     => "monthly_recurring",
				));
				
				// Charge the order:
				$charge = \Stripe\Charge::create(array(
					'customer'    => $customer->id,
					"amount" => $amount,
					"currency" => "usd",
					"description" => $practice->Identifier."- payment",
					)
				);
			$success = 'Your payment was successful.';
			/////
			$orders = TableRegistry::get('Orders');
			
			$orderssave = $orders->newEntity();
		$orderdata=array();	
		$orderdata['practice_id']=$id;
		$orderdata['user_id']=$dentist['id'];
		$orderdata['payment_status']="Completed";
		$orderdata['total']=$amount;
		$orderdata['notes']="Practice - ".$practice->Identifier ." payment from dentist - ".$email;
		
            $orderssave1 = $orders->patchEntity($orderssave, $orderdata);
           
		   $orders->save($orderssave1);
			
			///
			
			$PC = TableRegistry::get('PracticePaymentInfo');
		$savepc = $PC->newEntity();
		$this->request->data['practice_id']=$id;
		$this->request->data['recurring_active']=1;
		
            $practice1 = $PC->patchEntity($savepc, $this->request->data);
           
		   $ddd=$PC->save($practice1);
		    if ($ddd) {
			$query = $this->Practice->query();
			$query->update()
				->set(['practice_status_id' =>1])
				->where(['id' => $id])
				->execute();
				
                $this->Flash->success(__('The Payment info has been saved.'));
                //return $this->redirect(['action' => 'thankyou']);
				$this->redirect(array('controller'=>'practice','action' => 'thankyou',$id));
            } else {
                $this->Flash->error(__('The Payment info could not be saved. Please, try again.'));
            }
			
		  }
		  catch (Exception $e) {
			$error = $e->getMessage();
		  }
            
        }
        
        $this->set(compact('practice','error','success','publickey','amount'));
        $this->set('_serialize', ['practice']);
    }
	public function thankyou($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => []
        ]);
		$error = '';
		$success = 'Thank you registering your account and payment.We will contact you soon';
        $this->set(compact('practice','error','success'));
        $this->set('_serialize', ['practice']);
    }
	public function practicePayment($id = null)
    {
        $practice = $this->Practice->get($id, [
            'contain' => []
        ]);
		$error = '';
		$success = '';
		$publickey=Configure::read('Stripe.PublicKey');
		$amount=Configure::read('Stripe.price');
        if ($this->request->is(['patch', 'post', 'put'])) {
		//stripe payment
		$prkey=Configure::read('Stripe.PrivateKey');
		\Stripe\Stripe::setApiKey($prkey);//Replace with your Secret Key
		try {
			if (!isset($_POST['stripeToken']))
			  throw new RecordNotFoundException("The Stripe Token was not generated correctly");
				//Create Customer:
				$dentist = TableRegistry::get('Users')->find('all')->where(['id'=>$_SESSION['newuser']])->first()->toArray();
				$token=$_POST['stripeToken'];
				$email=$dentist['email'];
				$amount=Configure::read('Stripe.price');
				$customer = \Stripe\Customer::create(array(
					'source'   => $token,
					'email'    => $email,
					'plan'     => "monthly_recurring",
				));
				
				// Charge the order:
				$charge = \Stripe\Charge::create(array(
					'customer'    => $customer->id,
					"amount" => $amount,
					"currency" => "usd",
					"description" => $practice->Identifier."- payment",
					)
				);
			$success = 'Your payment was successful.';
			/////
			$orders = TableRegistry::get('Orders');
			
			$orderssave = $orders->newEntity();
		$orderdata=array();	
		$orderdata['practice_id']=$id;
		$orderdata['user_id']=$_SESSION['newuser'];
		$orderdata['payment_status']="Completed";
		$orderdata['total']=$amount;
		$orderdata['notes']="Practice - ".$practice->Identifier ." payment from dentist - ".$email;
		
            $orderssave1 = $orders->patchEntity($orderssave, $orderdata);
           
		   $orders->save($orderssave1);
			
			///
			
			$PC = TableRegistry::get('PracticePaymentInfo');
		$savepc = $PC->newEntity();
		$this->request->data['practice_id']=$id;
		$this->request->data['recurring_active']=1;
		
            $practice1 = $PC->patchEntity($savepc, $this->request->data);
           
		   $ddd=$PC->save($practice1);
		    if ($ddd) {
			$query = $this->Practice->query();
			$query->update()
				->set(['practice_status_id' =>1])
				->where(['id' => $id])
				->execute();
                $this->Flash->success(__('The Payment info has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Payment info could not be saved. Please, try again.'));
            }
			
		  }
		  catch (Exception $e) {
			$error = $e->getMessage();
		  }
            
        }
        
        $this->set(compact('practice','error','success','publickey','amount'));
        $this->set('_serialize', ['practice']);
    }
    /**
     * Delete method
     *
     * @param string|null $id Practice id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$this->request->allowMethod(['post', 'delete']);
        $practice = $this->Practice->get($id);
        if ($this->Practice->delete($practice)) {
            $this->Flash->success(__('The practice has been deleted.'));
        } else {
            $this->Flash->error(__('The practice could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function mypractice()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$id=$loguser['practice_id'];
       
        $this->set('cloguser', $loguser);
        $this->set('_serialize', ['cloguser']);
    }
	public function practiceinfo()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$id=$loguser['practice_id'];
       $practice = $this->Practice->get($id, [
            'contain' => ['PracticeStatus', 'Patient', 'PracticeContract', 'PracticePaymentInfo', 'Users']
        ]);
	    if ($id==0) {
            $this->Flash->error(__('The Practice is not assigned.'));
        } else {
           // $this->Flash->error(__('The claim could not be deleted. Please, try again.'));
        }
        //return $this->redirect(['action' => 'index']);
		
		$subproviders =array();
		$prproviders =array();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>11]);
		if($userslist->count()>0){
			foreach($userslist->toArray() as $key=>$val){
				$subproviders[$val['id']]=$val['first_name'];
			}
		}
		$prproviders = TableRegistry::get('PracticeSubproviders')->find('all',array('fields'=>array('provider_id')))->where(['practice_id'=>$id]);
		if($prproviders->count()>0){
			foreach($prproviders->toArray() as $key=>$val){
				$prproviders[$val['provider_id']]=$val['provider_id'];
			}
		}
		$practiceStatus = $this->Practice->PracticeStatus->find('list',array('fields'=>array('PracticeStatus.id','PracticeStatus.status')), ['limit' => 200]);
		$practiceStatusName = $practiceStatus->toArray();
		//$status=$practiceStatusName[$practice->practice_status_id];
		$this->set('prproviders', $prproviders);
		$this->set('subproviders', $subproviders);
		$this->set('practiceStatus',$practiceStatusName);
        $this->set('practice', $practice);
        $this->set('_serialize', ['practice']);
    }
	public function paymentinfo()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$id=$loguser['practice_id'];
       $practice = $this->Practice->get($id, [
            'contain' => ['PracticeStatus', 'Patient', 'PracticeContract', 'PracticePaymentInfo', 'Users']
        ]);
	    if ($this->request->is(['patch', 'post', 'put'])) {
			
			$PC = TableRegistry::get('PracticePaymentInfo');
			$savepc = $PC->newEntity();
			$this->request->data['practice_id']=$id;
			$this->request->data['recurring_active']=1;
            $practice1 = $PC->patchEntity($savepc, $this->request->data);
           
		   $ddd=$PC->save($practice1);
		    if ($ddd) {
				$this->Flash->success(__('The Payment info has been saved.'));
                return $this->redirect(['action' => 'mypractice']);
			} else {
                $this->Flash->error(__('The Payment info could not be saved. Please, try again.'));
            }
			
		  }

        $this->set('practice', $practice);
        $this->set('_serialize', ['practice']);
    }
}