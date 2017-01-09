<div class="practice view large-9 medium-8 columns content">
    <h3><?= h($practice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Identifier') ?></th>
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
        <h4><?= __('Related Patient') ?></h4>
        <?php if (!empty($practice->patient)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Practice Id') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Middle Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Ssn') ?></th>
                <th><?= __('Dob') ?></th>
                <th><?= __('Gender') ?></th>
                <th><?= __('Address 1') ?></th>
                <th><?= __('Address 2') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('State') ?></th>
                <th><?= __('Zip') ?></th>
                <th><?= __('Home Phone') ?></th>
                <th><?= __('Cell') ?></th>
                <th><?= __('Img Photo Id Upload') ?></th>
                <th><?= __('Img Medicare Card') ?></th>
                <th><?= __('Consent Form Upload') ?></th>
                <th><?= __('Text Messages Active') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Email Active') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->patient as $patient): ?>
            <tr>
                <td><?= h($patient->id) ?></td>
                <td><?= h($patient->practice_id) ?></td>
                <td><?= h($patient->first_name) ?></td>
                <td><?= h($patient->middle_name) ?></td>
                <td><?= h($patient->last_name) ?></td>
                <td><?= h($patient->ssn) ?></td>
                <td><?= h($patient->dob) ?></td>
                <td><?= h($patient->gender) ?></td>
                <td><?= h($patient->address_1) ?></td>
                <td><?= h($patient->address_2) ?></td>
                <td><?= h($patient->city) ?></td>
                <td><?= h($patient->state) ?></td>
                <td><?= h($patient->zip) ?></td>
                <td><?= h($patient->home_phone) ?></td>
                <td><?= h($patient->cell) ?></td>
                <td><?= h($patient->img_photo_id_upload) ?></td>
                <td><?= h($patient->img_medicare_card) ?></td>
                <td><?= h($patient->consent_form_upload) ?></td>
                <td><?= h($patient->text_messages_active) ?></td>
                <td><?= h($patient->email) ?></td>
                <td><?= h($patient->email_active) ?></td>
                <td><?= h($patient->created) ?></td>
                <td><?= h($patient->modified) ?></td>
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
        <h4><?= __('Related Practice Contract') ?></h4>
        <?php if (!empty($practice->practice_contract)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Practice Id') ?></th>
                <th><?= __('Rate Id') ?></th>
                <th><?= __('Docusign Url') ?></th>
                <th><?= __('Docusign AccountId') ?></th>
                <th><?= __('Docusign EmailSubject') ?></th>
                <th><?= __('Docusign EmailBlurb') ?></th>
                <th><?= __('Docusign TemplateId') ?></th>
                <th><?= __('Docusign BrandId') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Signed') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->practice_contract as $practiceContract): ?>
            <tr>
                <td><?= h($practiceContract->id) ?></td>
                <td><?= h($practiceContract->practice_id) ?></td>
                <td><?= h($practiceContract->rate_id) ?></td>
                <td><?= h($practiceContract->docusign_url) ?></td>
                <td><?= h($practiceContract->docusign_accountId) ?></td>
                <td><?= h($practiceContract->docusign_emailSubject) ?></td>
                <td><?= h($practiceContract->docusign_emailBlurb) ?></td>
                <td><?= h($practiceContract->docusign_templateId) ?></td>
                <td><?= h($practiceContract->docusign_brandId) ?></td>
                <td><?= h($practiceContract->status) ?></td>
                <td><?= h($practiceContract->signed) ?></td>
                <td><?= h($practiceContract->created) ?></td>
                <td><?= h($practiceContract->modified) ?></td>
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
        <h4><?= __('Related Practice Payment Info') ?></h4>
        <?php if (!empty($practice->practice_payment_info)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Practice Id') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Token') ?></th>
                <th><?= __('Expiration Month') ?></th>
                <th><?= __('Expiration Year') ?></th>
                <th><?= __('Cvv') ?></th>
                <th><?= __('Address 1') ?></th>
                <th><?= __('Address 2') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('State') ?></th>
                <th><?= __('Zip') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Recurring Active') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->practice_payment_info as $practicePaymentInfo): ?>
            <tr>
                <td><?= h($practicePaymentInfo->id) ?></td>
                <td><?= h($practicePaymentInfo->practice_id) ?></td>
                <td><?= h($practicePaymentInfo->first_name) ?></td>
                <td><?= h($practicePaymentInfo->last_name) ?></td>
                <td><?= h($practicePaymentInfo->token) ?></td>
                <td><?= h($practicePaymentInfo->expiration_month) ?></td>
                <td><?= h($practicePaymentInfo->expiration_year) ?></td>
                <td><?= h($practicePaymentInfo->cvv) ?></td>
                <td><?= h($practicePaymentInfo->address_1) ?></td>
                <td><?= h($practicePaymentInfo->address_2) ?></td>
                <td><?= h($practicePaymentInfo->city) ?></td>
                <td><?= h($practicePaymentInfo->state) ?></td>
                <td><?= h($practicePaymentInfo->zip) ?></td>
                <td><?= h($practicePaymentInfo->created) ?></td>
                <td><?= h($practicePaymentInfo->modified) ?></td>
                <td><?= h($practicePaymentInfo->recurring_active) ?></td>
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
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($practice->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Practice Id') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('User Type Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($practice->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->practice_id) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->user_type_id) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
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
