<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClaimSubprovidersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClaimSubprovidersTable Test Case
 */
class ClaimSubprovidersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClaimSubprovidersTable
     */
    public $ClaimSubproviders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.claim_subproviders',
        'app.claims',
        'app.providers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ClaimSubproviders') ? [] : ['className' => 'App\Model\Table\ClaimSubprovidersTable'];
        $this->ClaimSubproviders = TableRegistry::get('ClaimSubproviders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClaimSubproviders);

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
