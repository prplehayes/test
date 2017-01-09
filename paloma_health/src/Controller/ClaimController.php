<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use App\View\Helper\CommonHelper;

/**
 * Claim Controller
 *
 * @property \App\Model\Table\ClaimTable $Claim
 */
class ClaimController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	public $paginate = [
        'limit' =>10
    ];
	public $helpers = ['Common']; 
	public function index()
    {
		$loguser = $this->request->session()->read('Auth.User');
		 if(in_array($loguser['group_id'],array(7))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		//print_r($loguser);
	 	$paginate = array('limit' => 10);
		if ($this->request->isAjax()){
			$this->layout = null;
		 }
		 $this->Claim->recursive = 0;
		$options=array();
		if($loguser['group_id']==1){
			 
		}else{
			$options = ['Claim.user_id'=>$loguser['id']];
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus'],'conditions'=>$options,'limit'=>10];
		
        $claim = $this->paginate();
		if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}
		$currentloguser=$loguser;
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
	    $this->set(compact('claim','practice','currentloguser'));
        $this->set('_serialize', ['claim']);
    }
	public function draftclaim()
    {
		$loguser = $this->request->session()->read('Auth.User');
		 if(in_array($loguser['group_id'],array(7))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		//print_r($loguser);
	 	$paginate = array('limit' => 10);
		if ($this->request->isAjax()){
			$this->layout = null;
		 }
		 $this->Claim->recursive = 0;
		$options=array();
		if($loguser['group_id']==1){
			 
		}else{
			$options = ['Claim.user_id'=>$loguser['id']];
		}
		$options = ['Claim.claim_status_id'=>12];
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus'],'conditions'=>$options,'limit'=>10];
		
        $claim = $this->paginate();
		if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}
		$currentloguser=$loguser;
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
	    $this->set(compact('claim','practice','currentloguser'));
        $this->set('_serialize', ['claim']);
    }

    /**
     * View method
     *
     * @param string|null $id Claim id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		$claimusers=array();
		if($claim->user_id){
			$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$claim->user_id])->first()->toArray();
		}
		$users = TableRegistry::get('Users')->find('list',array('fields'=>array('id','email')))->toArray();
		$payments = TableRegistry::get('ClaimPayment')->find('all')->where(['claim_id'=>$id])->toArray();
		$appeals = TableRegistry::get('ClaimAppeals')->find('all')->where(['claim_id'=>$id])->toArray();
	    $this->set('claimusers', $claimusers);
		$this->set('claim', $claim);
		$this->set('payments', $payments);
		$this->set('appeals', $appeals);
		$this->set('users', $users);
        $this->set('_serialize', ['claim']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $claim = $this->Claim->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['date_of_service'] = date("Y-m-d",strtotime($this->request->data['date_of_service']));
		if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] ='';	
			}
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] ='';	
			}
            $claim = $this->Claim->patchEntity($claim, $this->request->data);
            if ($this->Claim->save($claim)) {
                $this->Flash->success(__('The claim has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The claim could not be saved. Please, try again.'));
            }
        }
        $patient=array();
		$cptCodes=array();
		$icd10Codes=array();
		//$this->Claim->Patient->find('list',array('fields'=>array('Patient.id','Patient.first_name')),['limit' => 200]);
		$patient1 = $this->Claim->Patient->find('all',array('fields'=>array('Patient.id','first_name'=>'CONCAT(Patient.first_name," ",Patient.last_name)')),['limit' => 200])->toArray();
		foreach( $patient1 as $pkey){
			$patient[$pkey->id]=$pkey->first_name;
		}
        $claimStatus = $this->Claim->ClaimStatus->find('list', ['limit' => 200]);
	   	
		//$cptCodes = $this->Claim->CptCodes->find('list',array('fields'=>array('CptCodes.id','CptCodes.code')), ['limit' => 200]);
		$cptCodes1 = $this->Claim->CptCodes->find('all',array('fields'=>array('CptCodes.id','code'=>'CONCAT(CptCodes.code," - ",CptCodes.description)')), ['limit' => 200]);
		foreach($cptCodes1 as $pkey){
			$cptCodes[$pkey->id]=$pkey->code;
		}
        $icd10Codes1 = $this->Claim->Icd10Codes->find('all',array('fields'=>array('Icd10Codes.id','code'=>'CONCAT(Icd10Codes.code," - ",Icd10Codes.description)')), ['limit' => 200]);
		
		foreach( $icd10Codes1 as $pkey){
			$icd10Codes[$pkey->id]=$pkey->code;
		}
		
        $this->set(compact('claim', 'patient', 'claimStatus', 'cptCodes', 'icd10Codes'));
        $this->set('_serialize', ['claim']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Claim id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $claim = $this->Claim->get($id, [
            'contain' => ['CptCodes', 'Icd10Codes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
		$this->request->data['date_of_service'] = date("Y-m-d",strtotime($this->request->data['date_of_service']));
		if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'] ;	
			}
            $claim = $this->Claim->patchEntity($claim, $this->request->data);
            if ($this->Claim->save($claim)) {
                $this->Flash->success(__('The claim has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The claim could not be saved. Please, try again.'));
            }
        }
        $patient=array();
		$cptCodes=array();
		$icd10Codes=array();
		//$this->Claim->Patient->find('list',array('fields'=>array('Patient.id','Patient.first_name')),['limit' => 200]);
		$patient1 = $this->Claim->Patient->find('all',array('fields'=>array('Patient.id','first_name'=>'CONCAT(Patient.first_name," ",Patient.last_name)')),['limit' => 200])->toArray();
		foreach( $patient1 as $pkey){
			$patient[$pkey->id]=$pkey->first_name;
		}
        $claimStatus = $this->Claim->ClaimStatus->find('list', ['limit' => 200]);
	   	
		//$cptCodes = $this->Claim->CptCodes->find('list',array('fields'=>array('CptCodes.id','CptCodes.code')), ['limit' => 200]);
		$cptCodes1 = $this->Claim->CptCodes->find('all',array('fields'=>array('CptCodes.id','code'=>'CONCAT(CptCodes.code," - ",CptCodes.description)')), ['limit' => 200]);
		foreach($cptCodes1 as $pkey){
			$cptCodes[$pkey->id]=$pkey->code;
		}
        $icd10Codes1 = $this->Claim->Icd10Codes->find('all',array('fields'=>array('Icd10Codes.id','code'=>'CONCAT(Icd10Codes.code," - ",Icd10Codes.description)')), ['limit' => 200]);
		
		foreach( $icd10Codes1 as $pkey){
			$icd10Codes[$pkey->id]=$pkey->code;
		}
        $this->set(compact('claim', 'patient', 'claimStatus', 'cptCodes', 'icd10Codes'));
        $this->set('_serialize', ['claim']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Claim id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $claim = $this->Claim->get($id);
        $claimcptcode = TableRegistry::get('ClaimCptCodes');
		$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
		$notes = TableRegistry::get('Notes');
		$review = TableRegistry::get('Review');
		$payment = TableRegistry::get('ClaimPayment');
		$prdata = $claimcptcode->find('all')->where(['claim_id' => $id])->first();
				$payment1 = $payment->find('all')->where(['claim_id' => $id])->first();
				if($payment1->id>0){
					$payment->deleteAll(['ClaimPayment.claim_id IN ' => $id]);
				}
				
				$notes1 = $notes->find('all')->where(['claim_id' => $id])->first();
				if($notes1->id>0){
					$notes->deleteAll(['Notes.claim_id IN ' => $id]);
				}
				
				$review1 = $review->find('all')->where(['claim_id' => $id])->first();
				if($review1->id>0){
					$review->deleteAll(['Review.claim_id IN ' => $id]);
				}
				
				if($prdata->id>0){
					$claimcptcode->deleteAll(['ClaimCptCodes.claim_id IN ' => $id]);
				}
				$prdata = $claimicdcode->find('all')->where(['claim_id' => $id])->first();
				if($prdata->id>0){
					$claimicdcode->deleteAll(['ClaimIcd10Codes.claim_id IN ' => $id]);
				}
				
		if ($this->Claim->delete($claim)) {
            $this->Flash->success(__('The claim has been deleted.'));
        } else {
            $this->Flash->error(__('The claim could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function reimbursement(){
		$loguser = $this->request->session()->read('Auth.User');
		 $paginate = array('limit' => 10);
		 if ($this->request->isAjax()){
			$this->layout = null;
		 }
		$options=array();
		if($loguser['group_id']==1){
			 
		}else{
			//$options = ['Patient.practice_id'=>$loguser['practice_id']];
		}
			$passArg = array();
			$conditions = array();
			$conditions1 = array();
			$conditions2 = array();
			$conditions3 = array();
			if (!empty($this->request->data['filter'])){
				$conditions = array('first_name LIKE '  => '%'.trim($this->request->data['filter']).'%');
				$conditions1 = array('last_name LIKE '  => '%'.trim($this->request->data['filter']).'%');
				$conditions2 = array('ssn LIKE '  => '%'.trim($this->request->data['filter']).'%');
				$conditions3 = array('medicare_number LIKE '  => '%'.trim($this->request->data['filter']).'%');
				$passArg = $this->request->data;
			}
				if (!empty($this->request->params['named']['page'])){
					$passArg['page'] = $this->request->params['named']['page'];
				}
				else{
					if (!empty($this->request->data['page'])){
						$this->request->params['named']['page'] = $this->request->data['page'];
						}
					}
					//$paginate = array('limit' => 2);
					if (!empty($conditions)){$paginate['conditions'] = $conditions;
					}
					//print_r($this->data);
					//$this->paginate = $paginate;
					$this->set('passArg',$passArg);
					if (!empty($passArg)){$this->Cookie->write('srcPassArg',$passArg);}
				if(empty($options)){
				$query = $this->loadModel('Patient')->find('all')->where($conditions)->orWhere($conditions1)->orWhere($conditions2)->orWhere($conditions3);
				}else{
				$query = $this->loadModel('Patient')->find('all')->where($conditions)->orWhere($conditions1)->orWhere($conditions2)->orWhere($conditions3)->andWhere($options);
				}
				$patient = $this->paginate($query,['limit'=>10]);
				$this->set(compact('patient'));
				$this->set('_serialize', ['patient']);
			}
	public function patientclaim($id=null)
    {
        return $this->redirect(array('controller'=>'claim','action' => 'verifypatient',$id));
    }
	public function patientdraftclaim($id=null)
    {
        return $this->redirect(array('controller'=>'claim','action' => 'verifypatientdraft',$id));
    }
	public function verifypatientdraft($id = null)
    {
		
        $patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			 $this->request->data['RP']['patient_id']=$id;
		$this->request->data['PI']['patient_id']=$id;
		$this->request->data['PPP']['patient_id']=$id;
		$this->request->data['PP']['patient_id']=$id;
		$this->request->data['dob']=date("Y-m-d",strtotime($this->request->data['dob']));
		//$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		if($this->request->data['RP']['dob']==''){
			$this->request->data['RP']['dob']="0000-00-00";
		}
		else{
			$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		}
		if(!isset($this->request->data['PI']['is_migtant_worker'])){$this->request->data['PI']['is_migtant_worker']=0;}
		if(!isset($this->request->data['PI']['is_dependent_of_a_migrant_worker'])){$this->request->data['PI']['is_dependent_of_a_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_seasonal_migrant_worker'])){$this->request->data['PI']['is_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker'])){$this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['non_agricultural_worker'])){$this->request->data['PI']['non_agricultural_worker']=0;}
		if(!isset($this->request->data['PI']['refused_unreported'])){$this->request->data['PI']['refused_unreported']=0;}
		//print_r($this->request->data); exit;
			//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}
			// Progress-notes
			
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// document upload code end here
			//save PR information
			
		//	if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
			// document upload code end here
			//save PR information
			$RP = $this->Patient->PatientResponsibleParty;
			$prdata = $RP->find('all')->where(['patient_id' => $id])->first();
			if($prdata->id>0){
				$RP->patchEntity($prdata,$this->request->data['RP']);
				$RP->save($prdata);
			}
			else{
				$savepr = $RP->newEntity();
				$RP->patchEntity($savepr,$this->request->data['RP']);
				$RP->save($savepr);
				
			}
			//API - additional information
			$PI = $this->Patient->PatientInfo;
			$pidata = $PI->find('all')->where(['patient_id' => $id])->first();
			if($pidata->id>0){
				$PI->patchEntity($pidata,$this->request->data['PI']);
				$PI->save($pidata);
			}
			else{
				$savepi = $PI->newEntity();
				$PI->patchEntity($savepi,$this->request->data['PI']);
				$PI->save($savepi);
				
			}
			//PPP - information
			$PPP = $this->Patient->PatientPrimaryPhysician;
			$pppdata = $PPP->find('all')->where(['patient_id' => $id])->first();
			if($pppdata->id>0){
				$PPP->patchEntity($pppdata,$this->request->data['PPP']);
				$PPP->save($pppdata);
			}
			else{
				$saveppp = $PPP->newEntity();
				$PPP->patchEntity($saveppp,$this->request->data['PPP']);
				$PPP->save($saveppp);
				
			}
			//PP - information
			$PP = $this->Patient->PatientPreferredPharmacy;
			$ppdata = $PP->find('all')->where(['patient_id' => $id])->first();
			if($ppdata->id>0){
				$PP->patchEntity($ppdata,$this->request->data['PP']);
				$PP->save($ppdata);
			}
			else{
				$savepp = $PP->newEntity();
				$PP->patchEntity($savepp,$this->request->data['PP']);
				$PP->save($savepp);
				
			}
			$patient = $this->Patient->patchEntity($patient, $this->request->data);
			if ($this->Patient->save($patient)) {
				return $this->redirect(array('controller'=>'claim','action' => 'dentalformdraft',$id));
			}
			 else{
				  $this->Flash->error(__('The patient could not be verify. Please, try again.'));
			 }
			//return $this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
        $practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$patientId=CommonHelper::uniqueNumber(99);
		$this->set('practice_id',$practice_id);
        $this->set(compact('patient', 'practice','RP','PPP','PP','PI','states','patientId'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    
	}
	public function verifypatient($id = null)
    {
		
        $patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			 $this->request->data['RP']['patient_id']=$id;
		$this->request->data['PI']['patient_id']=$id;
		$this->request->data['PPP']['patient_id']=$id;
		$this->request->data['PP']['patient_id']=$id;
		$this->request->data['dob']=date("Y-m-d",strtotime($this->request->data['dob']));
		//$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		if($this->request->data['RP']['dob']==''){
			$this->request->data['RP']['dob']="0000-00-00";
		}
		else{
			$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		}
		if(!isset($this->request->data['PI']['is_migtant_worker'])){$this->request->data['PI']['is_migtant_worker']=0;}
		if(!isset($this->request->data['PI']['is_dependent_of_a_migrant_worker'])){$this->request->data['PI']['is_dependent_of_a_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_seasonal_migrant_worker'])){$this->request->data['PI']['is_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker'])){$this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['non_agricultural_worker'])){$this->request->data['PI']['non_agricultural_worker']=0;}
		if(!isset($this->request->data['PI']['refused_unreported'])){$this->request->data['PI']['refused_unreported']=0;}
		//print_r($this->request->data); exit;
			//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}
			// Progress-notes
			
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// document upload code end here
			//save PR information
			
		//	if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
			// document upload code end here
			//save PR information
			$RP = $this->Patient->PatientResponsibleParty;
			$prdata = $RP->find('all')->where(['patient_id' => $id])->first();
			if($prdata->id>0){
				$RP->patchEntity($prdata,$this->request->data['RP']);
				$RP->save($prdata);
			}
			else{
				$savepr = $RP->newEntity();
				$RP->patchEntity($savepr,$this->request->data['RP']);
				$RP->save($savepr);
				
			}
			//API - additional information
			$PI = $this->Patient->PatientInfo;
			$pidata = $PI->find('all')->where(['patient_id' => $id])->first();
			if($pidata->id>0){
				$PI->patchEntity($pidata,$this->request->data['PI']);
				$PI->save($pidata);
			}
			else{
				$savepi = $PI->newEntity();
				$PI->patchEntity($savepi,$this->request->data['PI']);
				$PI->save($savepi);
				
			}
			//PPP - information
			$PPP = $this->Patient->PatientPrimaryPhysician;
			$pppdata = $PPP->find('all')->where(['patient_id' => $id])->first();
			if($pppdata->id>0){
				$PPP->patchEntity($pppdata,$this->request->data['PPP']);
				$PPP->save($pppdata);
			}
			else{
				$saveppp = $PPP->newEntity();
				$PPP->patchEntity($saveppp,$this->request->data['PPP']);
				$PPP->save($saveppp);
				
			}
			//PP - information
			$PP = $this->Patient->PatientPreferredPharmacy;
			$ppdata = $PP->find('all')->where(['patient_id' => $id])->first();
			if($ppdata->id>0){
				$PP->patchEntity($ppdata,$this->request->data['PP']);
				$PP->save($ppdata);
			}
			else{
				$savepp = $PP->newEntity();
				$PP->patchEntity($savepp,$this->request->data['PP']);
				$PP->save($savepp);
				
			}
			$patient = $this->Patient->patchEntity($patient, $this->request->data);
			if ($this->Patient->save($patient)) {
				return $this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
			}
			 else{
				  $this->Flash->error(__('The patient could not be verify. Please, try again.'));
			 }
			//return $this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
        $practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$patientId=CommonHelper::uniqueNumber(99);
		$this->set('practice_id',$practice_id);
        $this->set(compact('patient', 'practice','RP','PPP','PP','PI','states','patientId'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    
	}
	public function resubmitclaim($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
             'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//return $this->redirect(array('controller'=>'claim','action' => 'claimdentalform',$id));'
			$this->request->data['RP']['patient_id']=$claim->patient_id;
		$this->request->data['PI']['patient_id']=$claim->patient_id;
		$this->request->data['PPP']['patient_id']=$claim->patient_id;
		$this->request->data['PP']['patient_id']=$claim->patient_id;
		$this->request->data['dob']=date("Y-m-d",strtotime($this->request->data['dob']));
		//$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		if($this->request->data['RP']['dob']==''){
			$this->request->data['RP']['dob']="0000-00-00";
		}
		else{
			$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		}
		if(!isset($this->request->data['PI']['is_migtant_worker'])){$this->request->data['PI']['is_migtant_worker']=0;}
		if(!isset($this->request->data['PI']['is_dependent_of_a_migrant_worker'])){$this->request->data['PI']['is_dependent_of_a_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_seasonal_migrant_worker'])){$this->request->data['PI']['is_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker'])){$this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['non_agricultural_worker'])){$this->request->data['PI']['non_agricultural_worker']=0;}
		if(!isset($this->request->data['PI']['refused_unreported'])){$this->request->data['PI']['refused_unreported']=0;}
		//print_r($this->request->data); exit;
			//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			/*if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}*/
			// Progress-notes
			
			/*if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}*/
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// document upload code end here
			//save PR information
			
		//	if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
			// document upload code end here
			//save PR information
			$RP = $this->Patient->PatientResponsibleParty;
			$prdata = $RP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($prdata->id>0){
				$RP->patchEntity($prdata,$this->request->data['RP']);
				$RP->save($prdata);
			}
			else{
				$savepr = $RP->newEntity();
				$RP->patchEntity($savepr,$this->request->data['RP']);
				$RP->save($savepr);
				
			}
			//API - additional information
			$PI = $this->Patient->PatientInfo;
			$pidata = $PI->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($pidata->id>0){
				$PI->patchEntity($pidata,$this->request->data['PI']);
				$PI->save($pidata);
			}
			else{
				$savepi = $PI->newEntity();
				$PI->patchEntity($savepi,$this->request->data['PI']);
				$PI->save($savepi);
				
			}
			//PPP - information
			$PPP = $this->Patient->PatientPrimaryPhysician;
			$pppdata = $PPP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($pppdata->id>0){
				$PPP->patchEntity($pppdata,$this->request->data['PPP']);
				$PPP->save($pppdata);
			}
			else{
				$saveppp = $PPP->newEntity();
				$PPP->patchEntity($saveppp,$this->request->data['PPP']);
				$PPP->save($saveppp);
				
			}
			//PP - information
			$PP = $this->Patient->PatientPreferredPharmacy;
			$ppdata = $PP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($ppdata->id>0){
				$PP->patchEntity($ppdata,$this->request->data['PP']);
				$PP->save($ppdata);
			}
			else{
				$savepp = $PP->newEntity();
				$PP->patchEntity($savepp,$this->request->data['PP']);
				$PP->save($savepp);
				
			}
			$patient = $this->Patient->patchEntity($patient, $this->request->data);
			if ($this->Patient->save($patient)) {
				return $this->redirect(array('controller'=>'claim','action' => 'claimdentalform',$id));
			}
			 else{
				  $this->Flash->error(__('The patient could not be verify. Please, try again.'));
			 }
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
        $practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$patientId=CommonHelper::uniqueNumber(99);
		$this->set('practice_id',$practice_id);
        $this->set(compact('patient', 'practice','RP','PPP','PP','PI','states','patientId'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    }
	public function processdraft($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
             'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//return $this->redirect(array('controller'=>'claim','action' => 'claimdentalform',$id));'
			$this->request->data['RP']['patient_id']=$claim->patient_id;
		$this->request->data['PI']['patient_id']=$claim->patient_id;
		$this->request->data['PPP']['patient_id']=$claim->patient_id;
		$this->request->data['PP']['patient_id']=$claim->patient_id;
		$this->request->data['dob']=date("Y-m-d",strtotime($this->request->data['dob']));
		//$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		if($this->request->data['RP']['dob']==''){
			$this->request->data['RP']['dob']="0000-00-00";
		}
		else{
			$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		}
		if(!isset($this->request->data['PI']['is_migtant_worker'])){$this->request->data['PI']['is_migtant_worker']=0;}
		if(!isset($this->request->data['PI']['is_dependent_of_a_migrant_worker'])){$this->request->data['PI']['is_dependent_of_a_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_seasonal_migrant_worker'])){$this->request->data['PI']['is_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker'])){$this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['non_agricultural_worker'])){$this->request->data['PI']['non_agricultural_worker']=0;}
		if(!isset($this->request->data['PI']['refused_unreported'])){$this->request->data['PI']['refused_unreported']=0;}
		//print_r($this->request->data); exit;
			//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			/*if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}*/
			// Progress-notes
			
			/*if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}*/
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// document upload code end here
			//save PR information
			
		//	if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
			// document upload code end here
			//save PR information
			$RP = $this->Patient->PatientResponsibleParty;
			$prdata = $RP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($prdata->id>0){
				$RP->patchEntity($prdata,$this->request->data['RP']);
				$RP->save($prdata);
			}
			else{
				$savepr = $RP->newEntity();
				$RP->patchEntity($savepr,$this->request->data['RP']);
				$RP->save($savepr);
				
			}
			//API - additional information
			$PI = $this->Patient->PatientInfo;
			$pidata = $PI->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($pidata->id>0){
				$PI->patchEntity($pidata,$this->request->data['PI']);
				$PI->save($pidata);
			}
			else{
				$savepi = $PI->newEntity();
				$PI->patchEntity($savepi,$this->request->data['PI']);
				$PI->save($savepi);
				
			}
			//PPP - information
			$PPP = $this->Patient->PatientPrimaryPhysician;
			$pppdata = $PPP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($pppdata->id>0){
				$PPP->patchEntity($pppdata,$this->request->data['PPP']);
				$PPP->save($pppdata);
			}
			else{
				$saveppp = $PPP->newEntity();
				$PPP->patchEntity($saveppp,$this->request->data['PPP']);
				$PPP->save($saveppp);
				
			}
			//PP - information
			$PP = $this->Patient->PatientPreferredPharmacy;
			$ppdata = $PP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($ppdata->id>0){
				$PP->patchEntity($ppdata,$this->request->data['PP']);
				$PP->save($ppdata);
			}
			else{
				$savepp = $PP->newEntity();
				$PP->patchEntity($savepp,$this->request->data['PP']);
				$PP->save($savepp);
				
			}
			$patient = $this->Patient->patchEntity($patient, $this->request->data);
			if ($this->Patient->save($patient)) {
				return $this->redirect(array('controller'=>'claim','action' => 'claimdentalform',$id));
			}
			 else{
				  $this->Flash->error(__('The patient could not be verify. Please, try again.'));
			 }
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
        $practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$patientId=CommonHelper::uniqueNumber(99);
		$this->set('practice_id',$practice_id);
        $this->set(compact('patient', 'practice','RP','PPP','PP','PI','states','patientId'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    }
	public function superbilldraft($id = null)
    {
		$patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$cptarray=array();
			$icd10array=array();
			
				//print_r($this->request->data['surface18']);	
				/*echo "<pre>";
				print_r($this->request->data);
				echo "</pre>";
				exit;*/
				$ik=0;
			foreach($this->request->data['cptcode'] as $keyc=>$valc){
				$cptarray['_ids'][]=$valc;
				$keyname=$keyc."_".$valc;
				if(!empty($this->request->data['tooth_number'.$keyname])){
					rsort($this->request->data['tooth_number'.$keyname]);
					$cptarray['tooth_number'][$ik]=$this->request->data['tooth_number'.$keyname][0];
				}
				else{
					$cptarray['tooth_number'][$ik]='';
				}
				//echo 'surface'.$keyc."<br>";
				if(!empty($this->request->data['surface'.$keyname])){
					rsort($this->request->data['surface'.$keyname]);
					$cptarray['surface'][$ik]=$this->request->data['surface'.$keyname][0];
				}
				else{
					$cptarray['surface'][$ik]='';
				}
				if(!empty($this->request->data['surface2'.$keyname])){
					rsort($this->request->data['surface2'.$keyname]);
					$cptarray['surface2'][$ik]=$this->request->data['surface2'.$keyname][0];
				}
				else{
					$cptarray['surface2'][$ik]='';
				}
				if(!empty($this->request->data['surface3'.$keyname])){
					rsort($this->request->data['surface3'.$keyname]);
					$cptarray['surface3'][$ik]=$this->request->data['surface3'.$keyname][0];
				}
				else{
					$cptarray['surface3'][$ik]='';
				}
				if(!empty($this->request->data['surface4'.$keyname])){
					rsort($this->request->data['surface4'.$keyname]);
					$cptarray['surface4'][$ik]=$this->request->data['surface4'.$keyname][0];
				}
				else{
					$cptarray['surface4'][$ik]='';
				}
				if(!empty($this->request->data['upper_or_lower'.$keyname])){
					rsort($this->request->data['upper_or_lower'.$keyname]);
					$cptarray['upper_or_lower'][$ik]=$this->request->data['upper_or_lower'.$keyname][0];
				}
				else{
					$cptarray['upper_or_lower'][$ik]='';
				}
				if(!empty($this->request->data['quadrent_1_code'.$keyname])){
					rsort($this->request->data['quadrent_1_code'.$keyname]);
					$cptarray['quadrent_1_code'][$ik]=$this->request->data['quadrent_1_code'.$keyname][0];
				}
				else{
					$cptarray['quadrent_1_code'][$ik]='';
				}
				if(!empty($this->request->data['arch_code'.$keyname])){
					rsort($this->request->data['arch_code'.$keyname]);
					$cptarray['arch_code'][$ik]=$this->request->data['arch_code'.$keyname][0];
				}
				else{
					$cptarray['arch_code'][$ik]='';
				}
				if(!empty($this->request->data['quadrent_or_arch_code'.$keyname])){
					rsort($this->request->data['quadrent_or_arch_code'.$keyname]);
					$cptarray['quadrent_or_arch_code'][$ik]=$this->request->data['quadrent_or_arch_code'.$keyname][0];
				}
				else{
					$cptarray['quadrent_or_arch_code'][$ik]='';
				}
				$ik++;
			}
			$icd10array=array();
			foreach($this->request->data['icd10code'] as $keyc=>$valc){
				$icd10array['_ids'][]=$valc;
			}
			
			$_SESSION['claimdata']['cptcode']=$cptarray;
			$_SESSION['claimdata']['icd10code']=$icd10array;
			$_SESSION['claimdata']['date_of_service']=$this->request->data['date_of_service'];
			$_SESSION['claimdata']['comments']=$this->request->data['comments'];
			
			$optval=array();
			$optval[]=array('Claim.date_of_service'=>($this->request->data['date_of_service']!='')?date("Y-m-d",strtotime($this->request->data['date_of_service'])):'0000-00-00');
			$optval[]=array('Claim.patient_id'=>$id);
			$findclaim=$this->Claim->find("all",array("conditions"=>$optval))->count();
			if($findclaim==0){
				return $this->redirect(array('controller'=>'claim','action' => 'draftbillsummary',$id));
			}
			else{
				 $this->Flash->error(__("Please select a new date of service"));
			}
			
		}
		$cptCodes=array();
		$icd10Codes=array();
		//$cptCodes = $this->Claim->CptCodes->find('list',array('fields'=>array('CptCodes.id','CptCodes.code')), ['limit' => 200]);
		$cptCodes1 = $this->Claim->CptCodes->find('all',array('fields'=>array('CptCodes.id','group'=>'CptCodes.group'),'group'=>'CptCodes.group'), ['limit' => 200]);
		foreach($cptCodes1 as $pkey){
			$cptCodes[$pkey->id]=$pkey->group;
		}
        $icd10Codes1 = $this->Claim->Icd10Codes->find('all',array('fields'=>array('Icd10Codes.id','group'=>'Icd10Codes.group'),'group'=>'Icd10Codes.group'), ['limit' => 200]);
		
		foreach( $icd10Codes1 as $pkey){
			$icd10Codes[$pkey->id]=$pkey->group;
		}
		
        $this->set(compact('patient', 'claimStatus', 'cptCodes', 'icd10Codes'));
        $this->set('_serialize', ['patient']);
	}
	public function superbill($id = null)
    {
		$patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$cptarray=array();
			$icd10array=array();
			
				//print_r($this->request->data['surface18']);	
				/*echo "<pre>";
				print_r($this->request->data);
				echo "</pre>";
				exit;*/
				$ik=0;
			foreach($this->request->data['cptcode'] as $keyc=>$valc){
				$cptarray['_ids'][]=$valc;
				$keyname=$keyc."_".$valc;
				if(!empty($this->request->data['tooth_number'.$keyname])){
					rsort($this->request->data['tooth_number'.$keyname]);
					$cptarray['tooth_number'][$ik]=$this->request->data['tooth_number'.$keyname][0];
				}
				else{
					$cptarray['tooth_number'][$ik]='';
				}
				//echo 'surface'.$keyc."<br>";
				if(!empty($this->request->data['surface'.$keyname])){
					rsort($this->request->data['surface'.$keyname]);
					$cptarray['surface'][$ik]=$this->request->data['surface'.$keyname][0];
				}
				else{
					$cptarray['surface'][$ik]='';
				}
				if(!empty($this->request->data['surface2'.$keyname])){
					rsort($this->request->data['surface2'.$keyname]);
					$cptarray['surface2'][$ik]=$this->request->data['surface2'.$keyname][0];
				}
				else{
					$cptarray['surface2'][$ik]='';
				}
				if(!empty($this->request->data['surface3'.$keyname])){
					rsort($this->request->data['surface3'.$keyname]);
					$cptarray['surface3'][$ik]=$this->request->data['surface3'.$keyname][0];
				}
				else{
					$cptarray['surface3'][$ik]='';
				}
				if(!empty($this->request->data['surface4'.$keyname])){
					rsort($this->request->data['surface4'.$keyname]);
					$cptarray['surface4'][$ik]=$this->request->data['surface4'.$keyname][0];
				}
				else{
					$cptarray['surface4'][$ik]='';
				}
				if(!empty($this->request->data['upper_or_lower'.$keyname])){
					rsort($this->request->data['upper_or_lower'.$keyname]);
					$cptarray['upper_or_lower'][$ik]=$this->request->data['upper_or_lower'.$keyname][0];
				}
				else{
					$cptarray['upper_or_lower'][$ik]='';
				}
				if(!empty($this->request->data['quadrent_1_code'.$keyname])){
					rsort($this->request->data['quadrent_1_code'.$keyname]);
					$cptarray['quadrent_1_code'][$ik]=$this->request->data['quadrent_1_code'.$keyname][0];
				}
				else{
					$cptarray['quadrent_1_code'][$ik]='';
				}
				if(!empty($this->request->data['arch_code'.$keyname])){
					rsort($this->request->data['arch_code'.$keyname]);
					$cptarray['arch_code'][$ik]=$this->request->data['arch_code'.$keyname][0];
				}
				else{
					$cptarray['arch_code'][$ik]='';
				}
				if(!empty($this->request->data['quadrent_or_arch_code'.$keyname])){
					rsort($this->request->data['quadrent_or_arch_code'.$keyname]);
					$cptarray['quadrent_or_arch_code'][$ik]=$this->request->data['quadrent_or_arch_code'.$keyname][0];
				}
				else{
					$cptarray['quadrent_or_arch_code'][$ik]='';
				}
				$ik++;
			}
			$icd10array=array();
			foreach($this->request->data['icd10code'] as $keyc=>$valc){
				$icd10array['_ids'][]=$valc;
			}
			
			$_SESSION['claimdata']['cptcode']=$cptarray;
			$_SESSION['claimdata']['icd10code']=$icd10array;
			$_SESSION['claimdata']['date_of_service']=$this->request->data['date_of_service'];
			$_SESSION['claimdata']['comments']=$this->request->data['comments'];
			
			$optval=array();
			$optval[]=array('Claim.date_of_service'=>date("Y-m-d",strtotime($this->request->data['date_of_service'])));
			$optval[]=array('Claim.patient_id'=>$id);
			$findclaim=$this->Claim->find("all",array("conditions"=>$optval))->count();
			if($findclaim==0){
				return $this->redirect(array('controller'=>'claim','action' => 'billsummary',$id));
			}
			else{
				 $this->Flash->error(__("Please select a new date of service"));
			}
			
		}
		$cptCodes=array();
		$icd10Codes=array();
		//$cptCodes = $this->Claim->CptCodes->find('list',array('fields'=>array('CptCodes.id','CptCodes.code')), ['limit' => 200]);
		$cptCodes1 = $this->Claim->CptCodes->find('all',array('fields'=>array('CptCodes.id','group'=>'CptCodes.group'),'group'=>'CptCodes.group'), ['limit' => 200]);
		foreach($cptCodes1 as $pkey){
			$cptCodes[$pkey->id]=$pkey->group;
		}
        $icd10Codes1 = $this->Claim->Icd10Codes->find('all',array('fields'=>array('Icd10Codes.id','group'=>'Icd10Codes.group'),'group'=>'Icd10Codes.group'), ['limit' => 200]);
		
		foreach( $icd10Codes1 as $pkey){
			$icd10Codes[$pkey->id]=$pkey->group;
		}
		
        $this->set(compact('patient', 'claimStatus', 'cptCodes', 'icd10Codes'));
        $this->set('_serialize', ['patient']);
	}
	public function claimsuperbill($id = null)
    {
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$cptarray=array();
			$icd10array=array();
			//print_r($this->request->data);exit;		
			$ik=0;
			foreach($this->request->data['cptcode'] as $keyc=>$valc){
				$cptarray['_ids'][]=$valc;
				$keyname=$keyc."_".$valc;
				if(!empty($this->request->data['tooth_number'.$keyname])){
					rsort($this->request->data['tooth_number'.$keyname]);
					$cptarray['tooth_number'][$ik]=$this->request->data['tooth_number'.$keyname][0];
				}
				else{
					$cptarray['tooth_number'][$ik]='';
				}
				//echo 'surface'.$keyc."<br>";
				if(!empty($this->request->data['surface'.$keyname])){
					rsort($this->request->data['surface'.$keyname]);
					$cptarray['surface'][$ik]=$this->request->data['surface'.$keyname][0];
				}
				else{
					$cptarray['surface'][$ik]='';
				}
				if(!empty($this->request->data['surface2'.$keyname])){
					rsort($this->request->data['surface2'.$keyname]);
					$cptarray['surface2'][$ik]=$this->request->data['surface2'.$keyname][0];
				}
				else{
					$cptarray['surface2'][$ik]='';
				}
				if(!empty($this->request->data['surface3'.$keyname])){
					rsort($this->request->data['surface3'.$keyname]);
					$cptarray['surface3'][$ik]=$this->request->data['surface3'.$keyname][0];
				}
				else{
					$cptarray['surface3'][$ik]='';
				}
				if(!empty($this->request->data['surface4'.$keyname])){
					rsort($this->request->data['surface4'.$keyname]);
					$cptarray['surface4'][$ik]=$this->request->data['surface4'.$keyname][0];
				}
				else{
					$cptarray['surface4'][$ik]='';
				}
				if(!empty($this->request->data['upper_or_lower'.$keyname])){
					rsort($this->request->data['upper_or_lower'.$keyname]);
					$cptarray['upper_or_lower'][$ik]=$this->request->data['upper_or_lower'.$keyname][0];
				}
				else{
					$cptarray['upper_or_lower'][$ik]='';
				}
				if(!empty($this->request->data['quadrent_1_code'.$keyname])){
					rsort($this->request->data['quadrent_1_code'.$keyname]);
					$cptarray['quadrent_1_code'][$ik]=$this->request->data['quadrent_1_code'.$keyname][0];
				}
				else{
					$cptarray['quadrent_1_code'][$ik]='';
				}
				if(!empty($this->request->data['arch_code'.$keyname])){
					rsort($this->request->data['arch_code'.$keyname]);
					$cptarray['arch_code'][$ik]=$this->request->data['arch_code'.$keyname][0];
				}
				else{
					$cptarray['arch_code'][$ik]='';
				}
				if(!empty($this->request->data['quadrent_or_arch_code'.$keyname])){
					rsort($this->request->data['quadrent_or_arch_code'.$keyname]);
					$cptarray['quadrent_or_arch_code'][$ik]=$this->request->data['quadrent_or_arch_code'.$keyname][0];
				}
				else{
					$cptarray['quadrent_or_arch_code'][$ik]='';
				}
				$ik++;
			}
			$icd10array=array();
			
			foreach($this->request->data['icd10code'] as $keyc=>$valc){
				$icd10array['_ids'][]=$valc;
			}
			$_SESSION['claimdata']['cptcode']=$cptarray;
			$_SESSION['claimdata']['icd10code']=$icd10array;
			$_SESSION['claimdata']['date_of_service']=$this->request->data['date_of_service'];
			$_SESSION['claimdata']['comments']=$this->request->data['comments'];
			return $this->redirect(array('controller'=>'claim','action' => 'claimbillsummary',$id));
			
		}
		$cptCodes=array();
		$icd10Codes=array();
		//$cptCodes = $this->Claim->CptCodes->find('list',array('fields'=>array('CptCodes.id','CptCodes.code')), ['limit' => 200]);
		$cptCodes1 = $this->Claim->CptCodes->find('all',array('fields'=>array('CptCodes.id','group'=>'CptCodes.group'),'group'=>'CptCodes.group'), ['limit' => 200]);
		foreach($cptCodes1 as $pkey){
			$cptCodes[$pkey->id]=$pkey->group;
		}
        $icd10Codes1 = $this->Claim->Icd10Codes->find('all',array('fields'=>array('Icd10Codes.id','group'=>'Icd10Codes.group'),'group'=>'Icd10Codes.group'), ['limit' => 200]);
		
		foreach( $icd10Codes1 as $pkey){
			$icd10Codes[$pkey->id]=$pkey->group;
		}
		$cptmodel=TableRegistry::get('CptCodes');
		$icdmodel=TableRegistry::get('Icd10Codes');
		
        $this->set(compact('patient','claim', 'claimStatus', 'cptCodes', 'icd10Codes','cptmodel','icdmodel'));
        $this->set('_serialize', ['patient']);
	}
	public function draftbillsummary($id = null)
    {
		$loguser = $this->request->session()->read('Auth.User');
		$patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$loguser['id']])->first()->toArray();
		if ($this->request->is(['patch', 'post', 'put'])) {
			$claim = $this->Claim->newEntity();
			$this->request->data['patient_id']=$id;
			// @prit
			
			if (move_uploaded_file($this->request->data['signature']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['signature']['name']))){
				$this->request->data['signature'] = str_replace(" ","_",$this->request->data['signature']['name']);	
			}
			else{
				$this->request->data['signature'] ='';	
			}
			
			$this->request->data['claim_status_id']=12;
			$this->request->data['modify_by']=0;
			$this->request->data['review_by']=0;
			$this->request->data['claim_number']=$_SESSION['claimdata']['claim_number'];
			$this->request->data['dental_verification_upload']=$_SESSION['claimdata']['dental_verification_upload'];
			$this->request->data['progress_notes_upload']=$_SESSION['claimdata']['progress_notes_upload'];
			$this->request->data['date_of_service'] = (date("Y-m-d",strtotime($_SESSION['claimdata']['date_of_service']))!='0000-00-00')?date("Y-m-d",strtotime($_SESSION['claimdata']['date_of_service'])):'0000-00-00';
			$this->request->data['comments'] = $_SESSION['claimdata']['comments'];
			$this->request->data['user_id']= $loguser['id'];
		//$this->request->data['claim_icd10_codes']=array();
		$claimcptcode = TableRegistry::get('ClaimCptCodes');
		$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
		$claim = $this->Claim->patchEntity($claim, $this->request->data);

			if ($this->Claim->save($claim)) {
				$cptarr=array();
				foreach($_SESSION['claimdata']['cptcode']['_ids'] as $key=>$val){
				
					$tooth_number=$_SESSION['claimdata']['cptcode']['tooth_number'][$key];
					$surface=$_SESSION['claimdata']['cptcode']['surface'][$key];
					$surface2=$_SESSION['claimdata']['cptcode']['surface2'][$key];
					$surface3=$_SESSION['claimdata']['cptcode']['surface3'][$key];
					$surface4=$_SESSION['claimdata']['cptcode']['surface4'][$key];
					$upper_or_lower=$_SESSION['claimdata']['cptcode']['upper_or_lower'][$key];
					$quadrent_1_code=$_SESSION['claimdata']['cptcode']['quadrent_1_code'][$key];
					$arch_code=$_SESSION['claimdata']['cptcode']['arch_code'][$key];
					$quadrent_or_arch_code=$_SESSION['claimdata']['cptcode']['quadrent_or_arch_code'][$key];
					$quadrent_2_code='';//$_SESSION['claimdata']['quadrent_2_code'][$key];
					$cptarr=array("claim_id"=>$claim->id,"cpt_code_id"=>$val,"upper_or_lower"=>$upper_or_lower,"tooth_number"=>$tooth_number,"surface"=>$surface,"surface2"=>$surface2,"surface3"=>$surface3,"surface4"=>$surface4,"quadrent_1_code"=>$quadrent_1_code,"quadrent_2_code"=>$quadrent_2_code,"arch_code"=>$arch_code);
					$savepp = $claimcptcode->newEntity();
					$dd=$claimcptcode->patchEntity($savepp,$cptarr);
					$claimcptcode->save($savepp);
				}
				foreach($_SESSION['claimdata']['icd10code']['_ids'] as $key=>$val){
					$cptarr=array("claim_id"=>$claim->id,"icd10_code_id"=>$val);
					$savepp = $claimicdcode->newEntity();
					$dd=$claimicdcode->patchEntity($savepp,$cptarr);
					$claimicdcode->save($savepp);
				}
				unset($_SESSION['claimdata']);
                $this->Flash->success(__('The claim has been saved.'));
				if($loguser['group_id']==5){
					return $this->redirect(['action' => 'draftclaim']);
				}
				else{
               		return $this->redirect(['action' => 'draftclaim']);
			   }
            } else {
			
                $this->Flash->error(__('The claim could not be saved. Please, try again.'));
            }
			
		}
		$claimdata=$_SESSION['claimdata'];
		$cptids=$claimdata['cptcode']['_ids'];
		$icd10ids=$claimdata['icd10code']['_ids'];
		if(empty($cptids)){
			$cptids=array(-1);
		}
		if(empty($icd10ids)){
			$icd10ids=array(-1);
		}
		$cptCodes = $this->Claim->CptCodes->find('all',array('fields'=>array('id'=>'CptCodes.id','code'=>'CptCodes.code','description'=>'CptCodes.description','group'=>'CptCodes.group')))->where(['CptCodes.id IN '=>$cptids])->toArray();
		$icd10Codes = $this->Claim->Icd10Codes->find('all',array('fields'=>array('code'=>'Icd10Codes.code','description'=>'Icd10Codes.description','group'=>'Icd10Codes.group')))->where(['Icd10Codes.id IN '=>$icd10ids])->toArray();

		//print_r($claimdata);exit;
		$loginuser=$loguser;
        $this->set(compact('patient','claimdata','cptCodes','icd10Codes','loginuser','claimusers'));
        $this->set('_serialize', ['patient']);
	
	}
	public function billsummary($id = null)
    {
		$loguser = $this->request->session()->read('Auth.User');
		$patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$loguser['id']])->first()->toArray();
		if ($this->request->is(['patch', 'post', 'put'])) {
			$claim = $this->Claim->newEntity();
			$this->request->data['patient_id']=$id;
			// @prit
			
			if (move_uploaded_file($this->request->data['signature']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['signature']['name']))){
				$this->request->data['signature'] = str_replace(" ","_",$this->request->data['signature']['name']);	
			}
			else{
				$this->request->data['signature'] ='';	
			}
			
			$this->request->data['claim_status_id']=3;
			$this->request->data['modify_by']=0;
			$this->request->data['review_by']=0;
			$this->request->data['claim_number']=$_SESSION['claimdata']['claim_number'];
			$this->request->data['dental_verification_upload']=$_SESSION['claimdata']['dental_verification_upload'];
			$this->request->data['progress_notes_upload']=$_SESSION['claimdata']['progress_notes_upload'];
			$this->request->data['date_of_service'] = date("Y-m-d",strtotime($_SESSION['claimdata']['date_of_service']));
			$this->request->data['comments'] = $_SESSION['claimdata']['comments'];
			$this->request->data['user_id']= $loguser['id'];
		//$this->request->data['claim_icd10_codes']=array();
		$claimcptcode = TableRegistry::get('ClaimCptCodes');
		$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
		$claim = $this->Claim->patchEntity($claim, $this->request->data);

			if ($this->Claim->save($claim)) {
				$cptarr=array();
				foreach($_SESSION['claimdata']['cptcode']['_ids'] as $key=>$val){
				
					$tooth_number=$_SESSION['claimdata']['cptcode']['tooth_number'][$key];
					$surface=$_SESSION['claimdata']['cptcode']['surface'][$key];
					$surface2=$_SESSION['claimdata']['cptcode']['surface2'][$key];
					$surface3=$_SESSION['claimdata']['cptcode']['surface3'][$key];
					$surface4=$_SESSION['claimdata']['cptcode']['surface4'][$key];
					$upper_or_lower=$_SESSION['claimdata']['cptcode']['upper_or_lower'][$key];
					$quadrent_1_code=$_SESSION['claimdata']['cptcode']['quadrent_1_code'][$key];
					$arch_code=$_SESSION['claimdata']['cptcode']['arch_code'][$key];
					$quadrent_or_arch_code=$_SESSION['claimdata']['cptcode']['quadrent_or_arch_code'][$key];
					$quadrent_2_code='';//$_SESSION['claimdata']['quadrent_2_code'][$key];
					$cptarr=array("claim_id"=>$claim->id,"cpt_code_id"=>$val,"upper_or_lower"=>$upper_or_lower,"tooth_number"=>$tooth_number,"surface"=>$surface,"surface2"=>$surface2,"surface3"=>$surface3,"surface4"=>$surface4,"quadrent_1_code"=>$quadrent_1_code,"quadrent_2_code"=>$quadrent_2_code,"arch_code"=>$arch_code);
					$savepp = $claimcptcode->newEntity();
					$dd=$claimcptcode->patchEntity($savepp,$cptarr);
					$claimcptcode->save($savepp);
				}
				foreach($_SESSION['claimdata']['icd10code']['_ids'] as $key=>$val){
					$cptarr=array("claim_id"=>$claim->id,"icd10_code_id"=>$val);
					$savepp = $claimicdcode->newEntity();
					$dd=$claimicdcode->patchEntity($savepp,$cptarr);
					$claimicdcode->save($savepp);
				}
				unset($_SESSION['claimdata']);
                $this->Flash->success(__('The claim has been saved.'));
				if($loguser['group_id']==5){
					return $this->redirect(['action' => 'index']);
				}
				else{
               return $this->redirect(['action' => 'reimbursement']);
			   }
            } else {
			
                $this->Flash->error(__('The claim could not be saved. Please, try again.'));
            }
			
		}
		$claimdata=$_SESSION['claimdata'];
		$cptids=$claimdata['cptcode']['_ids'];
		$icd10ids=$claimdata['icd10code']['_ids'];
		if(empty($cptids)){
			$cptids=array(-1);
		}
		if(empty($icd10ids)){
			$icd10ids=array(-1);
		}
		$cptCodes = $this->Claim->CptCodes->find('all',array('fields'=>array('id'=>'CptCodes.id','code'=>'CptCodes.code','description'=>'CptCodes.description','group'=>'CptCodes.group')))->where(['CptCodes.id IN '=>$cptids])->toArray();
		$icd10Codes = $this->Claim->Icd10Codes->find('all',array('fields'=>array('code'=>'Icd10Codes.code','description'=>'Icd10Codes.description','group'=>'Icd10Codes.group')))->where(['Icd10Codes.id IN '=>$icd10ids])->toArray();

		//print_r($claimdata);exit;
		$loginuser=$loguser;
        $this->set(compact('patient','claimdata','cptCodes','icd10Codes','loginuser','claimusers'));
        $this->set('_serialize', ['patient']);
	
	}
	public function claimbillsummary($id = null)
    {
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['CptCodes', 'Icd10Codes']
        ]);
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$claim->user_id])->first()->toArray();
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			//$claim = $this->Claim->newEntity();
			if (move_uploaded_file($this->request->data['signature']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['signature']['name']))){
				$this->request->data['signature'] = str_replace(" ","_",$this->request->data['signature']['name']);	
			}
			else{
				$this->request->data['signature'] =$claim->signature;	
			}
			$claim_status_id=$claim->claim_status_id;
			$this->request->data['patient_id']=$claim->patient_id;
			$this->request->data['claim_status_id']=3;
			$this->request->data['claim_number']=$_SESSION['claimdata']['claim_number'];
			$this->request->data['dental_verification_upload']=$_SESSION['claimdata']['dental_verification_upload'];
			$this->request->data['progress_notes_upload']=$_SESSION['claimdata']['progress_notes_upload'];
			$this->request->data['date_of_service'] = date("Y-m-d",strtotime($_SESSION['claimdata']['date_of_service']));
			$this->request->data['user_id']= $claim->user_id;
			//$this->request->data['id']=$id;
		//$this->request->data['claim_icd10_codes']=array();
		$claimcptcode = TableRegistry::get('ClaimCptCodes');
		$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
		$claim = $this->Claim->patchEntity($claim, $this->request->data);
		
			if ($this->Claim->save($claim)) {
				$cptarr=array();
				$prdata = $claimcptcode->find('all')->where(['claim_id' => $id])->first();
				if($prdata->id>0){
					$claimcptcode->deleteAll(['ClaimCptCodes.claim_id IN ' => $claim->id]);
				}
				$prdata = $claimicdcode->find('all')->where(['claim_id' => $id])->first();
				if($prdata->id>0){
					$claimicdcode->deleteAll(['ClaimIcd10Codes.claim_id IN ' => $claim->id]);
				}	
				foreach($_SESSION['claimdata']['cptcode']['_ids'] as $key=>$val){
				
					$tooth_number=$_SESSION['claimdata']['cptcode']['tooth_number'][$key];
					$surface=$_SESSION['claimdata']['cptcode']['surface'][$key];
					$surface2=$_SESSION['claimdata']['cptcode']['surface2'][$key];
					$surface3=$_SESSION['claimdata']['cptcode']['surface3'][$key];
					$surface4=$_SESSION['claimdata']['cptcode']['surface4'][$key];
					$upper_or_lower=$_SESSION['claimdata']['cptcode']['upper_or_lower'][$key];
					$quadrent_1_code=$_SESSION['claimdata']['cptcode']['quadrent_1_code'][$key];
					$arch_code=$_SESSION['claimdata']['cptcode']['arch_code'][$key];
					$quadrent_or_arch_code=$_SESSION['claimdata']['cptcode']['quadrent_or_arch_code'][$key];
					$quadrent_2_code='';//$_SESSION['claimdata']['quadrent_2_code'][$key];
					$cptarr=array("claim_id"=>$claim->id,"cpt_code_id"=>$val,"upper_or_lower"=>$upper_or_lower,"tooth_number"=>$tooth_number,"surface"=>$surface,"surface2"=>$surface2,"surface3"=>$surface3,"surface4"=>$surface4,"quadrent_1_code"=>$quadrent_1_code,"quadrent_2_code"=>$quadrent_2_code,"arch_code"=>$arch_code);
					$savepp = $claimcptcode->newEntity();
					$dd=$claimcptcode->patchEntity($savepp,$cptarr);
					$claimcptcode->save($savepp);
				}
				foreach($_SESSION['claimdata']['icd10code']['_ids'] as $key=>$val){
					$cptarr=array("claim_id"=>$claim->id,"icd10_code_id"=>$val);
					$savepp = $claimicdcode->newEntity();
					$dd=$claimicdcode->patchEntity($savepp,$cptarr);
					$claimicdcode->save($savepp);
				}
				unset($_SESSION['claimdata']);
                $this->Flash->success(__('The claim has been saved.'));
				if($loguser['group_id']==5){
						return $this->redirect(['action' => 'index']);
			   }
			   else{
			   		return $this->redirect(['action' => 'claimviewcues']);
			   }
            } else {
			//print_r($claim->errors());
                $this->Flash->error(__('The claim could not be saved. Please, try again.'));
            }
			
		}
		$claimdata=$_SESSION['claimdata'];
		$cptids=$claimdata['cptcode']['_ids'];
		$icd10ids=$claimdata['icd10code']['_ids'];
		if(empty($cptids)){
			$cptids=array(-1);
		}
		if(empty($icd10ids)){
			$icd10ids=array(-1);
		}
		$cptCodes = $this->Claim->CptCodes->find('all',array('fields'=>array('id'=>'CptCodes.id','code'=>'CptCodes.code','description'=>'CptCodes.description','group'=>'CptCodes.group')))->where(['CptCodes.id IN '=>$cptids])->toArray();
		$icd10Codes = $this->Claim->Icd10Codes->find('all',array('fields'=>array('code'=>'Icd10Codes.code','description'=>'Icd10Codes.description','group'=>'Icd10Codes.group')))->where(['Icd10Codes.id IN '=>$icd10ids])->toArray();

		//print_r($claimdata);exit;
		
        $this->set(compact('patient','claim','claimdata','cptCodes','icd10Codes','claimusers'));
        $this->set('_serialize', ['patient']);
	}
	 public function claimreview($id = null)
    {
	
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		if($loguser['group_id']==1){}else{
			if($claim->modify_by==0){
				$query = $this->Claim->query();
				$query->update()
					->set(['modify_by' => $loguser['id']])
					->where(['id' => $id])
					->execute();
					$claim = $this->Claim->get($id, [
				'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
			]);
			}
			$allowed=0;
			if($claim->modify_by==0 || ($claim->modify_by==$loguser['id'])){
				$allowed=1;
			}
			if($allowed==0){
				$this->Flash->error(__('This Claim is Being Reviewed.'));
				if($loguser['group_id']==8){
					return $this->redirect(['action' => 'allclaimreview']);
				}
				else{
					return $this->redirect(['action' => 'claimviewcues']);
				}
				
				
			}
		}
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$claim->user_id])->first()->toArray();
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}
			// Progress-notes
			
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// save patient
			$queryp = TableRegistry::get('Patient')->query();
			$queryp->update()
				->set(['img_photo_id_upload' =>$this->request->data['img_photo_id_upload']])
				->set(['img_medicare_card' =>$this->request->data['img_medicare_card']])
				->set(['consent_form_upload' =>$this->request->data['consent_form_upload']])
				->set(['registration_form_upload' =>$this->request->data['registration_form_upload']])
				->where(['id' => $claim->patient_id])
				->execute();
				
			$query = TableRegistry::get('Claim')->query();
			$query->update()
				//->set(['comments' => $this->request->data['comments']])
				->set(['modify_by' =>0])
				->set(['dental_verification_upload' =>$this->request->data['dental_verification_upload']])
				->set(['progress_notes_upload' =>$this->request->data['progress_notes_upload']])
				->set(['claim_status_id' => $this->request->data['claim_status_id']])
				->where(['id' => $id])
				->execute();
				// save review table
				$reviewarr=array("claim_id"=>$id,"user_id"=>$loguser['id']);
				$RR = TableRegistry::get('Review');
				$saveRR = $RR->newEntity();
				$dd=$RR->patchEntity($saveRR,$reviewarr);
				$RR->save($saveRR);
				// save notes table
				$b = 0;
				$data_array = array();
				foreach($this->request->data['notes']['note'] as $note)
				{
					//if($note != ''){
				$data_array['notes'][] = array('note' => $note,'option1' => $this->request->data['notes']['option1'][$b],'type' => 'Review','claim_id' => $id,'user_id' => $loguser['id'],'extranote' => $this->request->data['notes']['extranote']);
					$b++;
					//}
				}
				
				foreach( $data_array['notes'] as $note_key => $note) {
				$this->request->data['notes']['note']=$note['note'];	
				$this->request->data['notes']['option1']=$note['option1'];
				$this->request->data['notes']['extranote']=$note['extranote'];
				$this->request->data['notes']['type']="Review";
				$this->request->data['notes']['claim_id']=$id;
				$this->request->data['notes']['user_id']=$loguser['id'];
				$RR = TableRegistry::get('Notes');
				$saveRR = $RR->newEntity();
				$dd=$RR->patchEntity($saveRR,$note);
				$RR->save($saveRR);
				$j++;
		 }
		 
				$this->Flash->success(__('The claim review has been saved.'));
				
				if($loguser['group_id']==8){
					return $this->redirect(['action' => 'allclaimreview']);
				}
				else{
                	return $this->redirect(['action' => 'claimviewcues']);
				}
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
		if($claim->user_id){
        $Users = $this->loadModel('Users')->get($claim->user_id);
		$Usersname = $Users->username;
		}else
		{
			$Usersname = '';
		}
		
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$claimStatus = $this->Claim->ClaimStatus->find('list')->where(['ClaimStatus.id IN '=>array(1,5,6)]);
		$cloguser=$loguser;
        $this->set(compact('claim','claimStatus','patient', 'practice','RP','PPP','PP','PI','Usersname','claimusers','cloguser'));
        $this->set('_serialize', ['claim','patient','claimStatus']);
    
	}
	public function claimappealreview($id = null)
    {
	
		$loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(8);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		/*if($claim->modify_by==0){
			$query = $this->Claim->query();
			$query->update()
				->set(['modify_by' => $loguser['id']])
				->where(['id' => $id])
				->execute();
				$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		}
		$allowed=0;
		if($claim->modify_by==0 || ($claim->modify_by==$loguser['id'])){
			$allowed=1;
		}
		if($allowed==0){
			$this->Flash->error(__('This Claim is Being Reviewed.'));
			return $this->redirect(['action' => 'claimviewcues']);
			
		}*/
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$claim->user_id])->first()->toArray();
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}
			// Progress-notes
			
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// save patient
			$queryp = TableRegistry::get('Patient')->query();
			$queryp->update()
				->set(['img_photo_id_upload' =>$this->request->data['img_photo_id_upload']])
				->set(['img_medicare_card' =>$this->request->data['img_medicare_card']])
				->set(['consent_form_upload' =>$this->request->data['consent_form_upload']])
				->set(['registration_form_upload' =>$this->request->data['registration_form_upload']])
				->where(['id' => $claim->patient_id])
				->execute();
				
			$query = TableRegistry::get('Claim')->query();
			$query->update()
				//->set(['comments' => $this->request->data['comments']])
				//->set(['modify_by' =>0])
				->set(['dental_verification_upload' =>$this->request->data['dental_verification_upload']])
				->set(['progress_notes_upload' =>$this->request->data['progress_notes_upload']])
				//->set(['claim_status_id' => $this->request->data['claim_status_id']])
				->where(['id' => $id])
				->execute();
			// update appeal status
			$query = TableRegistry::get('ClaimAppeals')->query();
			$query->update()
				->set(['appeal_status' =>$this->request->data['appeal_status']])
				->where(['claim_id' => $id])
				->execute();	
				$this->Flash->success(__('The claim appeal has been reviewed.'));
                return $this->redirect(['action' => 'allclaimreview']);
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
		if($claim->user_id){
        $Users = $this->loadModel('Users')->get($claim->user_id);
		$Usersname = $Users->username;
		}else
		{
			$Usersname = '';
		}
		
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);	
		$users = TableRegistry::get('Users')->find('list',array('fields'=>array('id','email')))->toArray();
		$payments = TableRegistry::get('ClaimPayment')->find('all')->where(['claim_id'=>$id])->toArray();
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['claim_id IN '=>$id])->toArray();
		$appealpayment=array();
		foreach($payment1 as $key=>$val){
			$appealpayment=$val;
		}
        $this->set(compact('claim','patient', 'practice','RP','PPP','PP','PI','Usersname','claimusers','appealpayment','payments','users'));
        $this->set('_serialize', ['claim','patient']);
    
	}
	public function claimbillreview($id = null)
    {
	
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		if($loguser['group_id']==1){}
		else{
			if($claim->review_by==0){
				$query = $this->Claim->query();
				$query->update()
					->set(['review_by' => $loguser['id']])
					->where(['id' => $id])
					->execute();
					$claim = $this->Claim->get($id, [
				'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
			]);
			}
			$allowed=0;
			if($claim->review_by==0 || ($claim->review_by==$loguser['id'])){
				$allowed=1;
			}
			if($allowed==0){
				$this->Flash->error(__('This Claim is Being Reviewed.'));
				if($loguser['group_id']==9){
					return $this->redirect(['action' => 'allclaimbillreview']);
				}
				else{
					return $this->redirect(['action' => 'claimviewcues']);
				}
				//return $this->redirect(['action' => 'claimviewcues']);
				
			}
		}	
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$claim->user_id])->first()->toArray();
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {

			$query = TableRegistry::get('Claim')->query();
			$query->update()
				//->set(['comments' => $this->request->data['comments']])
				->set(['review_by' =>0])
				->set(['claim_status_id' => $this->request->data['claim_status_id']])
				->where(['id' => $id])
				->execute();
				// save review table
				$reviewarr=array("claim_id"=>$id,"user_id"=>$loguser['id']);
				$RR = TableRegistry::get('Review');
				$saveRR = $RR->newEntity();
				$dd=$RR->patchEntity($saveRR,$reviewarr);
				$RR->save($saveRR);
				// save notes table
				
				$this->request->data['notes']['type']="Billing";
				$this->request->data['notes']['claim_id']=$id;
				$this->request->data['notes']['user_id']=$loguser['id'];
				$RR = TableRegistry::get('Notes');
				$saveRR = $RR->newEntity();
				$dd=$RR->patchEntity($saveRR,$this->request->data['notes']);
				$RR->save($saveRR);
				
				// payment save
		 
		
			
			  $ClaimPaymentquery = TableRegistry::get('ClaimPayment');
				
				$ClaimPaymentload =   $ClaimPaymentquery->find('all')->where(['claim_id'=>$id])->first();
				
			  $payamount = 0;
			  if($this->request->data['payment_amount']>0)
			  {
				  $payamount = $this->request->data['payment_amount'];
			  }
			if($payamount>0) {
				 if( $ClaimPaymentload->id>0)
				 {
					$ClaimPaymentquery->query()->update()
						->set(['pay_amount' => $payamount])
						->set(['ehs_number' => $this->request->data['ehs_number']])
						->where(['claim_id' => $id])
						->execute();		
				 }else
				 {
					 
					 $ClaimPaymentarr=array("claim_id"=>$id,"pay_amount"=>$payamount,'ehs_number' => $this->request->data['ehs_number']);
						$RRP = $ClaimPaymentquery;
						$saveRRP = $RRP->newEntity();
						$ddP=$RRP->patchEntity($saveRRP,$ClaimPaymentarr);
						$RRP->save($saveRRP);		
				 }
			} 
				$this->Flash->success(__('The claim biller review has been saved.'));
                if($loguser['group_id']==9){
					return $this->redirect(['action' => 'allclaimbillreview']);
				}
				else{
                	return $this->redirect(['action' => 'claimviewcues']);
				}
				//return $this->redirect(['action' => 'claimviewcues']);
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
		$notesload =   TableRegistry::get('Notes')->find('all')->where(['claim_id '=>$id])->andWhere(['type'=>'Review']);
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$claimStatus = $this->Claim->ClaimStatus->find('list')->where(['ClaimStatus.id IN '=>array(1,6,8)]);
		$cloguser=$loguser;
		$this->set('reviewnote', $notesload);
        $this->set(compact('claim','claimStatus','patient', 'practice','RP','PPP','PP','PI','claimusers','cloguser'));
        $this->set('_serialize', ['claim','patient','claimStatus']);
    
	}
	public function claimappealbillreview($id = null)
    {
	
		$loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(9);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		/*if($claim->review_by==0){
			$query = $this->Claim->query();
			$query->update()
				->set(['review_by' => $loguser['id']])
				->where(['id' => $id])
				->execute();
				$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		}
		$allowed=0;
		if($claim->review_by==0 || ($claim->review_by==$loguser['id'])){
			$allowed=1;
		}
		if($allowed==0){
			$this->Flash->error(__('This Claim is Being Reviewed.'));
			return $this->redirect(['action' => 'claimviewcues']);
			
		}*/
		$claimusers = TableRegistry::get('Users')->find('all')->where(['id'=>$claim->user_id])->first()->toArray();
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {

			$query = TableRegistry::get('Claim')->query();
			$query->update()
				//->set(['comments' => $this->request->data['comments']])
				//->set(['review_by' =>0])
				->set(['claim_status_id' =>4])
				->where(['id' => $id])
				->execute();
				
				// update appeal status
			$query = TableRegistry::get('ClaimAppeals')->query();
			$query->update()
				->set(['appeal_status' =>$this->request->data['appeal_status']])
				->where(['claim_id' => $id])
				->execute();	
				
				$this->Flash->success(__('The claim biller appeal has been saved.'));
                return $this->redirect(['action' => 'allclaimbillreview']);
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
		//$notesload =   TableRegistry::get('Notes')->find('all')->where(['claim_id '=>$id])->andWhere(['type'=>'Review']);
        $practice = $this->loadModel('Patient')->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$payments = TableRegistry::get('ClaimPayment')->find('all')->where(['claim_id'=>$id])->toArray();
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['claim_id IN '=>$id])->toArray();
		$appealpayment=array();
		foreach($payment1 as $key=>$val){
			$appealpayment=$val;
		}
		$users = TableRegistry::get('Users')->find('list',array('fields'=>array('id','email')))->toArray();
		//$this->set('reviewnote', $notesload);
        $this->set(compact('claim','claimStatus','patient', 'practice','RP','PPP','PP','PI','claimusers','appealpayment','payments','users'));
        $this->set('_serialize', ['claim','patient','claimStatus']);
    
	}
	 public function dentalformdraft($id = null)
    {
        $patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//$this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$_SESSION['claimdata']['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
				$dental_verification_upload=$_SESSION['claimdata']['dental_verification_upload'];
			}
			else{
				$dental_verification_upload=$_SESSION['claimdata']['dental_verification_upload'];
			}
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$_SESSION['claimdata']['progress_notes_upload']= str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);
				$progress_notes_upload=$_SESSION['claimdata']['progress_notes_upload'];	
			}
			else{
				$progress_notes_upload=$_SESSION['claimdata']['progress_notes_upload'];
			}
			$_SESSION['claimdata']['claim_number']=$id.substr(time(),0,4).mt_rand(50,500);
			return $this->redirect(array('controller'=>'claim','action' => 'superbilldraft',$id));
        }
		
        $this->set(compact('patient','progress_notes_upload','dental_verification_upload'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    }
	public function dentalform($id = null)
    {
        $patient = $this->loadModel('Patient')->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//$this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$_SESSION['claimdata']['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
				$dental_verification_upload=$_SESSION['claimdata']['dental_verification_upload'];
			}
			else{
				$dental_verification_upload=$_SESSION['claimdata']['dental_verification_upload'];
			}
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$_SESSION['claimdata']['progress_notes_upload']= str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);
				$progress_notes_upload=$_SESSION['claimdata']['progress_notes_upload'];	
			}
			else{
				$progress_notes_upload=$_SESSION['claimdata']['progress_notes_upload'];
			}
			$_SESSION['claimdata']['claim_number']=$id.substr(time(),0,4).mt_rand(50,500);
			return $this->redirect(array('controller'=>'claim','action' => 'superbill',$id));
        }
		
        $this->set(compact('patient','progress_notes_upload','dental_verification_upload'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    }
	public function claimdentalform($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
             'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		 if ($this->request->is(['patch', 'post', 'put'])) {
			//$this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$_SESSION['claimdata']['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
				$dental_verification_upload=$_SESSION['claimdata']['dental_verification_upload'];
			}
			else{
				$_SESSION['claimdata']['dental_verification_upload']=$claim->dental_verification_upload;
				$dental_verification_upload=$_SESSION['claimdata']['dental_verification_upload'];
			}
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$_SESSION['claimdata']['progress_notes_upload']= str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);
				$progress_notes_upload=$_SESSION['claimdata']['progress_notes_upload'];	
			}
			else{
				$_SESSION['claimdata']['progress_notes_upload']=$claim->progress_notes_upload;
				$progress_notes_upload=$_SESSION['claimdata']['progress_notes_upload'];
			}
			$_SESSION['claimdata']['claim_number']=$claim->claim_number;
			return $this->redirect(array('controller'=>'claim','action' => 'claimsuperbill',$id));
        }
        $this->set(compact('patient','claim'));
        $this->set('_serialize', ['patient']);
    }
	
	 public function ajaxviewpatient($id = null)
    {	
			$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['CptCodes', 'Icd10Codes']
        ]);
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			 $this->request->data['RP']['patient_id']=$claim->patient_id;
		$this->request->data['PI']['patient_id']=$claim->patient_id;
		$this->request->data['PPP']['patient_id']=$claim->patient_id;
		$this->request->data['PP']['patient_id']=$claim->patient_id;
		$dob=date("Y-m-d",strtotime($this->request->data['dob']));
		
		
		$this->request->data['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		if($this->request->data['RP']['dob']==''){
			$this->request->data['RP']['dob']="0000-00-00";
		}
		else{
			$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		}
		if(!isset($this->request->data['PI']['is_migtant_worker'])){$this->request->data['PI']['is_migtant_worker']=0;}
		if(!isset($this->request->data['PI']['is_dependent_of_a_migrant_worker'])){$this->request->data['PI']['is_dependent_of_a_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_seasonal_migrant_worker'])){$this->request->data['PI']['is_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker'])){$this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['non_agricultural_worker'])){$this->request->data['PI']['non_agricultural_worker']=0;}
		if(!isset($this->request->data['PI']['refused_unreported'])){$this->request->data['PI']['refused_unreported']=0;}
		//print_r($this->request->data); exit;
			//document upload start here
			// photo id
			
			/*if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			else{
				$this->request->data['img_photo_id_upload'] =$this->request->data['h_img_photo_id_upload'];	
			}
			// Denti-Cal
			
			if (move_uploaded_file($this->request->data['dental_verification_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['dental_verification_upload']['name']))){
				$this->request->data['dental_verification_upload'] = str_replace(" ","_",$this->request->data['dental_verification_upload']['name']);	
			}
			else{
				$this->request->data['dental_verification_upload'] =$this->request->data['h_dental_verification_upload'];	
			}
			// Progress-notes
			
			if (move_uploaded_file($this->request->data['progress_notes_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['progress_notes_upload']['name']))){
				$this->request->data['progress_notes_upload'] = str_replace(" ","_",$this->request->data['progress_notes_upload']['name']);	
			}
			else{
				$this->request->data['progress_notes_upload'] =$this->request->data['h_progress_notes_upload'];	
			}
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			else{
				$this->request->data['img_medicare_card'] =$this->request->data['h_img_medicare_card'];	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			else{
				$this->request->data['consent_form_upload'] =$this->request->data['h_consent_form_upload'];	
			}
			//registration
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}*/
			// document upload code end here
			//save PR information
			
		//	if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
			// document upload code end here
			//save PR information
			$RP = $this->Patient->PatientResponsibleParty;
			$prdata = $RP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($prdata->id>0){
				$RP->patchEntity($prdata,$this->request->data['RP']);
				$RP->save($prdata);
			}
			else{
				$savepr = $RP->newEntity();
				$RP->patchEntity($savepr,$this->request->data['RP']);
				$RP->save($savepr);
				
			}
			//API - additional information
			$PI = $this->Patient->PatientInfo;
			$pidata = $PI->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($pidata->id>0){
				$PI->patchEntity($pidata,$this->request->data['PI']);
				$PI->save($pidata);
			}
			else{
				$savepi = $PI->newEntity();
				$PI->patchEntity($savepi,$this->request->data['PI']);
				$PI->save($savepi);
				
			}
			//PPP - information
			$PPP = $this->Patient->PatientPrimaryPhysician;
			$pppdata = $PPP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($pppdata->id>0){
				$PPP->patchEntity($pppdata,$this->request->data['PPP']);
				$PPP->save($pppdata);
			}
			else{
				$saveppp = $PPP->newEntity();
				$PPP->patchEntity($saveppp,$this->request->data['PPP']);
				$PPP->save($saveppp);
				
			}
			//PP - information
			$PP = $this->Patient->PatientPreferredPharmacy;
			$ppdata = $PP->find('all')->where(['patient_id' => $claim->patient_id])->first();
			if($ppdata->id>0){
				$PP->patchEntity($ppdata,$this->request->data['PP']);
				$PP->save($ppdata);
			}
			else{
				$savepp = $PP->newEntity();
				$PP->patchEntity($savepp,$this->request->data['PP']);
				$PP->save($savepp);
				
			}
			$patient = $this->Patient->patchEntity($patient, $this->request->data);
			if ($this->Patient->save($patient)) {
			//$conn = ConnectionManager::get('default');
			//echo 'update patient set `dob`="'.$dob.'" where id="'.$claim->patient_id.'"';exit;
			////$rs1 = $conn->execute('update '.TableRegistry::get('Patient')->table().' set `dob`="'.$dob.'" where id="'.$claim->patient_id.'"');
			//$rs1 = $conn->execute('update '.TableRegistry::get('PatientResponsibleParty')->table().' set `dob`="'.$rdob.'" where patient_id="'.$claim->patient_id.'"');
				/*$query = $this->Patient->query();
											$query->update()
												->set(['dob' =>$dob])
												->where(['id' =>$claim->patient_id])
												->execute();*/
				return $this->redirect(array('controller'=>'claim','action' => 'ajaxviewpatient',$id));
			}
			 else{
				  $this->Flash->error(__('The patient could not be saved. Please, try again.'));
			 }
			//return $this->redirect(array('controller'=>'claim','action' => 'dentalform',$id));
        }
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
		}
		if(!empty($patient->patient_primary_physician)){
			$PPP=$patient->patient_primary_physician[0];
		}
		if(!empty($patient->patient_preferred_pharmacy)){
			$PP=$patient->patient_preferred_pharmacy[0];
		}
		if(!empty($patient->patient_info)){
			$PI=$patient->patient_info[0];
		}
		if ($this->request->is(['patch', 'post', 'put'])) {}
		$claimStatus = $this->Claim->ClaimStatus->find('list');
		 $practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
		$this->set('practice_id',$practice_id);
        $this->set(compact('patient','claim','cptCodes','icd10Codes','claimStatus','RP','PPP','PP','PI','states'));
        $this->set('_serialize', ['patient']);
		//$this->viewBuilder()->layout('ajax');
		return;
	}
	
	public function ajaxPatientclaim($id=null,$claim_id='')
    {
		
		$options[]=array("Claim.patient_id"=>$id);
		if($claim_id!=''){
			$options[]=array("Claim.id NOT IN "=>array($claim_id));
		}
		$this->paginate = [
		
            'contain' => ['ClaimStatus','CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10,'order'=>['Claim.date_of_service'=>"ASC"]
        ];
		/*$query = $this->Claim->find('all','contain' => ['ClaimStatus','CptCodes', 'Icd10Codes', 'Notes', 'Review'],'order'=>['Claim.date_of_service'=>"ASC"],['limit' => 1])->where(['patient_id' =>$id]);*/
        $claim = $this->paginate($this->Claim);
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set(compact('claim'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
    }
	public function ajaxClaimsummary($id=null){
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);

        $this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxPractice()
    {
		$this->paginate = [
            'contain' => ['PracticeStatus'],['limit' => 10]
        ];
		$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>2]);
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
			$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>1]);
		}else{
			//$options = ['Practice.id'=>$loguser['practice_id']];
			$query = $this->loadModel('Practice')->find('all')->where(['practice_status_id' =>1])->andWhere($options);
		}
		$this->paginate = [
            'contain' => ['PracticeStatus'],['limit' => 10]
        ];
		
        $practice = $this->paginate($query);
		$this->set(compact('practice'));
        $this->set('_serialize', ['practice']);
		$this->viewBuilder()->layout('ajax');
		return;
    }
	public function reimbursementstatus()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$this->set('currentuserlog', $loguser);
    }
	public function claimappeals()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$this->set('currentuserlog', $loguser);
    }
	public function claimviewcues2()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1,2,3,4,7,8,9);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
			$query = $this->Claim->query();
			//*********/
			if($loguser['group_id']==8){
			$query->update()
				->set(['modify_by' =>0])
				->where(['modify_by' => $loguser['id']])
				->execute();
				}
			if($loguser['group_id']==9){
			$query->update()
				->set(['review_by' =>0])
				->where(['review_by' => $loguser['id']])
				->execute();
			}	
		//*******//
		 
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$this->set('practice', $practice);
		$this->set('dentistlist',array());
		$this->set('currentuserlog', $loguser);
    }
	public function claimviewcues()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$allow_group = array(1,2,3,4,7,8,9);
		 if(!in_array($loguser['group_id'],$allow_group)){
		 $this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller' => 'users','action' => 'access-denied']);
		 }
			$query = $this->Claim->query();
			//*********/
			if($loguser['group_id']==8){
			$query->update()
				->set(['modify_by' =>0])
				->where(['modify_by' => $loguser['id']])
				->execute();
				}
			if($loguser['group_id']==9){
			$query->update()
				->set(['review_by' =>0])
				->where(['review_by' => $loguser['id']])
				->execute();
			}	
		//*******//
		if($loguser['group_id']== 4 ){
			
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
			$practice=$practice1->toArray();
			$this->set('practice', $practice);
			$this->set('dentistlist',array());
			$this->set('currentuserlog', $loguser);
		
		}
		else
		{
			/*if($loguser['group_id']==1){*/
			 $options = ['Claim.claim_status_id  IN'=>array(1,3,5)];
			/*}else{
			  $options = ['Claim.modify_by' => $loguser['id'],'Claim.claim_status_id  IN'=>array(1,3,5)];
			 }*/ 
			
			if ($this->request->is(['patch', 'post', 'put'])) {
			
				if($this->request->data['claim_number']!=''){
					$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
				}
				if($this->request->data['ssn1']!=''){
					$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
				}
				if($this->request->data['first_name']!=''){
					$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
				}
				if($this->request->data['last_name']!=''){
					$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
				}
				if($this->request->data['dob']!=''){
					$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
				}
				if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
					$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
				}
				else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
					$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
				}
				else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
					$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
				}
			 }
			$this->paginate = [
				'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>500];
			$claim = $this->paginate($this->Claim);
			$claimlist=array();
			foreach($claim as $key=>$val){
				$claimlist[]=$val->id;
			}
			if(empty($claimlist)){$claimlist=array(-1);}
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
			$practice=$practice1->toArray();
			$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
			foreach($userslist as $key=>$val){
				$userslist[$val['id']]=$val['first_name'];
			}
			
			$dentistlist=array();
			if($this->request->data['practice']!=''){
			$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
				if(!empty($dentistlist1)){
					$dentistlist3=$dentistlist1->toArray();
	
					foreach($dentistlist3 as $key=>$val){
						$dentistlist[$val['id']]=$val['first_name'];
					}
				}
			}
			
			$dentistsel='';
			if($this->request->data['dentist']!=''){
				$dentistsel=$this->request->data['dentist'];
			}
			$this->set('dentistsel', $dentistsel);
			$this->set('dentistlist', $dentistlist);
			$this->set('userslist', $userslist);
			$this->set('practice', $practice);
			$this->set(compact('claim'));
			$this->set('_serialize', ['claim']);
			$this->set('currentuserlog', $loguser);
		}
		
    }
	public function payclaim($id = null)
    {
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['CptCodes', 'Icd10Codes']
        ]);
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
		$query = TableRegistry::get('ClaimPayment');
					$query->query()->update()
						->set(['check_number' => $this->request->data['check_number']])
						->set(['pay_date' => date("Y-m-d",strtotime($this->request->data['pay_date']))])
						->where(['claim_id' => $id])
						->execute();
		$this->Claim->query()->update()
						->set(['claim_status_id' => $this->request->data['claim_status_id']])
						->where(['id' => $id])
						->execute();
				$this->Flash->success(__('The claim has been updated.'));
                return $this->redirect(['action' => 'paidclaims']);		
		}
		$claimStatus = $this->Claim->ClaimStatus->find('list');
        $this->set(compact('patient','claim','cptCodes','icd10Codes','claimStatus'));
        $this->set('_serialize', ['patient']);
	}
	public function payappeal($id = null)
    {
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['CptCodes', 'Icd10Codes']
        ]);
		$patient = $this->loadModel('Patient')->get($claim->patient_id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
		$query = TableRegistry::get('ClaimAppeals');
					$query->query()->update()
						->set(['check_number' => $this->request->data['check_number']])
						->set(['appeal_status' => $this->request->data['appeal_status']])
						->set(['pay_date' => date("Y-m-d",strtotime($this->request->data['pay_date']))])
						->where(['claim_id' => $id])
						->execute();
		$this->Claim->query()->update()
						->set(['claim_status_id' =>4])
						->where(['id' => $id])
						->execute();
				$this->Flash->success(__('The claim Appeal has been updated.'));
                return $this->redirect(['action' => 'paidclaims']);		
		}
		$payment1 = TableRegistry::get('ClaimPayment')->find('all',array('fields'=>array('pay_amount')))->where(['claim_id'=>$id])->first();
		$ClaimAppealquery = TableRegistry::get('ClaimAppeals');
		$appealdata =   $ClaimAppealquery->find('all')->where(['claim_id'=>$id])->first();

        $this->set(compact('patient','claim','appealdata','payment1'));
        $this->set('_serialize', ['patient']);
	}
	public function batchpay()
	{
		$options=array();
		$options1='';
		$conn = ConnectionManager::get('default');
		/*if($this->request->data['claim_status_id']!=''){
			$options[]=array("Claim.claim_status_id"=>$this->request->data['claim_status_id']);
		}
		else{*/
			$options[]=array("Claim.claim_status_id"=>8);
		//}
		if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
			$options1=" AND (cp.created >= '".date("Y-m-d 00:00:00",strtotime($this->request->data['date_from']))."' AND cp.created <='".date("Y-m-d 23:59:00",strtotime($this->request->data['date_to']))."') ";
		}
		else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
			$options1="AND cp.created <= '".date("Y-m-d 23:59:00",strtotime($this->request->data['date_to']))."' ";
		}
		else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
			$options1="AND cp.created >= '".date("Y-m-d 00:00:00",strtotime($this->request->data['date_from']))."' ";
		}
		if($options1){
		$rs1 = $conn->execute('SELECT cp.claim_id FROM claim_payment cp inner join claim c on cp.claim_id=c.id where c.claim_status_id=8 '.$options1);
		$rows =$rs1->fetchAll('assoc');
		$claimarr=array();
			foreach($rows as $key1=>$val1){
				$claimarr[]=$val1['claim_id'];
			}
			if(!empty($claimarr)){
				$options[]=array("Claim.id IN "=>$claimarr);
			}else{
				$claimarr=array(-1);
				$options[]=array("Claim.id IN "=>$claimarr);
			}
		}
		if($this->request->data['practice']!=''){
			$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
		}
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		if($this->request->data['dentist']!=''){
	 		$userslist2 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id')))->where(['group_id'=>5,"Users.id"=>$this->request->data['dentist']]);
			if(empty($userslist2)){
				$userslist2=array(-1);
			}
			$options[]=array("Claim.user_id IN "=>$userslist2);
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>500];
        $claim = $this->paginate($this->Claim);
        		if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')),['limit'=>200]);
		}
		$practice=$practice1->toArray();
		
		$claimStatus = $this->Claim->ClaimStatus->find('list')->where(['ClaimStatus.id IN '=>array(4,6,10)]);
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}
		$claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$payment1 = TableRegistry::get('ClaimPayment')->find('all',array('fields'=>array('claim_id','pay_amount','created')))->where(['claim_id IN '=>$claimlist])->toArray();
		$payment=array();
		$ppdate=array();
		foreach($payment1 as $key=>$val){
			$payment[$val->claim_id]=$val->pay_amount;
			$ppdate[$val->claim_id]=$val->created;
			
		}
		$this->set('payment', $payment);
		$this->set('ppdate', $ppdate);
		$this->set('dentistsel', $dentistsel);
		$this->set('userslist', $userslist);
		$this->set('dentistlist', $dentistlist);
		$this->set('practice', $practice);
		$this->set('claim', $claim);
		$this->set('claimStatus', $claimStatus);
        $this->set('_serialize', ['claim']);
	}
	public function ajaxClaimpending(){
	$loguser = $this->request->session()->read('Auth.User');
	if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id  IN'=>array(5,8)];
		}else{
	 	  $options = ['Claim.user_id' => $loguser['id'],'Claim.claim_status_id  IN'=>array(5,8)];
		 }
		 if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
			$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
		}
		else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
			$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
		}
		else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
			$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
		}
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit' => 10];
        $claim = $this->paginate($this->Claim);
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		
		$this->set('userslist', $userslist);
        $this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxClaimpaid(){
		$loguser = $this->request->session()->read('Auth.User');
		if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id'=>4];
		}else{
	 	  $options = ['Claim.user_id' => $loguser['id'],'Claim.claim_status_id'=>4];
		 }
		 
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
		$claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$payment = TableRegistry::get('ClaimPayment')->find('list',array('fields'=>array('claim_id','pay_amount')))->where(['claim_id IN '=>$claimlist])->toArray();
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','loguser'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxClaimpendingreview(){
		$loguser = $this->request->session()->read('Auth.User');
		/*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id IN '=>array(2,3)];
		}else{
			 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id IN '=>array(2,3)];
		}*/
		 $options = ['Claim.user_id' => $loguser['id'],'Claim.claim_status_id IN '=>array(2,3)];
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
		
		/*if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
        $this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxClaimforcorrection(){
		$loguser = $this->request->session()->read('Auth.User');
	 	 /*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id'=>1];
		}else{
		 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id'=>1];
		}*/
		$options = ['Claim.user_id' => $loguser['id'],'Claim.claim_status_id'=>1];
		if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        /*if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		
		$this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxDeniedclaim(){
		$loguser = $this->request->session()->read('Auth.User');
		/*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id'=>5];
		}else{
			 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id'=>5];
		}*/
		 $options = ['Claim.user_id' => $loguser['id'],'Claim.claim_status_id'=>6];
	 	 if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
       /*if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	
	public function ajaxPendingreview(){
		$loguser = $this->request->session()->read('Auth.User');
		/*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id IN '=>array(2,3)];
		}else{
			 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id IN '=>array(2,3)];
		}*/
		$options = ['Claim.claim_status_id IN '=>array(2,3)];
		if($loguser['group_id']==2){
			//$options[] = ['Claim.modify_by'=>$loguser['id']];
		}
		
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$options[]=array("Claim.user_id "=>$this->request->data['dentist']);
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
		
		/*if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('cloguser', $loguser);
		$this->set('practice', $practice);
        $this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxCorrectionreview(){
		$loguser = $this->request->session()->read('Auth.User');
	 	 /*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id'=>1];
		}else{
		 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id'=>1];
		}*/
		$options[]= ['Claim.claim_status_id'=>1];
		
		if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$options[]=array("Claim.user_id "=>$this->request->data['dentist']);
			}
		 }
	if($loguser['group_id']==2){
			//$options[] = ['Claim.modify_by '=>$loguser['id']];
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        /*if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('cloguser', $loguser);
		$this->set('practice', $practice);
		$this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxReviewerapproved(){
		$loguser = $this->request->session()->read('Auth.User');
		/*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id'=>5];
		}else{
			 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id'=>5];
		}*/
		$options = ['Claim.claim_status_id'=>5];
		if($loguser['group_id']==4){
			//$options[] = ['Claim.review_by'=>$loguser['id']];
		}
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$options[]=array("Claim.user_id "=>$this->request->data['dentist']);
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
       /*if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		}
		else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function claimtobepaid(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id'=>8];
	 	 
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>500];
        $claim = $this->paginate($this->Claim);
       $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$payment = TableRegistry::get('ClaimPayment')->find('list',array('fields'=>array('claim_id','pay_amount')))->where(['claim_id IN '=>$claimlist])->toArray();
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','payment'));
        $this->set('_serialize', ['claim']);
	
	}
	
	public function exportclaim(){
	  $this->layout = false;
	  $this->autoRender = false;
		$options=array();
			$options[]=array("Claim.claim_status_id"=>8);
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>5000];
        $claim = $this->paginate($this->Claim);
        
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')),['limit'=>200]);
		$practice=$practice1->toArray();
		
		$claimStatus = $this->Claim->ClaimStatus->find('list');
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		
		$claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$rows=array();
		$rows[]=array("Patient Name","Dr. Office Name","Doctor","Date of Service","Ref Number","Amount","PP Date","Status");
		$payment1 = TableRegistry::get('ClaimPayment')->find('all',array('fields'=>array('claim_id','pay_amount','created')))->where(['claim_id IN '=>$claimlist])->toArray();
		$payment=array();
		$ppdate=array();
		foreach($payment1 as $key=>$val){
			$payment[$val->claim_id]=$val->pay_amount;
			$ppdate[$val->claim_id]=$val->created;
			
		}
		foreach ($claim as $claim){
			if($payment[$claim->id]==''){$payment[$claim->id]=0;}
			$usernm="";
			if($claim->user_id>1){ $usernm=$userslist[$claim->user_id];}
			$rows[]=array($claim['patient']->first_name." ".$claim['patient']->last_name,$practice[$claim['patient']->practice_id],$usernm,date("m/d/Y",strtotime($claim->date_of_service)),$claim->claim_number,$payment[$claim->id],str_replace("-","/",$ppdate[$claim->id]),$claim->claim_status->name);
		}
	   CommonHelper::array_to_csv_download($rows, 'claims'.time().'.csv', $delimiter=",");
	}
	public function paidclaims(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id'=>4];
		
	 	if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
			$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
		}
		else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
			$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
		}
		else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
			$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
		}
		
		if($this->request->data['practice']!=''){
			$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
		}
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		if($this->request->data['dentist']!=''){
	 		$userslist2 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id')))->where(['group_id'=>5,"Users.id"=>$this->request->data['dentist']]);
			if(empty($userslist2)){
				$userslist2=array(-1);
			}
			$options[]=array("Claim.user_id IN "=>$userslist2);
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>500];
        $claim = $this->paginate($this->Claim);
        $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$payment = TableRegistry::get('ClaimPayment')->find('list',array('fields'=>array('claim_id','pay_amount')))->where(['claim_id IN '=>$claimlist])->toArray();
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}

		$this->set('dentistsel', $dentistsel);
		$this->set('dentistlist', $dentistlist);
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','payment'));
        $this->set('_serialize', ['claim']);
	
	}
	public function allclaimreview(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id IN '=>array(3)];
		
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['reviewer_ids']!=''){
				$options[]=array("Claim.modify_by "=>$this->request->data['reviewer_ids']);
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>500];
        $claim = $this->paginate($this->Claim);
        $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$reviewers=array();
		$reviewers1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>2])->toArray();
		foreach($reviewers1 as $key=>$val){
			$reviewers[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}
		$reviewersel='';
		if($this->request->data['reviewer_ids']!=''){
			$reviewersel=$this->request->data['reviewer_ids'];
		}

		$this->set('dentistsel', $dentistsel);
		$this->set('dentistlist', $dentistlist);
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','reviewers','reviewersel'));
        $this->set('_serialize', ['claim']);
	
	}
	public function allclaimbillreview(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id IN '=>array(5)];
		
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$options[]=array("Claim.user_id "=>$this->request->data['dentist']);
			}
			if($this->request->data['biller_ids']!=''){
				$options[]=array("Claim.review_by "=>$this->request->data['biller_ids']);
			}
		 }
		 
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>500];
        $claim = $this->paginate($this->Claim);
        $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$payment = TableRegistry::get('ClaimPayment')->find('list',array('fields'=>array('claim_id','pay_amount')))->where(['claim_id IN '=>$claimlist])->toArray();
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$billers=array();
		$billers1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>4])->toArray();
		foreach($billers1 as $key=>$val){
			$billers[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}
		$billersel='';
		if($this->request->data['biller_ids']!=''){
			$billersel=$this->request->data['biller_ids'];
		}

		$this->set('dentistsel', $dentistsel);
		$this->set('dentistlist', $dentistlist);
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','payment','billers','billersel'));
        $this->set('_serialize', ['claim']);
	
	}
	public function ajaxApprovedclaim(){
		$loguser = $this->request->session()->read('Auth.User');
		/*if($loguser['group_id']==1){
			 $options = ['Claim.claim_status_id'=>5];
		}else{
			 $options = ['Patient.practice_id' => $loguser['practice_id'],'Claim.claim_status_id'=>5];
		}*/
		$options = ['Claim.claim_status_id'=>5];
		if($loguser['group_id']==2){
			//$options[] = ['Claim.modify_by'=>$loguser['id']];
		}
	 	 if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$options[]=array("Claim.user_id "=>$this->request->data['dentist']);
			}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        		//if($loguser['group_id']==1){
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		//}
		/*else{
			$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')))->where(['Practice.id'=>$loguser['practice_id']]);
		}*/
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$this->set('userslist', $userslist);
		$this->set('cloguser', $loguser);
		$this->set('practice', $practice);
		$this->set('claim', $claim);
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxListcptcode($id=null)
    {
		$cptCodes1 = $this->Claim->CptCodes->find('all',array('fields'=>array('group'=>'CptCodes.group')))->where(['CptCodes.id'=>$id])->toArray();
		$cptCodes = $this->Claim->CptCodes->find('all')->where(['CptCodes.group'=>$cptCodes1[0]['group']]);
		
		$this->set(compact('cptCodes'));
        $this->set('_serialize', ['cptCodes']);
		$this->viewBuilder()->layout('ajax');
		return;
    }
	public function ajaxAssignreviewer()
    {
		$claims=explode(",",$_POST['claim_id']);
		foreach($claims as $key=>$val){
				$this->Claim->query()->update()
						->set(['modify_by' => $_POST['reviewer_id']])
						->where(['id' =>$val])
						->execute();
		}						
		$this->set('msg',"Claim updtaed successully");
		$this->viewBuilder()->layout('ajax');						
		exit;
    }
	public function ajaxAssignbiller()
    {
		$claims=explode(",",$_POST['claim_id']);
		foreach($claims as $key=>$val){
				$this->Claim->query()->update()
						->set(['review_by' => $_POST['biller_id']])
						->where(['id' =>$val])
						->execute();
		}						
		$this->set('msg',"Claim updtaed successully");
		$this->viewBuilder()->layout('ajax');						
		exit;
    }
	public function ajaxPayclaim()
    {
		$query = TableRegistry::get('ClaimPayment');
		$claims=explode(",",$_POST['claim_id']);
		foreach($claims as $key=>$val){
					$query->query()->update()
						->set(['check_number' => $_POST['check_number']])
						->set(['pay_date' => date("Y-m-d",strtotime($_POST['pay_date']))])
						->where(['claim_id' =>$val])
						->execute();
		$this->Claim->query()->update()
						->set(['claim_status_id' => $_POST['claim_status_id']])
						->where(['id' =>$val])
						->execute();
		}						
		$this->set('msg',"Claim updated successully");
								
		exit;
    }
	public function ajaxClaimappeal()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$id=$_POST['claim_id'];
		$ClaimAppealquery = TableRegistry::get('ClaimAppeals');
				
				$ClaimAppealload =   $ClaimAppealquery->find('all')->where(['claim_id'=>$id])->first();
				
			  $payamount = 0;
			  if($this->request->data['payment_amount']>0)
			  {
				  $payamount = $this->request->data['payment_amount'];
			  }
			if($payamount>0) {
				 
					 $ClaimAppealarr=array("claim_id"=>$id,"pay_amount"=>$payamount,'reason_notes' =>$this->request->data['reason_note'],'created_by'=>$loguser['id'],'appeal_status'=>'Pending');
						$RRP = $ClaimAppealquery;
						$saveRRP = $RRP->newEntity();
						$ddP=$RRP->patchEntity($saveRRP,$ClaimAppealarr);
						if($RRP->save($saveRRP)){		
						$this->Claim->query()->update()
						->set(['claim_status_id' => 9])
						->where(['id' =>$id])
						->execute();
							$this->set('msg',"Claim Appeal updated successully");
						}
						else{
							$this->set('msg',"Claim Appeal not saved");
						}
			}
			else{
				$this->set('msg',"Claim Appeal not saved");
			}						
		
								
		exit;
    }
	public function ajaxListicdcode($id=null)
    {
		$cptCodes1 = $this->Claim->Icd10Codes->find('all',array('fields'=>array('group'=>'Icd10Codes.group')))->where(['Icd10Codes.id'=>$id])->toArray();
		$icd10Codes = $this->Claim->Icd10Codes->find('all')->where(['Icd10Codes.group'=>$cptCodes1[0]['group']]);
		$this->set(compact('icd10Codes'));
        $this->set('_serialize', ['icd10Codes']);
		$this->viewBuilder()->layout('ajax');
		return;
    }
	public function ajaxGetdentist($id=null)
    {
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$id])->toArray();
		$strs='';
		$strs.="<option value=''>Select</option>";
		foreach($userslist as $key=>$val){
			$strs.="<option value='".$val['id']."'>".$val['first_name']."</option>";
		}
		echo $strs;
		//$this->set('userslist', $userslist);
		//$this->viewBuilder()->layout('ajax');
		exit;
    }
	public function ajaxAllcorrectionreview(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id IN '=>array(1)];
		
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['reviewer_ids']!=''){
				$options[]=array("Claim.modify_by "=>$this->request->data['reviewer_ids']);
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$userslist2 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id')))->where(['group_id'=>5,"Users.id"=>$this->request->data['dentist']]);
				if(empty($userslist2)){
					$userslist2=array(-1);
				}
				$options[]=array("Claim.user_id IN "=>$userslist2);
		 	}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>15];
        $claim = $this->paginate($this->Claim);
        $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$reviewers=array();
		$reviewers1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>2])->toArray();
		foreach($reviewers1 as $key=>$val){
			$reviewers[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}
		$reviewersel='';
		if($this->request->data['reviewer_ids']!=''){
			$reviewersel=$this->request->data['reviewer_ids'];
		}

		$this->set('dentistsel', $dentistsel);
		$this->set('dentistlist', $dentistlist);
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','reviewers','reviewersel'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxAllpendingreview(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id IN '=>array(2,3)];
		
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['reviewer_ids']!=''){
				$options[]=array("Claim.modify_by "=>$this->request->data['reviewer_ids']);
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$userslist2 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id')))->where(['group_id'=>5,"Users.id"=>$this->request->data['dentist']]);
				if(empty($userslist2)){
					$userslist2=array(-1);
				}
				$options[]=array("Claim.user_id IN "=>$userslist2);
		 	}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>15];
        $claim = $this->paginate($this->Claim);
        $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$reviewers=array();
		$reviewers1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>2])->toArray();
		foreach($reviewers1 as $key=>$val){
			$reviewers[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}
		$reviewersel='';
		if($this->request->data['reviewer_ids']!=''){
			$reviewersel=$this->request->data['reviewer_ids'];
		}

		$this->set('dentistsel', $dentistsel);
		$this->set('dentistlist', $dentistlist);
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','reviewers','reviewersel'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxAllapprovedclaim(){
		$loguser = $this->request->session()->read('Auth.User');
		
		$options = ['Claim.claim_status_id IN '=>array(5)];
		
	 	if ($this->request->is(['patch', 'post', 'put'])) {
		
			if($this->request->data['claim_number']!=''){
				$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
			}
			if($this->request->data['ssn1']!=''){
				$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
			}
			if($this->request->data['first_name']!=''){
				$options[]=array("Patient.first_name LIKE "=>'%'.trim($this->request->data['first_name']).'%');
			}
			if($this->request->data['last_name']!=''){
				$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
			}
			if($this->request->data['reviewer_ids']!=''){
				$options[]=array("Claim.modify_by "=>$this->request->data['reviewer_ids']);
			}
			if($this->request->data['dob']!=''){
				$options[]=array("Patient.dob "=>date("Y-m-d",strtotime($this->request->data['dob'])));
			}
			if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
			}
			else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
			}
			if($this->request->data['practice']!=''){
				$options[]=array("Patient.practice_id"=>$this->request->data['practice']);
			}
			if($this->request->data['dentist']!=''){
				$userslist2 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id')))->where(['group_id'=>5,"Users.id"=>$this->request->data['dentist']]);
				if(empty($userslist2)){
					$userslist2=array(-1);
				}
				$options[]=array("Claim.user_id IN "=>$userslist2);
		 	}
		 }
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>15];
        $claim = $this->paginate($this->Claim);
        $claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$practice1 = TableRegistry::get('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier')));
		$practice=$practice1->toArray();
		$userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		$reviewers=array();
		$reviewers1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>2])->toArray();
		foreach($reviewers1 as $key=>$val){
			$reviewers[$val['id']]=$val['first_name'];
		}
		$dentistlist=array();
		if($this->request->data['practice']!=''){
		$dentistlist1 = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5,'practice_id'=>$this->request->data['practice']]);
			if(!empty($dentistlist1)){
				$dentistlist3=$dentistlist1->toArray();

				foreach($dentistlist3 as $key=>$val){
					$dentistlist[$val['id']]=$val['first_name'];
				}
			}
		}
		
		$dentistsel='';
		if($this->request->data['dentist']!=''){
			$dentistsel=$this->request->data['dentist'];
		}
		$reviewersel='';
		if($this->request->data['reviewer_ids']!=''){
			$reviewersel=$this->request->data['reviewer_ids'];
		}

		$this->set('dentistsel', $dentistsel);
		$this->set('dentistlist', $dentistlist);
		$this->set('userslist', $userslist);
		$this->set('practice', $practice);
		$this->set(compact('claim','reviewers','reviewersel'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxClaimappeallist(){
		$loguser = $this->request->session()->read('Auth.User');
		if($loguser['group_id']!=5){
			 $options = ['Claim.claim_status_id'=>9];
		}else{
	 	  $options = ['Claim.user_id' => $loguser['id'],'Claim.claim_status_id'=>9];
		 }
		 
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
		$claimlist=array();
		foreach($claim as $key=>$val){
			$claimlist[]=$val->id;
		}
		if(empty($claimlist)){$claimlist=array(-1);}
		$payment = TableRegistry::get('ClaimAppeals')->find('list',array('fields'=>array('claim_id','pay_amount')))->where(['claim_id IN '=>$claimlist])->toArray();
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxApprovedappeallist(){
		$loguser = $this->request->session()->read('Auth.User');

		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		if($loguser['group_id']==6){$apstatus="Pending Payment";}
		else{$apstatus="Appeal Approved";}
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>$apstatus]);
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		if($loguser['group_id']==6){
		}else{
		$options[] = ['Claim.user_id' => $loguser['id']];
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	
	}
	public function ajaxAllappealclaimlist(){
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
			 $options[] = ['Claim.claim_status_id'=>9];
		
		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Pending']);
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
		
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxAllappealclaimbilllist(){
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		
		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Appeal Approved']);
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxAllappealclaimpaidlist(){
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		
		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Pending Payment']);
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxAllappealpaidlist(){
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		
		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Appeal Paid']);
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxDentistappealpaidlist(){
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		
		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		if($loguser['group_id']!=5){
			$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Appeal Paid']);
		}
		else{
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Appeal Paid'])->andWhere(['created_by'=>$loguser['id']]);
		}
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxDeniedappeals(){
		$loguser = $this->request->session()->read('Auth.User');
		$options=array();
		
		$payment=array();
		$claimlist=array();
		$claimlist['ids']=array();
		$claimlist['status']=array();
		$claimlist['created']=array();
		$claimlist['pay_amount']=array();
		if($loguser['group_id']!=5){
			$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Appeal Denied']);
		}
		else{
		$payment1 = TableRegistry::get('ClaimAppeals')->find('all')->where(['appeal_status'=>'Appeal Denied'])->andWhere(['created_by'=>$loguser['id']]);
		}
		 if(!empty($payment1)){
		 	$payment=$payment1->toArray();
			foreach($payment as $pkey=>$pval){
				$claimlist['ids'][]=$pval->claim_id;
				$claimlist['status'][$pval->claim_id]=$pval->appeal_status;
				$claimlist['created'][$pval->claim_id]=$pval->created;
				$claimlist['pay_amount'][$pval->claim_id]=$pval->pay_amount;
			}
			if(empty($claimlist['ids'])){$claimlist['ids'][]=-1;}
			$options[]=array("Claim.id IN "=>$claimlist['ids']);
		 }
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['claim_number']!=''){
			$options[]=array("Claim.claim_number LIKE "=>'%'.trim($this->request->data['claim_number']).'%');
		}
		$this->paginate = [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'conditions' => $options,'limit'=>10];
        $claim = $this->paginate($this->Claim);
        $userslist = TableRegistry::get('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
		foreach($userslist as $key=>$val){
			$userslist[$val['id']]=$val['first_name'];
		}
		//$this->set('userslist', $userslist);
		$this->set(compact('claim','payment','userslist','claimlist'));
        $this->set('_serialize', ['claim']);
		$this->viewBuilder()->layout('ajax');
		return;
	}
	public function ajaxUnassignclaim($id=null)
    {
		
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		
				$query = $this->Claim->query();
				$query->update()
					->set(['modify_by' => 0])
					->where(['id' => $id])
					->execute();
		$this->viewBuilder()->layout('ajax');
		return;
    }
	public function ajaxUnassignbillclaim($id=null)
    {
		
		$loguser = $this->request->session()->read('Auth.User');
		$claim = $this->Claim->get($id, [
            'contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review']
        ]);
		
				$query = $this->Claim->query();
				$query->update()
					->set(['review_by' => 0])
					->where(['id' => $id])
					->execute();
		$this->viewBuilder()->layout('ajax');
		return;
    }
	
}?>