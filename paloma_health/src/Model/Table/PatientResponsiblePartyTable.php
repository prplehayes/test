<?php
namespace App\Model\Table;

use App\Model\Entity\PatientResponsibleParty;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PatientResponsibleParty Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Patient
 */
class PatientResponsiblePartyTable extends Table
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

        $this->table('patient_responsible_party');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id'
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
           // ->requirePresence('first_name', 'create')
            ->allowEmpty('first_name');

        $validator
            ->allowEmpty('middle_name');

        $validator
           // ->requirePresence('last_name', 'create')
            ->allowEmpty('last_name');

        $validator
            ->date('dob')
			//->requirePresence('dob', 'create')
            ->allowEmpty('dob');

        $validator
           // ->requirePresence('gender', 'create')
            ->allowEmpty('gender');

       /* $validator
            ->requirePresence('relationship', 'create')
            ->notEmpty('relationship');

        $validator
            ->requirePresence('address_1', 'create')
            ->notEmpty('address_1');

        $validator
            ->allowEmpty('address_2');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->requirePresence('zip', 'create')
			->minLength('zip', 5)
			->maxLength('zip', 5)
            ->notEmpty('zip');

        $validator
            ->requirePresence('home_phone', 'create')
			->minLength('home_phone', 12)
            ->notEmpty('home_phone');

        $validator
            ->allowEmpty('cell');

        $validator
            ->email('email')
            ->allowEmpty('email');*/

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
       // $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['patient_id'], 'Patient'));
        return $rules;
    }
}
