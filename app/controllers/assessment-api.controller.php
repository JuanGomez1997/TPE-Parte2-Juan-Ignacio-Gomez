<?php
require_once './app/models/modelAssessment.php';
require_once './app/views/api.view.php';

class ControllerApiAssessment{
    private $view;
    private $modelAssessment;
    private $data;
    public function __construct(){
        $this->view=new ApiView ();
        $this->modelAssessment=new AssessmentModel();
        $this->data = file_get_contents("php://input");
    }
    private function getAssessmentLibrery() {
        return json_decode($this->data);
    }
    public function getValuations() {
        $assessment = $this->modelAssessment->getLibreryAssessment();
        $this->view->response($assessment);
    }
    public function getAssessment($params = null) {
        $id = $params[':ID'];
        $assessment = $this->modelAssessment->getAssessmentById($id);
        if ($assessment){
            $this->view->response($assessment);
        }
        else{ 
            $this->view->response("La valoraciones con el id=$id no existe", 404);
        }
    }


    public function addNewAssessment() {
        $assessment = $this->getAssessmentLibrery();

        if (empty($assessment->valoracion)) {
            $this->view->response("Complete los datos", 400);
        } 
        else {
            $id = $this->modelAssessment->insertAssessment($assessment->valoracion);
            $assessment = $this->modelAssessment->getAssessmentById($id);
            $this->view->response("Nueva valoracion agregada", 201);
        }
    }
    
    public function editAssessment() {
        $assessment = $this->getAssessmentLibrery();

        if (empty($assessment->valoracion)) {
            $this->view->response("Complete los datos", 400);
        } 
        else {
            $id = $this->modelAssessment->editAssessmentById($assessment->valoracion,$assessment->id_valoracion);
            $assessment = $this->modelAssessment->getAssessmentById($id);
            $this->view->response("La valoracion fue editada", 201);
        }
    }

}