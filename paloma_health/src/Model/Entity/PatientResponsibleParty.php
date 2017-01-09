<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PatientResponsibleParty Entity.
 *
 * @property int $id
 * @property int $patient_id
 * @property \App\Model\Entity\Patient $patient
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property \Cake\I18n\Time $dob
 * @property string $gender
 * @property string $relationship
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $home_phone
 * @property string $cell
 * @property string $email
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class PatientResponsibleParty extends Entity
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
