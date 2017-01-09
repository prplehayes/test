<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClaimPayment Entity.
 *
 * @property int $id
 * @property int $claim_id
 * @property \App\Model\Entity\Claim $claim
 * @property string $pay_batch_number
 * @property string $ref_number
 * @property string $check_number
 * @property string $pay_amount
 * @property \Cake\I18n\Time $pay_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ClaimPayment extends Entity
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
