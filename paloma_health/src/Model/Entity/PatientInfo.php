<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PatientInfo Entity.
 *
 * @property int $id
 * @property int $patient_id
 * @property \App\Model\Entity\Patient $patient
 * @property string $img_photo_id
 * @property \App\Model\Entity\ImgPhoto $img_photo
 * @property string $img_medicare_card
 * @property string $consent_form_upload
 * @property int $text_messages_active
 * @property string $email
 * @property int $email_active
 * @property int $average_household_income
 * @property string $pay_frequency
 * @property int $number_of_household_members
 * @property string $housing_status
 * @property string $primary_language
 * @property string $race
 * @property string $ethnicity
 * @property int $is_migtant_worker
 * @property int $is_dependent_of_a_migrant_worker
 * @property int $is_seasonal_migrant_worker
 * @property int $is_depemdent_of_a_seasonal_migrant_worker
 * @property int $non_agricultural_worker
 * @property int $refused_unreported
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class PatientInfo extends Entity
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
