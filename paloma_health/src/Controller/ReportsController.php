<?php
namespace App\Controller;
use App\Controller\AppController;
use App\View\Helper\CommonHelper;
use Cake\ORM\TableRegistry;
/**
 * Practice Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{
    public $helpers = ['Common'];
	public function index()
    {
		$loguser = $this->request->session()->read('Auth.User');
		$this->set('cloguser',$loguser);
    }
	public function production()
    {
		$loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(7))){
		 	 $this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		 
	$options=array();
	$options1=array();
	$options2=array();
	if ($this->request->is(['patch', 'post', 'put'])) {
			//date of service
			if($this->request->data['date_fromx']!='' && $this->request->data['date_tox']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_fromx'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_tox'])));
			}
			else if($this->request->data['date_fromx']=='' && $this->request->data['date_tox']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_tox'])));
			}
			else if($this->request->data['date_fromx']!='' && $this->request->data['date_tox']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_fromx'])));
			}
			//pending payment date
			if($this->request->data['date_fromp']!='' || $this->request->data['date_top']!=''){
				if($this->request->data['date_fromp']!='' && $this->request->data['date_top']!=''){
					$options1[]=array("created >= "=>date("Y-m-d",strtotime($this->request->data['date_fromp'])),"created <="=>date("Y-m-d",strtotime($this->request->data['date_top'])));
				}
				else if($this->request->data['date_fromp']=='' && $this->request->data['date_top']!=''){ 
					$options1[]=array("created <= "=>date("Y-m-d",strtotime($this->request->data['date_top'])));
				}
				else if($this->request->data['date_fromp']!='' && $this->request->data['date_top']==''){
					$options1[]=array("created >= "=>date("Y-m-d",strtotime($this->request->data['date_fromp'])));
				}
				$options1[]=array("option1"=>"Pending Payment");
			}	
			//reviewer approved date
			if($this->request->data['date_fromr']!='' || $this->request->data['date_tor']!=''){
				if($this->request->data['date_fromr']!='' && $this->request->data['date_tor']!=''){
					$options2[]=array("created >= "=>date("Y-m-d",strtotime($this->request->data['date_fromr'])),"created <="=>date("Y-m-d",strtotime($this->request->data['date_tor'])));
				}
				else if($this->request->data['date_fromr']=='' && $this->request->data['date_tor']!=''){ 
					$options2[]=array("created <= "=>date("Y-m-d",strtotime($this->request->data['date_tor'])));
				}
				else if($this->request->data['date_fromr']!='' && $this->request->data['date_tor']==''){
					$options2[]=array("created >= "=>date("Y-m-d",strtotime($this->request->data['date_fromr'])));
				}
				$options2[]=array("option1"=>"Reviewer approved");
			}	
			//pending
			$ppclaim=array();
			$ppclaimlist2=array();
			if(!empty($options1)){
				$ppclaim = $this->loadModel('Notes')->find('list',['fields'=>array("claim_id","option1"),'conditions'=>$options1]);
				$ppclaimlist=array();
				if($ppclaim->count()>0){
					
					foreach($ppclaim as $ppclaim1=>$val1){
						$ppclaimlist2[]=$val1->claim_id;
					}
					$ppclaimlist=array_unique($ppclaimlist2);
				}
			}
			//reviewer
			$ppclaim2=array();
			$ppclaimlist3=array();
			if(!empty($options2)){
				$ppclaim2 = $this->loadModel('Notes')->find('list',['fields'=>array("claim_id","option1"),'conditions'=>$options2]);
				
				if($ppclaim2->count()>0){
					$ppclaimlist2=array();
					foreach($ppclaim2 as $ppclaim1=>$val1){
						$ppclaimlist2[]=$val1->claim_id;
					}
					$ppclaimlist3=array_unique($ppclaimlist2);
				}
			}
			$filterclaim=array();
			$filterclaim=array_merge($ppclaimlist2,$ppclaimlist3);
			if(!empty($filterclaim)){
				if(empty($options)){
					$query = $this->loadModel('Claim')->find('all',['contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'fields'=>array("Claim.claim_status_id","Claim.id","Claim.user_id","Claim.date_of_service"),'conditions'=>$options])->andWhere(['Claim.id IN '=>$filterclaim]);
					//'group'=>['Claim.date_of_service']
				}
				else{
					$query = $this->loadModel('Claim')->find('all',['contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'fields'=>array("Claim.claim_status_id","Claim.id","Claim.user_id","Claim.date_of_service"),'conditions'=>$options])->orWhere(['Claim.id IN '=>$filterclaim]);
				}
				
			}
			else
			{
				$query = $this->loadModel('Claim')->find('all',['contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'fields'=>array("Claim.claim_status_id","Claim.id","Claim.user_id","Claim.date_of_service"),'conditions'=>$options]);
				//"cnt"=>"count(Claim.id)"),
			}	
			$claims = $this->paginate($query);
			$claimstatus = $this->loadModel('ClaimStatus')->find('list', ['limit' => 200])->toArray();

			$userslist = $this->loadModel('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)')))->where(['group_id'=>5])->toArray();
			foreach($userslist as $key=>$val){
				$userslist[$val['id']]=$val['first_name'];
			}
				$rows=array();
				$rows[]=array("Count","Date of Service","Last Name","First Name","DOB","Reviewed","Dentist");
				$i=1;
				foreach ($claims as $claim1){
					$reviewed='';
					if(!empty($ppclaimlist2)){
						$clist=$ppclaim->toArray();
						$reviewed=$clist[$claim1['id']];
					}
					if(!empty($ppclaimlist3)){
						$clist2=$ppclaim2->toArray();
						if($clist2[$claim1['id']]!=''){
							$reviewed=$clist2[$claim1['id']];
						}
					}
					$reviewed=$claimstatus[$claim1['claim_status_id']];
				$rows[]=array($i++,str_replace("-","/",date("m/d/Y",strtotime($claim1['date_of_service']))),'','','',$reviewed,$userslist[$claim1['user_id']]);
				}
				CommonHelper::array_to_csv_download($rows, 'claims'.time().'.csv', $delimiter=",");
				exit;
			
		}
    }
	public function productivity()
    {
		$loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(7))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		 
	$options=array();
	$options1=array();
	$options2=array();
	if ($this->request->is(['patch', 'post', 'put'])) {
			//date of service
			if($this->request->data['date_froms']!='' && $this->request->data['date_tos']!=''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_froms'])),"Claim.date_of_service <="=>date("Y-m-d",strtotime($this->request->data['date_tos'])));
			}
			else if($this->request->data['date_froms']=='' && $this->request->data['date_tos']!=''){ 
				$options[]=array("Claim.date_of_service <= "=>date("Y-m-d",strtotime($this->request->data['date_tos'])));
			}
			else if($this->request->data['date_froms']!='' && $this->request->data['date_tos']==''){
				$options[]=array("Claim.date_of_service >= "=>date("Y-m-d",strtotime($this->request->data['date_fromx'])));
			}
			
			$query = $this->loadModel('Claim')->find('all',['contain' => ['Patient', 'ClaimStatus', 'CptCodes', 'Icd10Codes', 'Notes', 'Review'],'fields'=>array("Claim.id","Claim.user_id","Claim.date_of_service","cnt"=>"count(Claim.id)","sdate"=>"DATE_FORMAT(Claim.date_of_service,'%m-%d')"),'conditions'=>$options,'group'=>['Claim.user_id','Claim.date_of_service']]);
			
			$claims = $this->paginate($query);
			$claimids=array();
			$dentistarr=array();
			$userpr=array();
			$prids=array();
			foreach($claims as $key){
				$claimids[]=$key->id;
				$dentistarr[]=$key->user_id;
			}
			$userslist = $this->loadModel('Users')->find('all',array('fields'=>array('Users.id','first_name'=>'CONCAT(Users.first_name," ",Users.last_name)','Users.practice_id')))->where(['group_id'=>5])->andWhere(['id IN '=>$dentistarr])->toArray();
			foreach($userslist as $key=>$val){
				$userslist[$val['id']]=$val['first_name'];
				$prids[]=$val['practice_id'];
				$userpr[$val['id']]=$val['practice_id'];
			}
			$practice1 = $this->loadModel('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier'),'conditions'=>array("Practice.id IN "=>$prids)),['limit' => 10000])->toArray();
			//print_r($practice1);
			foreach($userpr as $key3=>$val3){
				$userpr[$key3]=$practice1[$val3];
			}
			
			/*$practice1 = $this->loadModel('Practice')->find('list',array('fields'=>array('Practice.id','Practice.Identifier'),'conditions'=>array("Claim.date_of_service >= "=>)),['limit' => 2000])->toArray();*/
			
			/*$patients = $this->loadModel('Patient')->find('list',array('fields'=>array('Patient.id','Patient.practice_id'),'conditions'=>array("Patient.id IN "=>)),['limit' => 2000])->toArray();
			
			
			*/
			$fromdate=date("Y-m-d",strtotime($this->request->data['date_froms']));
			if($this->request->data['date_tos']==''){
				$todate=date("Y-m-d");
			}
			else{
				$todate=date("Y-m-d",strtotime($this->request->data['date_tos']));
			}
			
			$start=date_create($fromdate);
			$date2=date_create($todate);
			$diff=date_diff($start,$date2);
			$end=$diff->days+1;
			$header=array();
			$header1=array();
			$header[]="All Doctors";
			$header[]="Office Name";
			$header[]="Bill Provider Name";
			$datearray=array();
			foreach ($claims as $claim1){
				$datearray[]= $claim1['sdate'];
			 }
			 $datearray=array_unique($datearray);
			 
			 foreach($datearray as $dkey=>$vald) { 
				$header[]=$vald;
				$header1[]=$vald;
			 }
			/*for($i=(int)date("j",strtotime($fromdate))-1;$i<=$end;$i++){
				$newtime=strtotime($fromdate.' + '.$i.' days');
				$header[]=(string)date('n-j',$newtime);
				$header1[]=(string)date('m-d',$newtime);
			}*/
			//$date1=date_create(date("Y-m-d"));
			/*echo $this->request->data['date_froms'];
$date2=date_create(date("Y-m-d",strtotime($this->request->data['date_froms'])));
$diff=date_diff($date1,$date2);
echo $diff->days+1;*/

				$rows=array();
				$rows[]=$header;
				$i=1;
				foreach ($claims as $claim1){
				  $rows3=array();
				  $rows3[]=$i++;
				  $rows3[]=$userpr[$claim1['user_id']];
				  $rows3[]=$userslist[$claim1['user_id']];
				  foreach($header1 as $key=>$val){
				  	if($claim1['sdate']==$val){
						$rows3[]=$claim1['cnt'];
					}
					else{
						$rows3[]=" - ";
					}
					
				  }	
				$rows[]=$rows3;
				}
				CommonHelper::array_to_csv_download($rows, 'claims'.time().'.csv', $delimiter=",");
				exit;
			
		}
    }
}
?>