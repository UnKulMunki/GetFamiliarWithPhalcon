<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ContactsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {

         /**
          * Loads the view context form contacts.phtml or contacts.volt depending 
          * on defined engine
          */

         /**
          * Pull records out of the data model
          */
          // $this->view->contacts = Contacts::find(array("order" => "type DESC"));
          // $this->view->title="My Contacts";

          // Can also use vars within find() as a select criteria.
          // Ex: Contacts::find("type = 'business'");
          // Ex: Contacts::findFirst("lastname = 'Dickey'");

        $this->persistent->parameters = null;
    }

    /**
     * Searches for contacts
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Contacts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $contacts = Contacts::find($parameters);
        if (count($contacts) == 0) {
            $this->flash->notice("The search did not find any contacts");

            $this->dispatcher->forward(
                [
                "controller" => "contacts",
                "action" => "index"
                ]
            );

            return;
        }

        $paginator = new Paginator(
            [
            'data' => $contacts,
            'limit'=> 10,
            'page' => $numberPage
            ]
        );

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        /**
         * This does nothing other than display the template.
         */
    }

    /**
     * Edits a contact
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $contact = Contacts::findFirstByid($id);
            if (!$contact) {
                $this->flash->error("contact was not found");

                $this->dispatcher->forward(
                    [
                    'controller' => "contacts",
                    'action' => 'index'
                    ]
                );

                return;
            }

            $this->view->id = $contact->id;

            $this->tag->setDefault("id", $contact->id);
            $this->tag->setDefault("name", $contact->name);
            $this->tag->setDefault("email", $contact->email);
            $this->tag->setDefault("phone", $contact->phone);
            $this->tag->setDefault("type", $contact->type);
            
        } else {
            $this->flash->error("Invalid Request");
            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'index'
                ]
            );
            return;
        }
    }

    /**
     * Creates a new contact
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'index'
                ]
            );

            return;
        }

        $contact = new Contacts();
        $contact->name = $this->request->getPost("name");
        $contact->email = $this->request->getPost("email", "email");
        $contact->phone = $this->request->getPost("phone");
        $contact->type = $this->request->getPost("type");
        

        if (!$contact->save()) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'new'
                ]
            );

            return;
        }

        $this->flash->success("contact was created successfully");

        $this->dispatcher->forward(
            [
            'controller' => "contacts",
            'action' => 'index'
            ]
        );
    }

    /**
     * Updates (Save) an edited contact
     *
     */
    public function updateAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'index'
                ]
            );

            return;
        }

        $id = $this->request->getPost("id");
        $contact = Contacts::findFirstByid($id);

        if (!$contact) {
            $this->flash->error("contact does not exist " . $id);

            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'index'
                ]
            );

            return;
        }

        $contact->name = $this->request->getPost("name");
        $contact->email = $this->request->getPost("email", "email");
        $contact->phone = $this->request->getPost("phone");
        $contact->type = $this->request->getPost("type");
        

        if (!$contact->save()) {

            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'edit',
                'params' => [$contact->id]
                ]
            );

            return;
        }

        $this->flash->success("contact was updated successfully");

        $this->dispatcher->forward(
            [
            'controller' => "contacts",
            'action' => 'index'
            ]
        );
    }

    /**
     * Deletes a contact
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $contact = Contacts::findFirstByid($id);
        if (!$contact) {
            $this->flash->error("contact was not found");

            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'index'
                ]
            );

            return;
        }

        if (!$contact->delete()) {

            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(
                [
                'controller' => "contacts",
                'action' => 'index'
                ]
            );;

            return;
        }

        $this->flash->success("contact was deleted successfully");

        $this->dispatcher->forward(
            [
            'controller' => "contacts",
            'action' => 'index'
            ]
        );
    }

}
