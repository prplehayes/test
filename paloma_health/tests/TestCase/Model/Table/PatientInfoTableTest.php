<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatientInfoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatientInfoTable Test Case
 */
class PatientInfoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PatientInfoTable
     */
    public $PatientInfo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.patient_info',
        'app.patient',
        'app.practice',
        'app.practice_status',
        'app.practice_contract',
        'app.practice_payment_info',
        'app.users',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.groups',
        'app.notes',
        'app.review',
        'app.claim',
        'app.claim_status',
        'app.cpt_codes',
        'app.claim_cpt_codes',
        'app.icd10_codes',
        'app.claim_icd10_codes',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician',
        'app.patient_responsible_party',
        'app.img_photos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PatientInfo') ? [] : ['className' => 'App\Model\Table\PatientInfoTable'];
        $this->PatientInfo = TableRegistry::get('PatientInfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PatientInfo);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
