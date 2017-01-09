<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PracticePaymentInfo Entity.
 *
 * @property int $id
 * @property int $practice_id
 * @property \App\Model\Entity\Practice $practice
 * @property string $first_name
 * @property string $last_name
 * @property string $token
 * @property int $expiration_month
 * @property int $expiration_year
 * @property string $cvv
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $recurring_active
 */
class PracticePaymentInfo extends Entity
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

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
