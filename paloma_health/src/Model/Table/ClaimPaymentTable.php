<?php
namespace App\Model\Table;

use App\Model\Entity\ClaimPayment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaimPayment Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Claim
 */
class ClaimPaymentTable extends Table
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

        $this->table('claim_payment');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Claim', [
            'foreignKey' => 'claim_id',
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
            ->allowEmpty('pay_batch_number');

        $validator
            ->allowEmpty('ref_number');
		$validator
            ->allowEmpty('ehs_number');	

        $validator
            ->allowEmpty('check_number');

        $validator
            ->requirePresence('pay_amount', 'create')
            ->notEmpty('pay_amount');

        $validator
            ->date('pay_date')
            ->allowEmpty('pay_date');

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
        return $rules;
    }
}
