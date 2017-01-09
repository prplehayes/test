<?php
namespace App\Model\Table;

use App\Model\Entity\PracticeContract;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PracticeContract Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Practice
 * @property \Cake\ORM\Association\BelongsTo $Rates
 */
class PracticeContractTable extends Table
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

        $this->table('practice_contract');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Practice', [
            'foreignKey' => 'practice_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Rates', [
            'foreignKey' => 'rate_id',
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
            ->allowEmpty('docusign_url');

        $validator
            ->allowEmpty('docusign_accountId');

        $validator
            ->allowEmpty('docusign_emailSubject');

        $validator
            ->allowEmpty('docusign_emailBlurb');

        $validator
            ->integer('docusign_templateId')
            ->allowEmpty('docusign_templateId');

        $validator
            ->integer('docusign_brandId')
            ->allowEmpty('docusign_brandId');

        $validator
            ->allowEmpty('status');

        $validator
            ->dateTime('signed')
            ->allowEmpty('signed');

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
        $rules->add($rules->existsIn(['rate_id'], 'Rates'));
        return $rules;
    }
}
