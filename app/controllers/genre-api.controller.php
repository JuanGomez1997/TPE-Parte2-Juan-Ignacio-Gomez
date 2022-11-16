<?php
    require_once './app/models/modelGenrebook.php';
    require_once './app/views/api.view.php';
    class controllerGenreBook{
        private $view;
        private $modelGenre;
        public function __construct(){
            $this->view=new ApiView ();
            $this->modelGenre=new GenreBookModel();
            $this->data = file_get_contents("php://input");
        }
        private function getAssessmentLibrery() {
            return json_decode($this->data);
        }
        public function showGender() {
            $genre=$this->modelGenre->getLibreryGenre();
            $this->view->response($genre);
        }
        public function seemoreGenreBook($params = null) {
            $id = $params[':ID'];
            $genre = $this->modelGenre->getGenreById($id);
            if ($genre){
                $this->view->response($genre);
            }
            else{ 
                $this->view->response("El genero con el id=$id no existe", 404);
            }
        }

    }