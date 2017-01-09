<?php
namespace App\Model\Table;

use App\Model\Entity\Icd10Code;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Icd10Codes Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Claim
 */
class Icd10CodesTable extends Table
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

        $this->table('icd10_codes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Claim', [
            'foreignKey' => 'icd10_code_id',
            'targetForeignKey' => 'claim_id',
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
            ->requirePresence('group', 'create')
            ->notEmpty('group');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
