<?php
namespace App\Model\Table;

use App\Model\Entity\Practice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Practice Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PracticeStatus
 * @property \Cake\ORM\Association\HasMany $Patient
 * @property \Cake\ORM\Association\HasMany $PracticeContract
 * @property \Cake\ORM\Association\HasMany $PracticePaymentInfo
 * @property \Cake\ORM\Association\HasMany $Users
 */
class PracticeTable extends Table
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

        $this->table('practice');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PracticeStatus', [
            'foreignKey' => 'practice_status_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Patient', [
            'foreignKey' => 'practice_id'
        ]);
        $this->hasMany('PracticeContract', [
            'foreignKey' => 'practice_id'
        ]);
        $this->hasMany('PracticePaymentInfo', [
            'foreignKey' => 'practice_id'
        ]);
        $this->hasMany('Users', [
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
            ->notEmpty('Identifier')
            ->add('Identifier', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
		$validator
            ->notEmpty('practice_number');
			
        $validator
            ->notEmpty('contact_name');

        $validator
            ->notEmpty('contact_phone');

        $validator
            ->notEmpty('contact_email');

        $validator
            ->notEmpty('website');

        $validator
            ->integer('practitioner_count')
            ->notEmpty('practitioner_count');

        $validator
            ->notEmpty('mpi_number');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
        $rules->add($rules->isUnique(['Identifier']));
        $rules->add($rules->existsIn(['practice_status_id'], 'PracticeStatus'));
        return $rules;
    }
}
