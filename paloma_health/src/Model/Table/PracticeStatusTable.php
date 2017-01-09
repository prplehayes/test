<?php
namespace App\Model\Table;

use App\Model\Entity\PracticeStatus;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PracticeStatus Model
 *
 * @property \Cake\ORM\Association\HasMany $Practice
 */
class PracticeStatusTable extends Table
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

        $this->table('practice_status');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Practice', [
            'foreignKey' => 'practice_status_id'
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
            ->allowEmpty('status');

        return $validator;
    }
}
