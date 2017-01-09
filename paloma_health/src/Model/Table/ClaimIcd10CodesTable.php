<?php
namespace App\Model\Table;

use App\Model\Entity\ClaimIcd10Code;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaimIcd10Codes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Claim
 * @property \Cake\ORM\Association\BelongsTo $Icd10Codes
 */
class ClaimIcd10CodesTable extends Table
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

        $this->table('claim_icd10_codes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Claim', [
            'foreignKey' => 'claim_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Icd10Codes', [
            'foreignKey' => 'icd10_code_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['claim_id'], 'Claim'));
        $rules->add($rules->existsIn(['icd10_code_id'], 'Icd10Codes'));
        return $rules;
    }
}
