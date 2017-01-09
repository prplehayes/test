<?php
namespace App\Model\Table;

use App\Model\Entity\PatientInfo;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PatientInfo Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Patient
 * @property \Cake\ORM\Association\BelongsTo $ImgPhotos
 */
class PatientInfoTable extends Table
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

        $this->table('patient_info');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id'
        ]);
        /*$this->belongsTo('ImgPhotos', [
            'foreignKey' => 'img_photo_id'
        ]);*/
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
            ->allowEmpty('img_medicare_card');

        $validator
            ->allowEmpty('consent_form_upload');

        /*$validator
            ->integer('text_messages_active')
            ->allowEmpty('text_messages_active');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->integer('email_active')
            ->allowEmpty('email_active');

        $validator
            ->integer('average_household_income')
			->requirePresence('average_household_income', 'create')
            ->notEmpty('average_household_income');

        $validator
            ->allowEmpty('pay_frequency');

        $validator
            ->integer('number_of_household_members')
			->requirePresence('number_of_household_members', 'create')
            ->notEmpty('number_of_household_members');

        $validator
			->requirePresence('housing_status', 'create')
            ->notEmpty('housing_status');

        $validator
			->requirePresence('primary_language', 'create')
            ->notEmpty('primary_language');

        $validator
            ->requirePresence('race', 'create')
            ->notEmpty('race');

        $validator
            ->requirePresence('ethnicity', 'create')
            ->notEmpty('ethnicity');

        $validator
            ->integer('is_migtant_worker')
            ->requirePresence('is_migtant_worker', 'create')
            ->notEmpty('is_migtant_worker');

        $validator
            ->integer('is_dependent_of_a_migrant_worker')
            ->requirePresence('is_dependent_of_a_migrant_worker', 'create')
            ->notEmpty('is_dependent_of_a_migrant_worker');

        $validator
            ->integer('is_seasonal_migrant_worker')
            ->requirePresence('is_seasonal_migrant_worker', 'create')
            ->notEmpty('is_seasonal_migrant_worker');

        $validator
            ->integer('is_depemdent_of_a_seasonal_migrant_worker')
            ->requirePresence('is_depemdent_of_a_seasonal_migrant_worker', 'create')
            ->notEmpty('is_depemdent_of_a_seasonal_migrant_worker');

        $validator
            ->integer('non_agricultural_worker')
            ->requirePresence('non_agricultural_worker', 'create')
            ->notEmpty('non_agricultural_worker');

        $validator
            ->integer('refused_unreported')
            ->requirePresence('refused_unreported', 'create')
            ->notEmpty('refused_unreported');*/

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
       // $rules->add($rules->existsIn(['img_photo_id'], 'ImgPhotos'));
        return $rules;
    }
}
