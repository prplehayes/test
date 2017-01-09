<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Note Entity.
 *
 * @property int $id
 * @property int $claim_id
 * @property \App\Model\Entity\Claim $claim
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $note
 * @property string $option1
 * @property string $option2
 * @property string $option3
 * @property string $option4
 * @property string $type
 * @property string $extranote
 * @property \Cake\I18n\Time $created
 */
class Note extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
