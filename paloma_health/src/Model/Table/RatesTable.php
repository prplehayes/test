<?php
namespace App\Model\Table;

use App\Model\Entity\Rate;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Rates
 * @property \Cake\ORM\Association\HasMany $PracticeContract
 * @property \Cake\ORM\Association\HasMany $Rates
 */
class RatesTable extends Table
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

        $this->table('rates');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Rates', [
            'foreignKey' => 'rate_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PracticeContract', [
            'foreignKey' => 'rate_id'
        ]);
        $this->hasMany('Rates', [
            'foreignKey' => 'rate_id'
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
        $rules->add($rules->existsIn(['rate_id'], 'Rates'));
        return $rules;
    }
}
