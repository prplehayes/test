<div class="practice view large-9 medium-8 columns content">
    <h3><?= h($practice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Practice Name') ?></th>
            <td><?= h($practice->Identifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Name') ?></th>
            <td><?= h($practice->contact_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Phone') ?></th>
            <td><?= h($practice->contact_phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Email') ?></th>
            <td><?= h($practice->contact_email) ?></td>
        </tr>
        <tr>
            <th><?= __('Website') ?></th>
            <td><?= h($practice->website) ?></td>
        </tr>
        <tr>
            <th><?= __('Mpi Number') ?></th>
            <td><?= h($practice->mpi_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Practice Status') ?></th>
            <td><?= $practiceStatus[$practice->practice_status->id] ?></td>
        </tr>
        
        <tr>
            <th><?= __('Practitioner Count') ?></th>
            <td><?= $this->Number->format($practice->practitioner_count) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Patients List') ?></h4>
        <?php if (!empty($practice->patient)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Patient Name') ?></th>
                <th><?= __('Ssn') ?></th>
                <th><?= __('Dob') ?></th>
                <th><?= __('Email') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->patient as $patient): ?>
            <tr>
                <td><?= h($patient->first_name)." ".h($patient->last_name) ?></td>
                <td><?= h($patient->ssn) ?></td>
                <td><?= h($patient->dob) ?></td>
                <td><?= h($patient->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Patient', 'action' => 'view', $patient->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Patient', 'action' => 'edit', $patient->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Patient', 'action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Practice Contract') ?></h4>
        <?php if (!empty($practice->practice_contract)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Rate Id') ?></th>
                <th><?= __('Docusign Url') ?></th>
                <th><?= __('Docusign AccountId') ?></th>
                <th><?= __('Docusign EmailSubject') ?></th>
                <th><?= __('Docusign EmailBlurb') ?></th>
                <th><?= __('Docusign TemplateId') ?></th>
                <th><?= __('Docusign BrandId') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Signed') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->practice_contract as $practiceContract): ?>
            <tr>
                <td><?= h($practiceContract->rate_id) ?></td>
                <td><?= h($practiceContract->docusign_url) ?></td>
                <td><?= h($practiceContract->docusign_accountId) ?></td>
                <td><?= h($practiceContract->docusign_emailSubject) ?></td>
                <td><?= h($practiceContract->docusign_emailBlurb) ?></td>
                <td><?= h($practiceContract->docusign_templateId) ?></td>
                <td><?= h($practiceContract->docusign_brandId) ?></td>
                <td><?= h($practiceContract->status) ?></td>
                <td><?= h($practiceContract->signed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PracticeContract', 'action' => 'view', $practiceContract->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PracticeContract', 'action' => 'edit', $practiceContract->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PracticeContract', 'action' => 'delete', $practiceContract->id], ['confirm' => __('Are you sure you want to delete # {0}?', $practiceContract->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Practice Payment Info') ?></h4>
        <?php if (!empty($practice->practice_payment_info)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Token') ?></th>
                <th><?= __('Expiration Month') ?></th>
                <th><?= __('Expiration Year') ?></th>
                <th><?= __('Cvv') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->practice_payment_info as $practicePaymentInfo): ?>
            <tr>
                <td><?= h($practicePaymentInfo->first_name) ?></td>
                <td><?= h($practicePaymentInfo->last_name) ?></td>
                <td><?= h($practicePaymentInfo->token) ?></td>
                <td><?= h($practicePaymentInfo->expiration_month) ?></td>
                <td><?= h($practicePaymentInfo->expiration_year) ?></td>
                <td><?= h($practicePaymentInfo->cvv) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PracticePaymentInfo', 'action' => 'view', $practicePaymentInfo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PracticePaymentInfo', 'action' => 'edit', $practicePaymentInfo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PracticePaymentInfo', 'action' => 'delete', $practicePaymentInfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $practicePaymentInfo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Users') ?></h4>
        <?php if (!empty($practice->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Name') ?></th>
               
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->users as $users): ?>
            <tr>
                <td><?= h($users->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
