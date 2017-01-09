<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PracticeContract Entity.
 *
 * @property int $id
 * @property int $practice_id
 * @property \App\Model\Entity\Practice $practice
 * @property int $rate_id
 * @property \App\Model\Entity\Rate $rate
 * @property string $docusign_url
 * @property string $docusign_accountId
 * @property string $docusign_emailSubject
 * @property string $docusign_emailBlurb
 * @property int $docusign_templateId
 * @property int $docusign_brandId
 * @property string $status
 * @property \Cake\I18n\Time $signed
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class PracticeContract extends Entity
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
