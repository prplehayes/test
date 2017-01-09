<?php
namespace App\Model\Table;

use App\Model\Entity\ClaimAppeal;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaimAppeals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Claims
 */
class ClaimAppealsTable extends Table
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

        $this->table('claim_appeals');
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
            ->allowEmpty('ref_number');

        $validator
            ->allowEmpty('check_number');

        $validator
            ->requirePresence('pay_amount', 'create')
            ->notEmpty('pay_amount');

        $validator
            ->date('pay_date')
            ->allowEmpty('pay_date');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->requirePresence('reason_notes', 'create')
            ->allowEmpty('reason_notes');

        $validator
            ->requirePresence('appeal_status', 'create')
            ->notEmpty('appeal_status');

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
