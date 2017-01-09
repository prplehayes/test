<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CptCode Entity.
 *
 * @property int $id
 * @property string $group
 * @property string $code
 * @property string $medicare_code
 * @property string $description
 * @property int $required_upper_or_lower
 * @property int $required_tooth_number
 * @property int $required_surface
 * @property int $required_quadrent_1_code
 * @property int $required_arch_code
 * @property int $required_quadrent_or_arch_code
 * @property \App\Model\Entity\ClaimIcd10Code[] $claim_icd10_codes
 * @property \App\Model\Entity\Claim[] $claim
 */
class CptCode extends Entity
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
