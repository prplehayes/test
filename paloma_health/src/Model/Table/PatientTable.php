<?php
namespace App\Model\Table;

use App\Model\Entity\Patient;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patient Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Practice
 * @property \Cake\ORM\Association\HasMany $Claim
 * @property \Cake\ORM\Association\HasMany $PatientInfo
 * @property \Cake\ORM\Association\HasMany $PatientPreferredPharmacy
 * @property \Cake\ORM\Association\HasMany $PatientPrimaryPhysician
 * @property \Cake\ORM\Association\HasMany $PatientResponsibleParty
 */
class PatientTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('patient');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Practice', [
            'foreignKey' => 'practice_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Claim', [
            'foreignKey' => 'patient_id'
        ]);
        $this->hasMany('PatientInfo', [
            'foreignKey' => 'patient_id'
        ]);
        $this->hasMany('PatientPreferredPharmacy', [
            'foreignKey' => 'patient_id'
        ]);
        $this->hasMany('PatientPrimaryPhysician', [
            'foreignKey' => 'patient_id'
        ]);
        $this->hasMany('PatientResponsibleParty', [
            'foreignKey' => 'patient_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
			->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->allowEmpty('middle_name');

        $validator
			->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        /*$validator
           ->requirePresence('ssn', 'create')
		   ->minLength('ssn', 11)
            ->notEmpty('ssn');*/
		$validator
			->requirePresence('patient_id', 'create')
            ->notEmpty('patient_id');
			
        $validator
            ->date('dob')
			->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

       /* $validator
			->requirePresence('address_1', 'create')
            ->notEmpty('address_1');

        $validator
            ->allowEmpty('address_2');

        $validator
			->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
			->requirePresence('state', 'create')
            ->notEmpty('state');
			
		 $validator
            ->allowEmpty('po_box');
			
		 $validator
		 	->requirePresence('medicare_number', 'create')
			->minLength('medicare_number', 12)
            ->notEmpty('medicare_number');
				
        $validator
			->requirePresence('zip', 'create')
			->minLength('zip', 5)
			->maxLength('zip', 5)
            ->notEmpty('zip');

        $validator
			->requirePresence('home_phone', 'create')
			->minLength('home_phone', 12)
            ->notEmpty('home_phone');

        $validator
            ->allowEmpty('cell');

        $validator
            ->allowEmpty('img_photo_id_upload');

        $validator
            ->allowEmpty('img_medicare_card');

        $validator
            ->allowEmpty('consent_form_upload');
			
		$validator
            ->allowEmpty('registration_form_upload');
			
        $validator
            ->integer('text_messages_active')
            ->allowEmpty('text_messages_active');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->integer('email_active')
            ->allowEmpty('email_active');
			*/
		 $validator
            ->integer('sameadd')
            ->allowEmpty('sameadd');	

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->isUnique(['email']));
		//$rules->add($rules->isUnique(['ssn']));
		$rules->add($rules->isUnique(['patient_id']));
        $rules->add($rules->existsIn(['practice_id'], 'Practice'));
        return $rules;
    }
}
