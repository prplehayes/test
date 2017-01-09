<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UploadDatasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UploadDatasTable Test Case
 */
class UploadDatasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UploadDatasTable
     */
    public $UploadDatas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.upload_datas',
        'app.users',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.groups',
        'app.notes',
        'app.claim',
        'app.patient',
        'app.practice',
        'app.practice_status',
        'app.practice_contract',
        'app.rates',
        'app.practice_payment_info',
        'app.patient_info',
        'app.patient_preferred_pharmacy',
        'app.patient_primary_physician',
        'app.patient_responsible_party',
        'app.claim_status',
        'app.review',
        'app.cpt_codes',
        'app.claim_icd10_codes',
        'app.icd10_codes',
        'app.claim_cpt_codes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UploadDatas') ? [] : ['className' => 'App\Model\Table\UploadDatasTable'];
        $this->UploadDatas = TableRegistry::get('UploadDatas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UploadDatas);

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