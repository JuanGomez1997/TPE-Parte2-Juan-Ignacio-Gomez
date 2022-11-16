<?php
    class AssessmentModel{
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_biblioteca;charset=utf8', 'root', '');
        }
        public function getLibreryAssessment(){
            $query = $this->db->prepare("SELECT * FROM valoraciones");
            $query->execute();
            $assessment = $query->fetchAll(PDO::FETCH_OBJ);
            return $assessment;
        }
        public function getAssessmentById($id){
            $query = $this->db->prepare("SELECT * FROM libros JOIN genero ON libros.id_genero=genero.id_genero JOIN valoraciones ON libros.id_valoracion=valoraciones.id_valoracion WHERE valoraciones.id_valoracion=?");
            $query->execute([$id]);
            $assessment = $query->fetchAll(PDO::FETCH_OBJ);
            return $assessment;
        }
        public function insertAssessment($assessment){
            $query=$this->db->prepare("INSERT INTO valoraciones (valoracion) VALUES (?)");
            $query->execute([$assessment]);
            return $this->db->lastInsertId();
        }
        public function editAssessmentById($assessment,$id_assessment){
            $query = $this->db->prepare("UPDATE valoraciones SET valoracion=? WHERE (valoraciones.id_valoracion=?)");
            $query->execute([$assessment,$id_assessment]);
            
        }

       
    }