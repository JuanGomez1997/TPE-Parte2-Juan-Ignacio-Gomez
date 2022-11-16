<?php
require_once './app/models/modelBook.php';
require_once './app/views/api.view.php';

class ControllerApiBook{
    private $view;
    private $modelBook;
    private $data;
    public function __construct(){
        $this->view=new ApiView ();
        $this->modelBook=new BookModel();
        $this->data = file_get_contents("php://input");
    }
    private function getBookLibrery() {
        return json_decode($this->data);
    }



    public function getBooks() {
        //ordenado por id_valoracion
        if(isset($_GET ['orderMode'])){
            if ((($_GET['orderMode'])=="asc")|| (($_GET['orderMode'])=="ASC")) {
                $books = $this->modelBook->orderAsc();
                $this->view->response($books);
            } else if ((($_GET['orderMode'])=="desc")||(($_GET['orderMode'])=="DESC")) {
                $books = $this->modelBook->orderDesc();
                $this->view->response($books);
            }
        } else{
            //sin orden(o orden predeterminado)
            $books = $this->modelBook->getLibrery();
            $this->view->response($books);
        }
    }





    public function getBook($params = null) {
        $id = $params[':ID'];
        $book = $this->modelBook->getDescrition($id);
        if ($book){
            $this->view->response($book);
        }
        else{ 
            $this->view->response("El libro con el id=$id no existe", 404);
        }
    }

    
    public function addBook() {
        $book = $this->getBookLibrery();

        if (empty($book->nombre) || empty($book->autor) || empty($book->anio) || empty($book->descripcion) || empty($book->id_genero) || empty($book->id_valoracion)) {
            $this->view->response("Complete los datos", 400);
        } 
        else {
            $id = $this->modelBook->insertBook($book->nombre, $book->autor, $book->anio, $book->descripcion, $book->id_genero, $book->id_valoracion);
            $book = $this->modelBook->getDescrition($id);
            $this->view->response($book, 201);
        }
    }
    public function deleteBook($params = null) {
        $id = $params[':ID'];

        $book = $this->modelBook->getDescrition($id);
        if ($book) {
            $this->modelBook->deleteBookById($id);
            $this->view->response("El libro con el id=$id fue eliminado", 200);
        } else{
            $this->view->response("El libro con el id=$id no existe", 404);
        }
    }
    
}