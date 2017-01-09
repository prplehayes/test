<?php
namespace App\Model\Table;

use App\Model\Entity\Claim;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Claim Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Patient
 * @property \Cake\ORM\Association\BelongsTo $ClaimStatus
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\HasMany $Review
 * @property \Cake\ORM\Association\BelongsToMany $CptCodes
 * @property \Cake\ORM\Association\BelongsToMany $Icd10Codes
 */
class ClaimTable extends Table
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

        $this->table('claim');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id'
        ]);
        $this->belongsTo('ClaimStatus', [
            'foreignKey' => 'claim_status_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'claim_id'
        ]);
        $this->hasMany('Review', [
            'foreignKey' => 'claim_id'
        ]);
        $this->belongsToMany('CptCodes', [
            'foreignKey' => 'claim_id',
            'targetForeignKey' => 'cpt_code_id',
            'joinTable' => 'claim_cpt_codes'
        ]);
        $this->belongsToMany('Icd10Codes', [
            'foreignKey' => 'claim_id',
            'targetForeignKey' => 'icd10_code_id',
            'joinTable' => 'claim_icd10_codes'
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
            ->requirePresence('claim_number', 'create')
            ->notEmpty('claim_number');

        $validator
            ->allowEmpty('dental_verification_upload');

        $validator
            ->allowEmpty('progress_notes_upload');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('signature');

        $validator
            ->date('date_of_service')
            ->requirePresence('date_of_service', 'create')
            ->notEmpty('date_of_service');

        $validator
            ->allowEmpty('comments');
		
		$validator
            ->allowEmpty('user_id');
		$validator
            ->allowEmpty('modify_by');	
	    $validator
            ->allowEmpty('review_by');					

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
        $rules->add($rules->existsIn(['patient_id'], 'Patient'));
        $rules->add($rules->existsIn(['claim_status_id'], 'ClaimStatus'));
        return $rules;
    }
}
