<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Practice Entity.
 *
 * @property int $id
 * @property string $Identifier
 * @property string $practice_number
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $website
 * @property int $practitioner_count
 * @property string $mpi_number
 * @property int $practice_status_id
 * @property \App\Model\Entity\PracticeStatus $practice_status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 * @property \App\Model\Entity\Patient[] $patient
 * @property \App\Model\Entity\PracticeContract[] $practice_contract
 * @property \App\Model\Entity\PracticePaymentInfo[] $practice_payment_info
 * @property \App\Model\Entity\User[] $users
 */
class Practice extends Entity
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
