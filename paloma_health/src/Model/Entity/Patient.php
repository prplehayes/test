<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity.
 *
 * @property int $id
 * @property int $practice_id
 * @property \App\Model\Entity\Practice $practice
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $ssn
 * @property string $medicare_number
 * @property \Cake\I18n\Time $dob
 * @property string $gender
 * @property string $address_1
 * @property string $address_2
 * @property string $po_box
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $home_phone
 * @property string $cell
 * @property string $img_photo_id_upload
 * @property string $img_medicare_card
 * @property string $consent_form_upload
 * @property string $registration_form_upload
 * @property int $text_messages_active
 * @property string $email
 * @property int $email_active
 * @property int $sameadd
 * @property string $patient_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Claim[] $claim
 * @property \App\Model\Entity\PatientInfo[] $patient_info
 * @property \App\Model\Entity\PatientPreferredPharmacy[] $patient_preferred_pharmacy
 * @property \App\Model\Entity\PatientPrimaryPhysician[] $patient_primary_physician
 * @property \App\Model\Entity\PatientResponsibleParty[] $patient_responsible_party
 */
class Patient extends Entity
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
