<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Claim Entity.
 *
 * @property int $id
 * @property int $patient_id
 * @property \App\Model\Entity\Patient $patient
 * @property string $claim_number
 * @property int $claim_status_id
 * @property \App\Model\Entity\ClaimStatus $claim_status
 * @property string $dental_verification_upload
 * @property string $progress_notes_upload
 * @property string $title
 * @property string $signature
 * @property \Cake\I18n\Time $date_of_service
 * @property string $comments
 * @property int $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Review[] $review
 * @property \App\Model\Entity\CptCode[] $cpt_codes
 * @property \App\Model\Entity\Icd10Code[] $icd10_codes
 */
class Claim extends Entity
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
