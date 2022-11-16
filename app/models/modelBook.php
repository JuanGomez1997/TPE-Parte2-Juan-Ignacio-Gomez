<?php
    class BookModel{
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_biblioteca;charset=utf8', 'root', '');
        }
        public function getLibrery(){
            $query = $this->db->prepare("SELECT * FROM libros JOIN genero ON libros.id_genero=genero.id_genero JOIN valoraciones ON libros.id_valoracion=valoraciones.id_valoracion");
            $query->execute();
            $books = $query->fetchAll(PDO::FETCH_OBJ);
            return $books;
        }
        public function getDescrition($id){
            $query = $this->db->prepare("SELECT * FROM libros JOIN genero ON libros.id_genero=genero.id_genero JOIN valoraciones ON libros.id_valoracion=valoraciones.id_valoracion WHERE id=?");
            $query->execute([$id]);
            $books = $query->fetchAll(PDO::FETCH_OBJ);
            return $books;
        }



        public function orderAsc(){
            $query = $this->db->prepare("SELECT * FROM libros JOIN genero ON libros.id_genero=genero.id_genero JOIN valoraciones ON libros.id_valoracion=valoraciones.id_valoracion ORDER BY libros.id_valoracion ASC ");
            $query->execute();
            $books = $query->fetchAll(PDO::FETCH_OBJ);
            return $books;
        }
        public function orderDesc(){
            $query = $this->db->prepare("SELECT * FROM libros JOIN genero ON libros.id_genero=genero.id_genero JOIN valoraciones ON libros.id_valoracion=valoraciones.id_valoracion ORDER BY libros.id_valoracion DESC");
            $query->execute();
            $books = $query->fetchAll(PDO::FETCH_OBJ);
            return $books;
        }

  
        public function insertBook($name, $author, $year, $description, $id_genre,$id_assessment){
            $query=$this->db->prepare("INSERT INTO libros (nombre, autor, anio, descripcion, id_genero, id_valoracion, disponibilidad) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->execute([$name, $author, $year, $description, $id_genre, $id_assessment, true]);
            return $this->db->lastInsertId();
        }
        public function deleteBookById($id){
            $query = $this->db->prepare('DELETE FROM libros WHERE id = ?');
            $query->execute([$id]);
        }

        


    }