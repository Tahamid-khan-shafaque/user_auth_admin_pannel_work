<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\Log\Log;
/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Auth'); // Add this line
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register']);
    }

 
    public function register()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Registration failed. Please try again.'));
                Debugger::dump($user->getErrors());
            }
        }

        $this->set(compact('user'));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Invalid username or password. Please try again.');
        }
    }

    public function view()
    {
        $user = $this->Auth->user();
        $this->set(compact('user'));
    }
}
