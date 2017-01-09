<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use App\View\Helper\CommonHelper;
require_once '../vendor/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Common\Helper\EncodingHelper;
set_time_limit(18000);
ini_set("memory_limit","512M");
/**
 * UploadDatas Controller
 *
 * @property \App\Model\Table\UploadDatasTable $UploadDatas
 */
class UploadDatasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $loguser = $this->request->session()->read('Auth.User');
		 if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$this->paginate = [
            'contain' => ['Users']
        ];
        $uploadDatas = $this->paginate($this->UploadDatas);

        $this->set(compact('uploadDatas'));
        $this->set('_serialize', ['uploadDatas']);
    }

    /**
     * View method
     *
     * @param string|null $id Upload Data id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$uploadData = $this->UploadDatas->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('uploadData', $uploadData);
        $this->set('_serialize', ['uploadData']);
    }
	public function process($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$uploadData = $this->UploadDatas->get($id, [
            'contain' => ['Users']
        ]);
		$filename = WWW_ROOT . 'uploads' . DS. $uploadData['file_name'];
		$filenamecsv = WWW_ROOT . 'uploads' . DS. str_replace(".xlsx",".csv",$uploadData['file_name']);
		try {
				
				if(!file_exists($filenamecsv)){
				$reader = ReaderFactory::create(Type::XLSX); // for XLSX files
				//$reader = ReaderFactory::create(Type::CSV); // for CSV files
				//$reader = ReaderFactory::create(Type::ODS); // for ODS files
				//$reader->setShouldFormatDates(true);
				$reader->open($filename);
				$writer = WriterFactory::create(Type::CSV);
				$writer->setFieldDelimiter(',');
				$writer->setFieldEnclosure('"');
				$writer->openToFile($filenamecsv);
				$i=0;
				$allrows=array();
				foreach ($reader->getSheetIterator() as $sheet) {
					foreach ($sheet->getRowIterator() as $row) {
					
					foreach($row as $key1=>$valk){
							if($valk instanceof \DateTime){
								$row[$key1]=date("Y-m-d",strtotime($valk->format('Y-m-d')));			
							}
							else{
								if($valk=='NULL'){
									$row[$key1]='';
								}
							}

					}
				
					//$allrows[]=$row;
					$writer->addRow($row);
					
					}
				}
				
				
				$writer->close();
				//print_r($allrows);
				$reader->close();
			}
				//$msg="Data Imported successfully.";

		} catch(Exception $e) {
			//die('Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage());
			// $msg='Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage();
		}
        $this->set('uploadData', $uploadData);
        $this->set('_serialize', ['uploadData']);
    }
	public function ajaxProcess($id)
    {
		/*$str = '1,2,3,4,5,"6,000",7,8,9';
					$pattern='/"(\d+),(\d+)"/';
					$replacement='${1}##$2';
					echo preg_replace($pattern, $replacement, $str );exit;*/
		//$id=$_REQUEST['id'];
		$start=$_GET['start'];
		if($start==''){$start=0;}
        $loguser = $this->request->session()->read('Auth.User');
		$uploadData = $this->UploadDatas->get($id, [
            'contain' => ['Users']
        ]);
		//$filename = WWW_ROOT . 'uploads' . DS. $uploadData['file_name'];
		$filename = WWW_ROOT . 'uploads' . DS. str_replace(".xlsx",".csv",$uploadData['file_name']);
		//$filename = WWW_ROOT . 'uploads' . DS. "Dinkha.csv";
