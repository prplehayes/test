<?php
namespace App\Model\Table;

use App\Model\Entity\CptCode;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CptCodes Model
 *
 * @property \Cake\ORM\Association\HasMany $ClaimIcd10Codes
 * @property \Cake\ORM\Association\BelongsToMany $Claim
 */
class CptCodesTable extends Table
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

        $this->table('cpt_codes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('ClaimIcd10Codes', [
            'foreignKey' => 'cpt_code_id'
        ]);
        $this->belongsToMany('Claim', [
            'foreignKey' => 'cpt_code_id',
            'targetForeignKey' => 'claim_id',
            'joinTable' => 'claim_cpt_codes'
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
            ->requirePresence('medicare_code', 'create')
            ->notEmpty('medicare_code');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('required_upper_or_lower')
            ->requirePresence('required_upper_or_lower', 'create')
            ->notEmpty('required_upper_or_lower');

        $validator
            ->integer('required_tooth_number')
            ->requirePresence('required_tooth_number', 'create')
            ->notEmpty('required_tooth_number');

        $validator
            ->integer('required_surface')
            ->requirePresence('required_surface', 'create')
            ->notEmpty('required_surface');
		$validator
            ->integer('required_surface2')
            ->requirePresence('required_surface2', 'create')
            ->notEmpty('required_surface2');
		$validator
            ->integer('required_surface3')
            ->requirePresence('required_surface3', 'create')
            ->notEmpty('required_surface3');
		$validator
            ->integer('required_surface4')
            ->requirePresence('required_surface4', 'create')
            ->notEmpty('required_surface4');			

        $validator
            ->integer('required_quadrent_1_code')
            ->requirePresence('required_quadrent_1_code', 'create')
            ->notEmpty('required_quadrent_1_code');

        $validator
            ->integer('required_arch_code')
            ->requirePresence('required_arch_code', 'create')
            ->notEmpty('required_arch_code');

        $validator
            ->integer('required_quadrent_or_arch_code')
            ->requirePresence('required_quadrent_or_arch_code', 'create')
            ->notEmpty('required_quadrent_or_arch_code');

        return $validator;
    }
}
