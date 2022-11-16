<?php
    class GenreBookModel{
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_biblioteca;charset=utf8', 'root', '');
        }

        public function getLibreryGenre(){
            $query = $this->db->prepare("SELECT * FROM genero");
            $query->execute();
            $genre = $query->fetchAll(PDO::FETCH_OBJ);
            return $genre;
        }
        public function getGenreById($id){
            $query = $this->db->prepare("SELECT * FROM libros JOIN genero ON libros.id_genero=genero.id_genero JOIN valoraciones ON libros.id_valoracion=valoraciones.id_valoracion WHERE genero.id_genero=?");
            $query->execute([$id]);
            $genre = $query->fetchAll(PDO::FETCH_OBJ);
            return $genre;
        }


        
        
    }