try {
				
				//$fp=fopen($filename,"r");
				$results=array();
				$j=1;
				
				$i=0;
				$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.state_code','States.id')))->toArray();
				$ethicity=array('HISPANIC/LATINO'=>"Hispanic or Latino",'NOT HISPANIC/LATINO'=>"Not Hispanic or Latino",'UNREPORTED/REFUSED TO REPORT
'=>'Refused to Report/Unreported');

					$allrows=array();
					
$rows=file($filename);
//$start=14884;
					for($i=$start;$i<=count($rows);$i++){
					$str = $rows[$i];
					$pattern='/"(\d+),(\d+)"/';
					$replacement='${1}##$2';
					
					$rows[$i]=preg_replace($pattern, $replacement, $str );
					$rows[$i]=str_replace(".,",".##",$rows[$i]);
					$row=explode(",",$rows[$i]);
                    if(count($row)==57){
						
					}
					else if(count($row)==58){
						//echo $row[0]."<br>";
					}
					else if(count($row)==59){
						$row[8]=$row[8]." ".$row[9];
						
						$row[27]=$row[27]." ".$row[28];
						unset($row[9]);
						unset($row[28]);
						$rownew=array();
						foreach($row as $keyr=>$valr){
							$rownew[]=$valr;
						}
						$row=$rownew;
					}

					foreach($row as $key1=>$valk){
						if(!in_array($key1,array(5,24))){
							if($valk instanceof \DateTime){}
							else{
								if($valk=='NULL'){
									//$row[$key1]='';
								}
							}
						}
					}
						if($i>0){
						
							if((int)$row[47]>0){
								
							}
							else{
								$row[47]=$row[48];
								$row[8]=$row[8].$row[9];
							}
							
							$practice1 = TableRegistry::get('Practice')->find('all')->where(['Practice.mpi_number'=>$row[47]])->first();
							if(count($practice1)>0){
								$prinfo=$practice1;
								$prid=$prinfo->id;
								$userslist = TableRegistry::get('Users')->find('all')->where(['group_id'=>5])->andWhere(['practice_id'=>$prid])->first();				
								if(count($userslist)>0){
									$userinfo=$userslist;
									$PatientTbl = TableRegistry::get('Patient');
									//////////patient basic data /////
									//print_r($row[5]);
									if($row[32]==''){
										$medicare_number="";
									}
									else{
										//$medicare_number=preg_replace("/^(\d{3})(\d{2})(\d{4})(\d{4})$/", "$1-$2-$3-$4",$row[32]);
										$medicare_number=$row[32];
									}
									if($row[14]==''){$row[14]='example@example.com';}
									if($row[33]==''){$row[33]='example@example.com';}
									$ssnno=preg_replace("/^(\d{3})(\d{2})(\d{4})$/", "$1-$2-$3",$row[7]);
									//$ssnno="555-88-8888";
									$patientinfo = $PatientTbl->find('all')->where(['patient_id' =>$row[0]])->andWhere(['practice_id'=>$prid])->first();
									if(count($patientinfo)==0){
										$patientinfo = $PatientTbl->find('all')
										->where(['ssn' => $ssnno])
										->andWhere(['last_name'=>$row[2]])
										->andWhere(['first_name'=>$row[4]])
										->andWhere(['practice_id'=>$prid])->first();									
										
										if(count($patientinfo)>0){
										
											$query = $PatientTbl->query();
											$query->update()
												->set(['patient_id' =>$row[0]])
												->where(['id' =>$patientinfo->id])
												->execute();
										}
									}	
										if(count($patientinfo)==0){
											$patients['patient']['patient_id']=$row[0];
											$patients['patient']['practice_id']=$prid;
											$patients['patient']['first_name']=$row[4];
											$patients['patient']['middle_name']=$row[3];
											$patients['patient']['last_name']=$row[2];
											$patients['patient']['ssn']=$ssnno;
											$patients['patient']['medicare_number']=$medicare_number;
											
											
											
											if(!empty($row[5])){
												$dob1=date("Y-m-d",strtotime($row[5]));
											}
											else{
												$dob1="0000-00-00";
											}
											
											$patients['patient']['dob']=$dob1;
											$patients['patient']['gender']=(trim($row[6])=='M')?'Male':'Female';/// change
											$patients['patient']['address_1']=str_replace(".##",".,",$row[8]);
											$patients['patient']['address_2']='';
											$patients['patient']['po_box']=1;
											$patients['patient']['city']=$row[9];
											$patients['patient']['state']=$states[$row[10]];
											$patients['patient']['zip']=$row[11];
											$patients['patient']['home_phone']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[12])), 2);
											$patients['patient']['cell']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[13])), 2);
											$patients['patient']['text_messages_active']=0;//$row[15];
											$patients['patient']['email']=$row[14];
											$patients['patient']['email_active']=1;
											$patients['patient']['sameadd']=1;
											//$patients['patient']['created']=date("Y-m-d H:i:s");
											//$patients['patient']['modified']=date("Y-m-d H:i:s");
											
											$savepatient = $PatientTbl->newEntity();
											$pr=$PatientTbl->patchEntity($savepatient,$patients['patient']);
											//print_r($pr->errors());exit;
											
											$patientdata=$PatientTbl->save($savepatient);
											
											$patient_id=$patientdata->id;
									}
									else{
										$patient_id=$patientinfo->id;
										
											if(!empty($row[5])){
												$dob1=date("Y-m-d",strtotime($row[5]));
											}
											else{
												$dob1="0000-00-00";
											}
										$query = $PatientTbl->query();
										$query->update()
											->set(['dob' => $dob1])
											//->set(['patient_id' => $row[0]])
											->where(['id' => $patient_id])
											->execute();
									}
									if($patient_id>0){
									
									//////////////// patient information
											$patients['patientinfo']['patient_id']=$patient_id;
											$patients['patientinfo']['average_household_income']=$row[54];
											$patients['patientinfo']['pay_frequency']='Yearly';
											$patients['patientinfo']['number_of_household_members']=$row[53];
											$patients['patientinfo']['housing_status']=$row[17];
											$patients['patientinfo']['primary_language']=(!empty($row[18]))? ucwords(strtolower($row[18])):'English';
											$patients['patientinfo']['race']='Refused to Report/Unreported';
											$patients['patientinfo']['ethnicity']=(!empty(trim($row[16])))? $ethicity[trim($row[16])]:"Refused to Report/Unreported";
											$patients['patientinfo']['is_migtant_worker']=0;
											$patients['patientinfo']['is_dependent_of_a_migrant_worker']=0;
											$patients['patientinfo']['is_seasonal_migrant_worker']=0;
											$patients['patientinfo']['is_depemdent_of_a_seasonal_migrant_worker']=0;
											$patients['patientinfo']['non_agricultural_worker']=0;
											$patients['patientinfo']['refused_unreported']=0;
											$patients['patientinfo']['text_messages_active']=0;//$row[15];
											$patients['patientinfo']['email']=$row[14];
											$patients['patientinfo']['email_active']=1;
											//$patients['patientinfo']['created']=date("Y-m-d H:i:s");
											//$patients['patientinfo']['modified']=date("Y-m-d H:i:s");
											//API - additional information
											$PI = TableRegistry::get('PatientInfo');
											$piinfo = $PI->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($piinfo)==0){
												$savepi = $PI->newEntity();
												$pidata=$PI->patchEntity($savepi,$patients['patientinfo']);
												$PI->save($savepi);
												
											}
											
											///////////pharmacy///////////////////
											
											$patients['pharmacy']['patient_id']=$patient_id;;
											$patients['pharmacy']['phone']=$row[40];
											$patients['pharmacy']['fax']=$row[41];
											//$patients['pharmacy']['created']=date("Y-m-d H:i:s");
											//$patients['pharmacy']['modified']=date("Y-m-d H:i:s");
											
											//PP - information
											$PP = TableRegistry::get('PatientPreferredPharmacy');
											$ppinfo = $PP->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($ppinfo)==0){
												$savepp = $PP->newEntity();
												$phdata=$PP->patchEntity($savepp,$patients['pharmacy']);
												//print_r($phdata->errors());exit;
												$PP->save($savepp);
											}
											////////////////////res party ////////
											
											$patients['resparty']['patient_id']=$patient_id;
											$patients['resparty']['first_name']=$row[19];
											$patients['resparty']['middle_name']=$row[20];
											$patients['resparty']['last_name']=$row[21];
											
											
											if(!empty($row[24])){
												$dob=date("Y-m-d",strtotime($row[24]));
											}
											else{
												$dob="0000-00-00";
											}
											$patients['resparty']['dob']=$dob;
											$patients['resparty']['gender']=(trim($row[22])=='M')?'Male':'Female';/// change
											$patients['resparty']['address_1']=$row[26];
											$patients['resparty']['address_2']='';
											$patients['resparty']['relationship']=ucwords(strtolower($row[25]));
											$patients['resparty']['city']=$row[27];
											$patients['resparty']['state']=$states[$row[28]];
											$patients['resparty']['zip']=$row[29];
											$patients['resparty']['home_phone']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[30])), 2);
											$patients['resparty']['cell']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[31])), 2);;
											$patients['resparty']['email']=$row[33];
											//$patients['resparty']['created']=date("Y-m-d H:i:s");
											//$patients['resparty']['modified']=date("Y-m-d H:i:s");
											//save PR information
											$RP = TableRegistry::get('PatientResponsibleParty');
											$rpinfo = $RP->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($rpinfo)==0){
												$savepr = $RP->newEntity();
												$rpdata=$RP->patchEntity($savepr,$patients['resparty']);
												
												$RP->save($savepr);
											}
											else{
												
												if(!empty($row[5])){
													$dob1=date("Y-m-d",strtotime($row[5]));
												}
												else{
													$dob1="0000-00-00";
												}
											$query = $RP->query();
											$query->update()
												->set(['dob' => $dob1])
												->where(['patient_id' => $patient_id])
												->execute();
											}
											
											////////////////////Physic ////////
											
											$patients['physician']['patient_id']=$patient_id;
											$patients['physician']['first_name']=$row[44];
											$patients['physician']['middle_name']=$row[45];
											$patients['physician']['last_name']=$row[46];
											$patients['physician']['address_1']=$row[26];
											$patients['physician']['address_2']='';
											$patients['physician']['city']='';
											$patients['physician']['state']=$states[$row[10]];
											$patients['physician']['zip']='';
											$patients['physician']['phone']='';
											$patients['physician']['fax']='';
											//$patients['physician']['created']=date("Y-m-d H:i:s");
											//$patients['physician']['modified']=date("Y-m-d H:i:s");
											
										//PPP - information
										$PPP = TableRegistry::get('PatientPrimaryPhysician');
										$phyinfo = $PPP->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($phyinfo)==0){
											$saveppp = $PPP->newEntity();
											$pppdata=$PPP->patchEntity($saveppp,$patients['physician']);
											//print_r($pppdata->errors());exit;
											$PPP->save($saveppp);
										}
										
									
									$claimdata=array();
									
									if(!empty($row[56])){
												$date_of_service=date("Y-m-d",strtotime($row[56]));
											}
											else{
												$date_of_service="0000-00-00";
											}
									if(!empty($row[42])){
												$created=date("Y-m-d",strtotime($row[42]));
											}
											else{
												$created="0000-00-00";
											}					
									$claimdata['patient_id']=$patient_id;
									$claimdata['claim_status_id']=11;
									$claimdata['claim_number']=trim($row[43]);
									$claimdata['dental_verification_upload']='';
									$claimdata['progress_notes_upload']='';
									$claimdata['date_of_service'] =$date_of_service;
									$claimdata['user_id']= $userinfo->id;
									$claimdata['created']= $created;

									$claims = TableRegistry::get('Claim');
									$claiminfo = $claims->find('all')->where(['claim_number' => trim($row[43])])->first();
									if(count($claiminfo)==0){
									$saveclaim = $claims->newEntity();
									$cldata=$claims->patchEntity($saveclaim,$claimdata);
									//print_r($cldata->errors());exit;
									$claiminfodata=$claims->save($cldata);
											$claim_id=$claiminfodata->id;
									}
									else
									{
										
										if($claiminfo->patient_id!=$patient_id && $claiminfo->patient_id>0)
										{
											$claim_id=$claiminfo->id;
											$claimcptcode = TableRegistry::get('ClaimCptCodes');
											$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
											
											$prdata = $claimcptcode->find('all')->where(['claim_id' => $claim_id])->first();
											if($prdata->id>0){
												$claimcptcode->deleteAll(['ClaimCptCodes.claim_id IN ' => $claim_id]);
											}
											$prdata = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->first();
											if($prdata->id>0){
												$claimicdcode->deleteAll(['ClaimIcd10Codes.claim_id IN ' => $claim_id]);
											}
											$claims->deleteAll(['Claim.id IN ' => $claim_id]);
											$claim_id='';
											
										}
											
									}
									if($claim_id>0){
										$claimcptcode = TableRegistry::get('ClaimCptCodes');
										$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
										
										$cptcodeTbl = TableRegistry::get('CptCodes');
										$icdcodeTbl = TableRegistry::get('Icd10Codes');
										
										$cptCodes = $cptcodeTbl->find('all',array('fields'=>array('id')))->where(['code'=>$row[48]])->first();
										
										$icd10Codes1 = $icdcodeTbl->find('all',array('fields'=>array('id')))->where(['code '=>$row[49]])->first();
										$icd10Codes2 = $icdcodeTbl->find('all',array('fields'=>array('id')))->where(['code '=>$row[50]])->first();
										$icd10Codes3 = $icdcodeTbl->find('all',array('fields'=>array('id')))->where(['code '=>$row[51]])->first();
									
										
										
										$cptarr=array();
										
											$tooth_number='';
											$surface='';
											$surface2='';
											$surface3='';
											$surface4='';
											$upper_or_lower='';
											$quadrent_1_code='';
											$arch_code='';
											$quadrent_or_arch_code='';
											$quadrent_2_code='';
											if(count($cptCodes)>0){
												$cptarr=array("claim_id"=>$claim_id,"cpt_code_id"=>$cptCodes->id,"upper_or_lower"=>$upper_or_lower,"tooth_number"=>$tooth_number,"surface"=>$surface,"surface2"=>$surface2,"surface3"=>$surface3,"surface4"=>$surface4,"quadrent_1_code"=>$quadrent_1_code,"quadrent_2_code"=>$quadrent_2_code,"arch_code"=>$arch_code);
												
												$prdata = $claimcptcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['cpt_code_id'=>$cptCodes->id])->first();
												if(count($prdata)==0){
													$savepp = $claimcptcode->newEntity();
													$dd=$claimcptcode->patchEntity($savepp,$cptarr);
													$fff=$claimcptcode->save($savepp);
												}
											}
											$icd_id="";
											if(count($icd10Codes1)>0){
												$prdata1 = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['icd10_code_id'=>$icd10Codes1->id])->first();
												$cptarr=array("claim_id"=>$claim_id,"icd10_code_id"=>$icd10Codes1->id);
												if(count($prdata1)==0){
													$savepp = $claimicdcode->newEntity();
													$dd=$claimicdcode->patchEntity($savepp,$cptarr);
													$claimicdcode->save($savepp);
												}
											}
											if(count($icd10Codes2)>0){
												$prdata1 = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['icd10_code_id'=>$icd10Codes2->id])->first();
												$cptarr=array("claim_id"=>$claim_id,"icd10_code_id"=>$icd10Codes1->id);
												if(count($prdata1)==0){
													$savepp = $claimicdcode->newEntity();
													$dd=$claimicdcode->patchEntity($savepp,$cptarr);
													$claimicdcode->save($savepp);
												}
											}
											if(count($icd10Codes3)>0){
												$prdata1 = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['icd10_code_id'=>$icd10Codes3->id])->first();
												$cptarr=array("claim_id"=>$claim_id,"icd10_code_id"=>$icd10Codes1->id);
												if(count($prdata1)==0){
													$savepp = $claimicdcode->newEntity();
													$dd=$claimicdcode->patchEntity($savepp,$cptarr);
													$claimicdcode->save($savepp);
												}
											}
										}	
									}	
								}
							}
						
						 
						}
						else{
					
						}
						if($j==500){
							$results['status']="OK";
							$results['start']=$i+1;
							
							echo json_encode($results);
							exit;
							}
							else{
								$j++;
							}
						//$i++;
						
						
					}
					
					$msg="Data Imported successfully.";

		} catch(Exception $e) {
			//die('Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage());
			 $msg='Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage();
		}
		$results['status']="DONE";
