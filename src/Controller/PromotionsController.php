<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Promotions Controller
 *
 * @property \App\Model\Table\PromotionsTable $Promotions
 *
 * @method \App\Model\Entity\Promotion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PromotionsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['getBySubscription']);
    }

    public function isAuthorized($user) {

        $action = $this->request->getParam('action');

        if (isset($user['role']) && $user['role'] === 'admin' && $user['status'] === true) {
            return true;
        }

        if (in_array($action, ['add', 'edit']) && $user['status'] === true) {
            return true;
        }

        if (in_array($action, ['view', 'index'])) {
            return true;
        }

    }


    public function getBySubscription() {
        $subscription_id = $this->request->query('subscription_id');
        $promotions = $this->Promotions->find('all', [
            'conditions' => ['Promotions.subscription_id' => $subscription_id],
        ]);
        $this->set('promotions', $promotions);
        $this->set('_serialize', ['promotions']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Subscriptions', 'Clients']
        ];
        $promotions = $this->paginate($this->Promotions);

        $this->set(compact('promotions'));
    }

    /**
     * View method
     *
     * @param string|null $id Promotion id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promotion = $this->Promotions->get($id, [
            'contain' => ['Subscriptions', 'Clients']
        ]);

        $this->set('promotion', $promotion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $promotion = $this->Promotions->newEntity();
        if ($this->request->is('post')) {
            $promotion = $this->Promotions->patchEntity($promotion, $this->request->getData());
            if ($this->Promotions->save($promotion)) {
                $this->Flash->success(__('The promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promotion could not be saved. Please, try again.'));
        }
        $subscriptions = $this->Promotions->Subscriptions->find('list', ['limit' => 200, 'conditions' => ['NOT' => ['Subscriptions.name' => 'Aucun abonnement']]]);
        //$subscriptions = $this->Promotions->Subscriptions->find('list', ['limit' => 200]);
        $this->set(compact('promotion', 'subscriptions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Promotion id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $promotion = $this->Promotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promotion = $this->Promotions->patchEntity($promotion, $this->request->getData());
            if ($this->Promotions->save($promotion)) {
                $this->Flash->success(__('The promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promotion could not be saved. Please, try again.'));
        }
        $this->set(compact('promotion', 'subscriptions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Promotion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $promotion = $this->Promotions->get($id);
        if ($this->Promotions->delete($promotion)) {
            $this->Flash->success(__('The promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
