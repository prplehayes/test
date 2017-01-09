<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatientPrimaryPhysicianTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatientPrimaryPhysicianTable Test Case
 */
class PatientPrimaryPhysicianTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PatientPrimaryPhysicianTable
     */
    public $PatientPrimaryPhysician;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.patient_primary_physician',
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
        'app.patient_info',
        'app.img_photos',
        'app.patient_preferred_pharmacy',
        'app.patient_responsible_party'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PatientPrimaryPhysician') ? [] : ['className' => 'App\Model\Table\PatientPrimaryPhysicianTable'];
        $this->PatientPrimaryPhysician = TableRegistry::get('PatientPrimaryPhysician', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PatientPrimaryPhysician);

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
