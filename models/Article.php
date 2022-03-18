<?php
class Article extends Model{

    public function __construct()
    {
        // die(var_dump(5));
        // Nous définissons la table par défaut de ce modèle
        $this->table = "posts";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    /**
     * Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */
    public function findId(string $slug){
        // die(var_dump($this->table));
        $sql = "SELECT * FROM ".$this->table." WHERE `id`='".$slug."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);    
    }
    public function AddOne($data){
      
        // die(var_dump($data->category_id)); 
     $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';
     $stmt = $this->_connexion->prepare($query);
    //  ext
    // bind prams 
        $stmt->bindParam(':title', $data->title);
        $stmt->bindParam(':body', $data->body);
        $stmt->bindParam(':author', $data->author);
        $stmt->bindParam(':category_id', $data->category_id);
   if(  $stmt->execute())
   {
       return 'ok';

   }
    

    }
    public function Update($data,$id) {
        $query = "UPDATE  $this->table 
    SET title = :title, body = :body, author = :author, category_id = :category_id
    WHERE id = $id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':title', $data->title);
        $stmt->bindParam(':body', $data->body);
        $stmt->bindParam(':author', $data->author);
        $stmt->bindParam(':category_id', $data->category_id);
        

        // Execute query
        if ($stmt->execute()) {
            return true;
            // die(var_dump('yes'));
        }
    }
    public function Delete($id)
    {
        $query = "DELETE FROM  $this->table   WHERE id = $id";

        $stmt = $this->_connexion->prepare($query);
        if ($stmt->execute()) {
            return true;
        }
    }

}