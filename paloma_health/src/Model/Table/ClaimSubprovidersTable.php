<?php
namespace App\Model\Table;

use App\Model\Entity\ClaimSubprovider;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaimSubproviders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Claims
 * @property \Cake\ORM\Association\BelongsTo $Providers
 */
class ClaimSubprovidersTable extends Table
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

        $this->table('claim_subproviders');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Claims', [
            'foreignKey' => 'claim_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Providers', [
            'foreignKey' => 'provider_id',
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
        $rules->add($rules->existsIn(['claim_id'], 'Claims'));
        $rules->add($rules->existsIn(['provider_id'], 'Providers'));
        return $rules;
    }
}
