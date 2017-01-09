<?php
namespace App\Model\Table;

use App\Model\Entity\ClaimCptCode;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaimCptCodes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Claim
 * @property \Cake\ORM\Association\BelongsTo $CptCodes
 */
class ClaimCptCodesTable extends Table
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

        $this->table('claim_cpt_codes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Claim', [
            'foreignKey' => 'claim_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CptCodes', [
            'foreignKey' => 'cpt_code_id',
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

        $validator
            ->allowEmpty('upper_or_lower');

        $validator
            ->integer('tooth_number')
            ->allowEmpty('tooth_number');

        $validator
            ->allowEmpty('surface');
		$validator
            ->allowEmpty('surface2');
		$validator
            ->allowEmpty('surface3');
		$validator
            ->allowEmpty('surface4');

        $validator
            ->allowEmpty('quadrent_1_code');

        $validator
            ->allowEmpty('quadrent_2_code');

        $validator
            ->allowEmpty('arch_code');

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
        $rules->add($rules->existsIn(['cpt_code_id'], 'CptCodes'));
        return $rules;
    }
}
