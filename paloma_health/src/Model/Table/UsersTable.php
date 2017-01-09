<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Practice
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\HasMany $Review
 */
class UsersTable extends Table
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
		
        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Acl.Acl', ['type' => 'requester']);
		
        /*$this->belongsTo('Practice', [
            'foreignKey' => 'practice_id'
        ]);*/
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Review', [
            'foreignKey' => 'user_id'
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
			
 		/*$validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');
			*/
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');
		$validator
			->requirePresence('first_name', 'create')
            ->notEmpty('first_name');
        $validator
			->requirePresence('last_name', 'create')
            ->notEmpty('last_name');
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

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
        //$rules->add($rules->isUnique(['username']));
		$rules->add($rules->isUnique(['email']));
        //$rules->add($rules->existsIn(['practice_id'], 'Practice'));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        return $rules;
    }
	public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity, \ArrayObject $options)
	{
		$hasher = new DefaultPasswordHasher;
		$entity->password = $hasher->hash($entity->password);
		return true;
	}
	public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
	{
		if(isset($data['password']) && isset($data['h_password']) && $data['password']==$data['h_password']) {
			unset($data['password']);
		}
	}
}
