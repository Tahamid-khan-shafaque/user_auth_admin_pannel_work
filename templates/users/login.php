<h1>Login</h1>
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <?= $this->Form->control('name') ?>
    <?= $this->Form->control('password', ['type' => 'password']) ?>
    <?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>