$results['start']=0;
$results['data']=$msg;
echo json_encode($results);
exit;

    }
	public function ajaxProcess2()
    {
		$id=$_REQUEST['id'];
        $loguser = $this->request->session()->read('Auth.User');
		$uploadData = $this->UploadDatas->get($id, [
            'contain' => ['Users']
        ]);
		$filename = WWW_ROOT . 'uploads' . DS. $uploadData['file_name'];
try {
				$reader = ReaderFactory::create(Type::XLSX); // for XLSX files
				//$reader = ReaderFactory::create(Type::CSV); // for CSV files
				//$reader = ReaderFactory::create(Type::ODS); // for ODS files
				
				$reader->open($filename);
				$i=0;
				$states = TableRegistry::get('States')->find('list',array('fields'=>array('States.state_code','States.id')))->toArray();
				$ethicity=array('HISPANIC/LATINO'=>"Hispanic or Latino",'NOT HISPANIC/LATINO'=>"Not Hispanic or Latino",'UNREPORTED/REFUSED TO REPORT
'=>'Refused to Report/Unreported');
			
				foreach ($reader->getSheetIterator() as $sheet) {
					foreach ($sheet->getRowIterator() as $row) {
					
					foreach($row as $key1=>$valk){
						if(!in_array($key1,array(5,24))){
							if($valk instanceof \DateTime){}
							else{
								if($valk=='NULL'){
									$row[$key1]='';
								}
							}
						}
					}
						if($i>0){
						
							//$row[47]="11121";
							//$practice1=array();

							$practice1 = TableRegistry::get('Practice')->find('all')->where(['Practice.mpi_number'=>$row[47]])->first();
							if(count($practice1)>0){
								$prinfo=$practice1;
								$prid=$prinfo->id;
								$userslist = TableRegistry::get('Users')->find('all')->where(['group_id'=>5])->andWhere(['practice_id'=>$prid])->first();				
								if(count($userslist)>0){
									$userinfo=$userslist;
									$PatientTbl = TableRegistry::get('Patient');
									//////////patient basic data /////
									//print_r($row[5]);
									if($row[32]==''){
										$medicare_number="";
									}
									else{
										$medicare_number=preg_replace("/^(\d{3})(\d{2})(\d{4})(\d{4})$/", "$1-$2-$3-$4",$row[32]);
									}
									if($row[14]==''){$row[14]='example@example.com';}
									if($row[33]==''){$row[33]='example@example.com';}
									$ssnno=preg_replace("/^(\d{3})(\d{2})(\d{4})$/", "$1-$2-$3",$row[7]);
									//$ssnno="555-88-8888";
									$patientinfo = $PatientTbl->find('all')->where(['ssn' => $ssnno])->andWhere(['practice_id'=>$prid])->first();
										if(count($patientinfo)==0){
											$patients['patient']['practice_id']=$prid;
											$patients['patient']['first_name']=$row[4];
											$patients['patient']['middle_name']=$row[3];
											$patients['patient']['last_name']=$row[2];
											$patients['patient']['ssn']=$ssnno;
											$patients['patient']['medicare_number']=$medicare_number;
											if($row[5] instanceof \DateTime){
												$dob1=date("Y-m-d",strtotime($row[5]->format('d-m-Y')));
											}
											else{
												$dob1="0000-00-00";
											}
											
											$patients['patient']['dob']=$dob1;
											$patients['patient']['gender']=(trim($row[6])=='M')?'Male':'Female';/// change
											$patients['patient']['address_1']=str_replace(".##",".,",$row[8]);
											$patients['patient']['address_2']='';
											$patients['patient']['po_box']=1;
											$patients['patient']['city']=$row[9];
											$patients['patient']['state']=$states[$row[10]];
											$patients['patient']['zip']=$row[11];
											$patients['patient']['home_phone']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[12])), 2);
											$patients['patient']['cell']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[13])), 2);
											$patients['patient']['text_messages_active']=0;//$row[15];
											$patients['patient']['email']=$row[14];
											$patients['patient']['email_active']=1;
											$patients['patient']['sameadd']=1;
											//$patients['patient']['created']=date("Y-m-d H:i:s");
											//$patients['patient']['modified']=date("Y-m-d H:i:s");
											
											$savepatient = $PatientTbl->newEntity();
											$pr=$PatientTbl->patchEntity($savepatient,$patients['patient']);
											//print_r($pr->errors());exit;
											
											$patientdata=$PatientTbl->save($savepatient);
											
											$patient_id=$patientdata->id;
									}
									else{
										$patient_id=$patientinfo->id;
										if($row[5] instanceof \DateTime){
												$dob1=date("Y-m-d",strtotime($row[5]->format('d-m-Y')));
											}
											else{
												$dob1="0000-00-00";
											}
										$query = $PatientTbl->query();
										$query->update()
											->set(['dob' => $dob1])
											->where(['id' => $patient_id])
											->execute();
									}
									if($patient_id>0){
									
									//////////////// patient information
											$patients['patientinfo']['patient_id']=$patient_id;
											$patients['patientinfo']['average_household_income']=$row[54];
											$patients['patientinfo']['pay_frequency']='Yearly';
											$patients['patientinfo']['number_of_household_members']=$row[53];
											$patients['patientinfo']['housing_status']=$row[17];
											$patients['patientinfo']['primary_language']=(!empty($row[18]))? ucwords(strtolower($row[18])):'English';
											$patients['patientinfo']['race']='Refused to Report/Unreported';
											$patients['patientinfo']['ethnicity']=(!empty(trim($row[16])))? $ethicity[trim($row[16])]:"Refused to Report/Unreported";
											$patients['patientinfo']['is_migtant_worker']=0;
											$patients['patientinfo']['is_dependent_of_a_migrant_worker']=0;
											$patients['patientinfo']['is_seasonal_migrant_worker']=0;
											$patients['patientinfo']['is_depemdent_of_a_seasonal_migrant_worker']=0;
											$patients['patientinfo']['non_agricultural_worker']=0;
											$patients['patientinfo']['refused_unreported']=0;
											$patients['patientinfo']['text_messages_active']=0;//$row[15];
											$patients['patientinfo']['email']=$row[14];
											$patients['patientinfo']['email_active']=1;
											//$patients['patientinfo']['created']=date("Y-m-d H:i:s");
											//$patients['patientinfo']['modified']=date("Y-m-d H:i:s");
											//API - additional information
											$PI = TableRegistry::get('PatientInfo');
											$piinfo = $PI->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($piinfo)==0){
												$savepi = $PI->newEntity();
												$pidata=$PI->patchEntity($savepi,$patients['patientinfo']);
												$PI->save($savepi);
												/*print_r($pidata->errors());
												exit;*/
											}
											
											///////////pharmacy///////////////////
											
											$patients['pharmacy']['patient_id']=$patient_id;;
											$patients['pharmacy']['phone']=$row[40];
											$patients['pharmacy']['fax']=$row[41];
											//$patients['pharmacy']['created']=date("Y-m-d H:i:s");
											//$patients['pharmacy']['modified']=date("Y-m-d H:i:s");
											
											//PP - information
											$PP = TableRegistry::get('PatientPreferredPharmacy');
											$ppinfo = $PP->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($ppinfo)==0){
												$savepp = $PP->newEntity();
												$phdata=$PP->patchEntity($savepp,$patients['pharmacy']);
												//print_r($phdata->errors());exit;
												$PP->save($savepp);
											}
											////////////////////res party ////////
											
											$patients['resparty']['patient_id']=$patient_id;
											$patients['resparty']['first_name']=$row[19];
											$patients['resparty']['middle_name']=$row[20];
											$patients['resparty']['last_name']=$row[21];
											
											if($row[24] instanceof \DateTime){
												$dob=date("Y-m-d",strtotime($row[24]->format('d-m-Y')));
											}
											else{
												$dob="0000-00-00";
											}
											$patients['resparty']['dob']=$dob;
											$patients['resparty']['gender']=(trim($row[22])=='M')?'Male':'Female';/// change
											$patients['resparty']['address_1']=$row[26];
											$patients['resparty']['address_2']='';
											$patients['resparty']['relationship']=ucwords(strtolower($row[25]));
											$patients['resparty']['city']=$row[27];
											$patients['resparty']['state']=$states[$row[28]];
											$patients['resparty']['zip']=$row[29];
											$patients['resparty']['home_phone']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[30])), 2);
											$patients['resparty']['cell']=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($row[31])), 2);;
											$patients['resparty']['email']=$row[33];
											//$patients['resparty']['created']=date("Y-m-d H:i:s");
											//$patients['resparty']['modified']=date("Y-m-d H:i:s");
											//save PR information
											$RP = TableRegistry::get('PatientResponsibleParty');
											$rpinfo = $RP->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($rpinfo)==0){
												$savepr = $RP->newEntity();
												$rpdata=$RP->patchEntity($savepr,$patients['resparty']);
												
												$RP->save($savepr);
											}
											else{
												if($row[24] instanceof \DateTime){
													$dob1=date("Y-m-d",strtotime($row[24]->format('d-m-Y')));
												}
												else{
													$dob1="0000-00-00";
												}
											$query = $RP->query();
											$query->update()
												->set(['dob' => $dob1])
												->where(['patient_id' => $patient_id])
												->execute();
											}
											
											////////////////////Physic ////////
											
											$patients['physician']['patient_id']=$patient_id;
											$patients['physician']['first_name']=$row[44];
											$patients['physician']['middle_name']=$row[45];
											$patients['physician']['last_name']=$row[46];
											$patients['physician']['address_1']=$row[26];
											$patients['physician']['address_2']='';
											$patients['physician']['city']='';
											$patients['physician']['state']=$states[$row[10]];
											$patients['physician']['zip']='';
											$patients['physician']['phone']='';
											$patients['physician']['fax']='';
											//$patients['physician']['created']=date("Y-m-d H:i:s");
											//$patients['physician']['modified']=date("Y-m-d H:i:s");
											
										//PPP - information
										$PPP = TableRegistry::get('PatientPrimaryPhysician');
										$phyinfo = $PPP->find('all')->where(['patient_id' =>$patient_id])->first();
											if(count($phyinfo)==0){
											$saveppp = $PPP->newEntity();
											$pppdata=$PPP->patchEntity($saveppp,$patients['physician']);
											//print_r($pppdata->errors());exit;
											$PPP->save($saveppp);
										}
										
									
									$claimdata=array();
									if($row[56] instanceof \DateTime){
													$date_of_service=date("Y-m-d",strtotime($row[56]->format('Y-m-d')));
												}
												else{
													$date_of_service="0000-00-00";
												}
									$claimdata['patient_id']=$patient_id;
									$claimdata['claim_status_id']=11;
									$claimdata['claim_number']=trim($row[43]);
									$claimdata['dental_verification_upload']='';
									$claimdata['progress_notes_upload']='';
									$claimdata['date_of_service'] =$date_of_service;
									$claimdata['user_id']= $userinfo->id;

									$claims = TableRegistry::get('Claim');
									$claiminfo = $claims->find('all')->where(['claim_number' => trim($row[43])])->first();
									if(count($claiminfo)==0){
									$saveclaim = $claims->newEntity();
									$cldata=$claims->patchEntity($saveclaim,$claimdata);
									//print_r($cldata->errors());exit;
									$claiminfodata=$claims->save($cldata);
											$claim_id=$claiminfodata->id;
									}
									else
									{
										$claim_id=$claiminfo->id;
									}
									$claimcptcode = TableRegistry::get('ClaimCptCodes');
									$claimicdcode = TableRegistry::get('ClaimIcd10Codes');
									
									$cptcodeTbl = TableRegistry::get('CptCodes');
									$icdcodeTbl = TableRegistry::get('Icd10Codes');
									
									$cptCodes = $cptcodeTbl->find('all',array('fields'=>array('id')))->where(['code'=>$row[48]])->first();
									
									$icd10Codes1 = $icdcodeTbl->find('all',array('fields'=>array('id')))->where(['code '=>$row[49]])->first();
									$icd10Codes2 = $icdcodeTbl->find('all',array('fields'=>array('id')))->where(['code '=>$row[50]])->first();
									$icd10Codes3 = $icdcodeTbl->find('all',array('fields'=>array('id')))->where(['code '=>$row[51]])->first();
								
									
									
									$cptarr=array();
									
										$tooth_number='';
										$surface='';
										$surface2='';
										$surface3='';
										$surface4='';
										$upper_or_lower='';
										$quadrent_1_code='';
										$arch_code='';
										$quadrent_or_arch_code='';
										$quadrent_2_code='';
										if(count($cptCodes)>0){
											$cptarr=array("claim_id"=>$claim_id,"cpt_code_id"=>$cptCodes->id,"upper_or_lower"=>$upper_or_lower,"tooth_number"=>$tooth_number,"surface"=>$surface,"surface2"=>$surface2,"surface3"=>$surface3,"surface4"=>$surface4,"quadrent_1_code"=>$quadrent_1_code,"quadrent_2_code"=>$quadrent_2_code,"arch_code"=>$arch_code);
											
											$prdata = $claimcptcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['cpt_code_id'=>$cptCodes->id])->first();
											if(count($prdata)==0){
												$savepp = $claimcptcode->newEntity();
												$dd=$claimcptcode->patchEntity($savepp,$cptarr);
												$fff=$claimcptcode->save($savepp);
											}
										}
										$icd_id="";
										if(count($icd10Codes1)>0){
											$prdata1 = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['icd10_code_id'=>$icd10Codes1->id])->first();
											$cptarr=array("claim_id"=>$claim_id,"icd10_code_id"=>$icd10Codes1->id);
											if(count($prdata1)==0){
												$savepp = $claimicdcode->newEntity();
												$dd=$claimicdcode->patchEntity($savepp,$cptarr);
												$claimicdcode->save($savepp);
											}
										}
										if(count($icd10Codes2)>0){
											$prdata1 = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['icd10_code_id'=>$icd10Codes2->id])->first();
											$cptarr=array("claim_id"=>$claim_id,"icd10_code_id"=>$icd10Codes1->id);
											if(count($prdata1)==0){
												$savepp = $claimicdcode->newEntity();
												$dd=$claimicdcode->patchEntity($savepp,$cptarr);
												$claimicdcode->save($savepp);
											}
										}
										if(count($icd10Codes3)>0){
											$prdata1 = $claimicdcode->find('all')->where(['claim_id' => $claim_id])->andWhere(['icd10_code_id'=>$icd10Codes3->id])->first();
											$cptarr=array("claim_id"=>$claim_id,"icd10_code_id"=>$icd10Codes1->id);
											if(count($prdata1)==0){
												$savepp = $claimicdcode->newEntity();
												$dd=$claimicdcode->patchEntity($savepp,$cptarr);
												$claimicdcode->save($savepp);
											}
										}
									}	
								}
							}
						
						 
						}
						else{
							//print_r($row);
						}
						$i++;
						
						
					}
				}
				
				$reader->close();
				$msg="Data Imported successfully.";

		} catch(Exception $e) {
			//die('Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage());
			 $msg='Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage();
		}
        $this->set('msg', $msg);
		//$this->viewBuilder()->layout('ajax');
		return;
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loguser = $this->request->session()->read('Auth.User');
		if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$uploadData = $this->UploadDatas->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['user_id'] =$loguser['id'];
			$times=time();
			if (move_uploaded_file($this->request->data['file_name']['tmp_name'],WWW_ROOT . 'uploads' . DS . $times.str_replace(" ","_",$this->request->data['file_name']['name']))){
				$this->request->data['file_name'] = $times.str_replace(" ","_",$this->request->data['file_name']['name']);	
			}
			else{
				$this->request->data['file_name'] ='';	
			}
			
            $uploadData = $this->UploadDatas->patchEntity($uploadData, $this->request->data);
			$updata=$this->UploadDatas->save($uploadData);
            if ($updata) {
                $this->Flash->success(__('The upload data has been saved.'));
				 return $this->redirect(array('action' => 'process',$updata->id));
               // return $this->redirect(['action' => 'index']);
            } else {
			//print_r($uploadData->errors());
                $this->Flash->error(__('The upload data could not be saved. Please, try again.'));
            }
        }
        $users = $this->UploadDatas->Users->find('list', ['limit' => 200]);
        $this->set(compact('uploadData', 'users'));
        $this->set('_serialize', ['uploadData']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Upload Data id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$uploadData = $this->UploadDatas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $uploadData = $this->UploadDatas->patchEntity($uploadData, $this->request->data);
            if ($this->UploadDatas->save($uploadData)) {
                $this->Flash->success(__('The upload data has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The upload data could not be saved. Please, try again.'));
            }
        }
        $users = $this->UploadDatas->Users->find('list', ['limit' => 200]);
        $this->set(compact('uploadData', 'users'));
        $this->set('_serialize', ['uploadData']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Upload Data id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $loguser = $this->request->session()->read('Auth.User');
		if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$this->request->allowMethod(['post', 'delete']);
        $uploadData = $this->UploadDatas->get($id);
        if ($this->UploadDatas->delete($uploadData)) {
            $this->Flash->success(__('The upload data has been deleted.'));
        } else {
            $this->Flash->error(__('The upload data could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function download($id=null){
	$loguser = $this->request->session()->read('Auth.User');
		if(!in_array($loguser['group_id'],array(1,7,10))){
		 	$this->Flash->error(__('Access Denied'));
        	return $this->redirect(['controller'=>'users','action' => 'access-denied']);
		 }
		$uploadData = $this->UploadDatas->get($id, [
            'contain' => ['Users']
        ]);
		$filename=WWW_ROOT . 'uploads' . DS.$uploadData->file_name;
		CommonHelper::downloadFile($filename);
			exit;
	}
	
}
