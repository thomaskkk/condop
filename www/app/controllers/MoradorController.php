<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MoradorController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for morador
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Morador", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $morador = Morador::find($parameters);
        if (count($morador) == 0) {
            $this->flash->notice("The search did not find any morador");

            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $morador,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a morador
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $morador = Morador::findFirstByid($id);
            if (!$morador) {
                $this->flash->error("morador was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "morador",
                    "action" => "index"
                ));
            }

            $this->view->id = $morador->id;

            $this->tag->setDefault("id", $morador->getId());
            $this->tag->setDefault("Nome", $morador->getNome());
            $this->tag->setDefault("Cpf", $morador->getCpf());
            $this->tag->setDefault("Rg", $morador->getRg());
            $this->tag->setDefault("TelContato", $morador->getTelcontato());
            $this->tag->setDefault("Email", $morador->getEmail());
            $this->tag->setDefault("DataNasc", $morador->getDatanasc());
            $this->tag->setDefault("Foto", $morador->getFoto());
            
        }
    }

    /**
     * Creates a new morador
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "index"
            ));
        }

        $morador = new Morador();

        $morador->setId($this->request->getPost("id"));
        $morador->setNome($this->request->getPost("Nome"));
        $morador->setCpf($this->request->getPost("Cpf"));
        $morador->setRg($this->request->getPost("Rg"));
        $morador->setTelcontato($this->request->getPost("TelContato"));
        $morador->setEmail($this->request->getPost("Email"));
        $morador->setDatanasc($this->request->getPost("DataNasc"));
        $morador->setFoto($this->request->getPost("Foto"));
        

        if (!$morador->save()) {
            foreach ($morador->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "new"
            ));
        }

        $this->flash->success("morador was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "morador",
            "action" => "index"
        ));

    }

    /**
     * Saves a morador edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $morador = Morador::findFirstByid($id);
        if (!$morador) {
            $this->flash->error("morador does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "index"
            ));
        }

        $morador->setId($this->request->getPost("id"));
        $morador->setNome($this->request->getPost("Nome"));
        $morador->setCpf($this->request->getPost("Cpf"));
        $morador->setRg($this->request->getPost("Rg"));
        $morador->setTelcontato($this->request->getPost("TelContato"));
        $morador->setEmail($this->request->getPost("Email"));
        $morador->setDatanasc($this->request->getPost("DataNasc"));
        $morador->setFoto($this->request->getPost("Foto"));
        

        if (!$morador->save()) {

            foreach ($morador->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "edit",
                "params" => array($morador->id)
            ));
        }

        $this->flash->success("morador was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "morador",
            "action" => "index"
        ));

    }

    /**
     * Deletes a morador
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $morador = Morador::findFirstByid($id);
        if (!$morador) {
            $this->flash->error("morador was not found");

            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "index"
            ));
        }

        if (!$morador->delete()) {

            foreach ($morador->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "morador",
                "action" => "search"
            ));
        }

        $this->flash->success("morador was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "morador",
            "action" => "index"
        ));
    }

}
