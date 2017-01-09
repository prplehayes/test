<?php
namespace App\Model\Table;

use App\Model\Entity\PracticePaymentInfo;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PracticePaymentInfo Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Practice
 */
class PracticePaymentInfoTable extends Table
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

        $this->table('practice_payment_info');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Practice', [
            'foreignKey' => 'practice_id'
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
            ->notEmpty('first_name');

        $validator
            ->notEmpty('last_name');

        $validator
            ->notEmpty('token');

        $validator
            ->integer('expiration_month')
            ->notEmpty('expiration_month');

        $validator
            ->integer('expiration_year')
            ->notEmpty('expiration_year');

        $validator
            ->notEmpty('cvv');

        $validator
            ->notEmpty('address_1');

        $validator
            ->notEmpty('address_2');

        $validator
            ->notEmpty('city');

        $validator
            ->notEmpty('state');

        $validator
            ->notEmpty('zip');

        $validator
            ->integer('recurring_active')
            ->allowEmpty('recurring_active');

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
        $rules->add($rules->existsIn(['practice_id'], 'Practice'));
        return $rules;
    }
}
