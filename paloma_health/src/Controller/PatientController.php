<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\View\Helper\CommonHelper;
/**
 * Patient Controller
 *
 * @property \App\Model\Table\PatientTable $Patient
 */
class PatientController extends AppController
{

    public $helpers = ['Common'];
	public $paginate = [
        'limit' =>10
    ];
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,5))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		 $paginate = array('limit' => 10);
 
	$passArg = array('date_from'=>'','date_to'=>'','last_name'=>'','ssn1'=>'');
	$conditions = array();
	$conditions1 = array();
	$conditions2 = array();
	
	$options=array();
	if($this->request->query['clear']==1){
		$this->Cookie->write('srcPassArg',array());
	}
	if($this->request->data['filter']==1){
		$passArg = $this->request->data;
	}
	else{
		$this->request->data=$this->Cookie->read('srcPassArg');
	}
	if($this->request->data['date_from']!='' && $this->request->data['date_to']!=''){
			$options[]=array("Patient.dob >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])),"Patient.dob <="=>date("Y-m-d",strtotime($this->request->data['date_to'])));
		}
		else if($this->request->data['date_from']=='' && $this->request->data['date_to']!=''){ 
			$options[]=array("Patient.dob <= "=>date("Y-m-d",strtotime($this->request->data['date_to'])));
		}
		else if($this->request->data['date_from']!='' && $this->request->data['date_to']==''){
			$options[]=array("Patient.dob >= "=>date("Y-m-d",strtotime($this->request->data['date_from'])));
		}
		
		if($this->request->data['last_name']!=''){
			$options[]=array("Patient.last_name LIKE "=>'%'.trim($this->request->data['last_name']).'%');
		}
		if($this->request->data['ssn1']!=''){
			$options[]=array("Patient.ssn LIKE "=>'%'.trim($this->request->data['ssn1']).'%');
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
			if($loguser['group_id']!=1){
				$options[]=array('Patient.practice_id'=>$loguser['practice_id']);
			}
			$conditions=$options;
			if (!empty($conditions)){$paginate['conditions'] = $conditions;
			}
			//print_r($this->data);
			$this->paginate = $paginate;
			$this->set('passArg',$passArg);
			if (!empty($passArg)){$this->Cookie->write('srcPassArg',$passArg);}
		/*$this->paginate = [
            'contain' => ['Practice']
        ];*/
        $patient = $this->paginate($this->Patient);
		if($this->Cookie->read('srcPassArg')!=''){
			$this->set('passArg',$this->Cookie->read('srcPassArg'));
		}
        $this->set(compact('patient','loguser'));
        $this->set('_serialize', ['patient']);
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       $loguser = $this->request->session()->read('Auth.User');
	    $patient = $this->Patient->get($id, [
            'contain' => ['Practice', 'Claim', 'PatientInfo', 'PatientPreferredPharmacy', 'PatientPrimaryPhysician', 'PatientResponsibleParty']
        ]);
		$RP='';
		$PPP='';
		$PP='';
		$PI='';
		if(!empty($patient->patient_responsible_party)){
			$RP=$patient->patient_responsible_party[0];
			
			if(strlen($RP['dob'])==6){
			$newdate1=explode("/",$RP['dob']);
			$RP['dob']=$newdate1[0]."/".$newdate1[1]."/19".$newdate1[2];
		}
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
        $practice = $this->Patient->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		$patientId=CommonHelper::uniqueNumber(99);
        $practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
		$this->set('practice_id',$practice_id);
		$this->set(compact('patient', 'practice','RP','PPP','PP','PI','states','patientId'));
       // $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
	   $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,5))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
	    $patient = $this->Patient->newEntity();
        if ($this->request->is('post')) {
		if(!isset($this->request->data['PI']['is_migtant_worker'])){$this->request->data['PI']['is_migtant_worker']=0;}
		if(!isset($this->request->data['PI']['is_dependent_of_a_migrant_worker'])){$this->request->data['PI']['is_dependent_of_a_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_seasonal_migrant_worker'])){$this->request->data['PI']['is_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker'])){$this->request->data['PI']['is_depemdent_of_a_seasonal_migrant_worker']=0;}
		if(!isset($this->request->data['PI']['non_agricultural_worker'])){$this->request->data['PI']['non_agricultural_worker']=0;}
		if(!isset($this->request->data['PI']['refused_unreported'])){$this->request->data['PI']['refused_unreported']=0;}
		$this->request->data['dob']=date("Y-m-d",strtotime($this->request->data['dob']));
		//$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		if($this->request->data['RP']['dob']==''){
			$this->request->data['RP']['dob']="0000-00-00";
		}
		else{
			$this->request->data['RP']['dob']=date("Y-m-d",strtotime($this->request->data['RP']['dob']));
		}
		//document upload start here
			// photo id
			
			if (move_uploaded_file($this->request->data['img_photo_id_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']))){
				$this->request->data['img_photo_id_upload'] = str_replace(" ","_",$this->request->data['img_photo_id_upload']['name']);	
			}
			//Medicare Card
			if (move_uploaded_file($this->request->data['img_medicare_card']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['img_medicare_card']['name']))){
				$this->request->data['img_medicare_card'] = str_replace(" ","_",$this->request->data['img_medicare_card']['name']);	
			}
			//Consnt form
			if (move_uploaded_file($this->request->data['consent_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['consent_form_upload']['name']))){
				$this->request->data['consent_form_upload'] =str_replace(" ","_",$this->request->data['consent_form_upload']['name']);	
			}
			// document upload code end here
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			
			// document upload code end here
			//save PR information
			
			if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
			
		$this->request->data['email_active']=1;
            $patient = $this->Patient->patchEntity($patient, $this->request->data);
            $sdata=$this->Patient->save($patient);
			$this->request->data['RP']['patient_id']=$sdata->id;
		$this->request->data['PI']['patient_id']=$sdata->id;
		$this->request->data['PPP']['patient_id']=$sdata->id;
		$this->request->data['PP']['patient_id']=$sdata->id;
		//save PR information
			$RP = $this->Patient->PatientResponsibleParty;

				$savepr = $RP->newEntity();
				$RP->patchEntity($savepr,$this->request->data['RP']);
				$RP->save($savepr);
			
			//API - additional information
			$PI = $this->Patient->PatientInfo;

				$savepi = $PI->newEntity();
				$PI->patchEntity($savepi,$this->request->data['PI']);
				$PI->save($savepi);
				
			//PPP - information
			$PPP = $this->Patient->PatientPrimaryPhysician;
			
				$saveppp = $PPP->newEntity();
				$PPP->patchEntity($saveppp,$this->request->data['PPP']);
				$PPP->save($saveppp);
			
			//PP - information
			$PP = $this->Patient->PatientPreferredPharmacy;
			
				$savepp = $PP->newEntity();
				$PP->patchEntity($savepp,$this->request->data['PP']);
				$PP->save($savepp);
			
			if ($sdata) {
                $this->Flash->success(__('The patient has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The patient could not be saved. Please, try again.'));
            }
        }
		if($loguser['group_id']==1){
        	$practice = $this->Patient->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		}
		else{
			$practice = $this->Patient->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200])->where(['Practice.id'=>$loguser['practice_id']]);
		}
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
		$practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$patientId=CommonHelper::uniqueNumber(99);
		$this->set('practice_id',$practice_id);
        $this->set(compact('patient', 'practice','states','patientId'));
        $this->set('_serialize', ['patient']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,5))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$patient = $this->Patient->get($id, [
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
			if (move_uploaded_file($this->request->data['registration_form_upload']['tmp_name'],WWW_ROOT . 'uploads' . DS . str_replace(" ","_",$this->request->data['registration_form_upload']['name']))){
				$this->request->data['registration_form_upload'] =str_replace(" ","_",$this->request->data['registration_form_upload']['name']);	
			}
			else{
				$this->request->data['registration_form_upload'] =$this->request->data['h_registration_form_upload'];	
			}
			// document upload code end here
			//save PR information
			
			if(isset($this->request->data['sameadd'])){$this->request->data['sameadd']=1;}else{$this->request->data['sameadd']=0;}
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
			
                $this->Flash->success(__('The patient has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
			
                $this->Flash->error(__('The patient could not be saved. Please, try again.'));
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
        if($loguser['group_id']==1){
        	$practice = $this->Patient->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200]);
		}
		else{
			$practice = $this->Patient->Practice->find('list',array('fields'=>array('Practice.id','Practice.identifier')), ['limit' => 200])->where(['Practice.id'=>$loguser['practice_id']]);
		}
		$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.id','States.state_name')));
        $patientId=CommonHelper::uniqueNumber(99);
		$practice_id=0;
		if($loguser['group_id']!=1){
			$practice_id=$loguser['practice_id'];
		}
		$this->set('practice_id',$practice_id);
	    $this->set(compact('patient', 'practice','RP','PPP','PP','PI','states','patientId'));
        $this->set('_serialize', ['patient']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient id.
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
        $patient = $this->Patient->get($id);
		$claim = TableRegistry::get('Claim');
		$claimcptcode = TableRegistry::get('ClaimCptCodes');
		$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
		$notes = TableRegistry::get('Notes');
		$review = TableRegistry::get('Review');
		$payment = TableRegistry::get('ClaimPayment');
		$prdata1 = $claim->find('all')->where(['patient_id' => $id])->toArray();
		
		if(count($prdata1)>0){
				foreach($prdata1 as $ckey=>$val){
				$claim_id=$val['id'];
				$notes1 = $notes->find('all')->where(['claim_id' => $claim_id])->first();
				if($notes1->id>0){
					$notes->deleteAll(['Notes.claim_id IN ' => $claim_id]);
				}
				$payment1 = $payment->find('all')->where(['claim_id' => $claim_id])->first();
				if($payment1->id>0){
					$payment->deleteAll(['ClaimPayment.claim_id IN ' => $claim_id]);
				}
				
				$review1 = $review->find('all')->where(['claim_id' => $claim_id])->first();
				if($review1->id>0){
					$review->deleteAll(['Review.claim_id IN ' => $claim_id]);
				}
				
				$prdata = $claimcptcode->find('all')->where(['claim_id' => $claim_id])->first();
				if($prdata->id>0){
					$claimcptcode->deleteAll(['ClaimCptCodes.claim_id IN ' => $claim_id]);
				}
				$prdata = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->first();
				if($prdata->id>0){
					$claimicdcode->deleteAll(['ClaimIcd10Codes.claim_id IN ' => $claim_id]);
				}
			}
		}
        if ($this->Patient->delete($patient)) {
            $this->Flash->success(__('The patient has been deleted.'));
        } else {
            $this->Flash->error(__('The patient could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function exportlist()
    {
		$loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(8))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		 $paginate = array('limit' => 10);
 
	$passArg = array('date_fromx'=>'','date_tox'=>'');
	$conditions = array();
	$conditions1 = array();
	$conditions2 = array();
	
	$options=array();
	if($this->request->query['clear']==1){
		$this->Cookie->write('srcPassArg',array());
	}
	if($this->request->data['filterx']==1){
		$passArg = $this->request->data;
	}
	else{
		$this->request->data=$this->Cookie->read('srcPassArg');
	}
	if($this->request->data['date_fromx']!='' && $this->request->data['date_tox']!=''){
			$options[]=array("Patient.created >= "=>date("Y-m-d",strtotime($this->request->data['date_fromx'])),"Patient.created <="=>date("Y-m-d",strtotime($this->request->data['date_tox'])));
		}
		else if($this->request->data['date_fromx']=='' && $this->request->data['date_tox']!=''){ 
			$options[]=array("Patient.created <= "=>date("Y-m-d",strtotime($this->request->data['date_tox'])));
		}
		else if($this->request->data['date_fromx']!='' && $this->request->data['date_tox']==''){
			$options[]=array("Patient.created >= "=>date("Y-m-d",strtotime($this->request->data['date_fromx'])));
		}
		if (!empty($this->request->params['named']['page'])){
			$passArg['page'] = $this->request->params['named']['page'];
		}
		else{
			if (!empty($this->request->data['page'])){
				$this->request->params['named']['page'] = $this->request->data['page'];
				}
			}	
		if(empty($options)){
			$options[]=array("Patient.created >= "=>date("Y-m-d"));
		}	
			//$paginate = array('limit' => 2);
			/*if($loguser['group_id']!=1){
				$options[]=array('Patient.practice_id'=>$loguser['practice_id']);
			}*/
			$conditions=$options;
			if (!empty($conditions)){$paginate['conditions'] = $conditions;
			}
			//print_r($this->data);
			$this->paginate = $paginate;
			$this->set('passArg',$passArg);
			if (!empty($passArg)){$this->Cookie->write('srcPassArg',$passArg);}
		/*$this->paginate = [
            'contain' => ['Practice']
        ];*/
        $patients = $this->paginate($this->Patient);
		
		if($this->request->data['export']=='Export'){
			$rows=array();
			$rows[]=array("Name","Age","Gender","Phone","Email","SSN");
			foreach ($patients as $patient1){
			$age=CommonHelper::ageCalculator($patient1['dob']);
			$rows[]=array($patient1['first_name']." ".$patient1['last_name'],$age,$patient1['gender'],$patient1['home_phone'],$patient1['email'],$patient1['ssn']);
			}
	   		CommonHelper::array_to_csv_download($rows, 'patients'.time().'.csv', $delimiter=",");
			exit;
			
		}
		if($this->Cookie->read('srcPassArg')!=''){
			$this->set('passArg',$this->Cookie->read('srcPassArg'));
		}
        $this->set(compact('patients'));
        $this->set('_serialize', ['patients']);
    }
}
?>