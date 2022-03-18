<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Articles extends Controller
{
    /**
     * Cette méthode affiche la liste des articles
     *
     * @return void
     */
    public function index()
    {
        // On instancie le modèle "Article"
        $this->loadModel('Article');

        // On stocke la liste des articles dans $articles
        $articles = $this->Article->getAll();
        // die(var_dump($articles));

        echo json_encode($articles);
        // No Posts


        // die (var_dump($articles));

        // On envoie les données à la vue index
        // die(var_dump(compact('articles')));
        $this->render('index', compact('articles'));
    }

    /**
     * Méthode permettant d'afficher un article à partir de son slug
     *
     * @param string $slug
     * @return void
     */
    public function lire(string $slug)
    {
        // On instancie le modèle "Article"
        // die(var_dump($slug));
        $this->loadModel('Article');

        // On stocke l'article dans $article
        $article = $this->Article->findId($slug);

        // On envoie les données à la vue lire
        $this->render('lire', compact('article'));
    }
    public function addArticle()
    {
        $this->loadModel('Article');

        $data = json_decode(file_get_contents("php://input"));
        // $article = new Article();
        // $book = json_decode($data, true);
        // die(print_r($book));
        // echo   $data->title;
        // die();
        // die(var_dump($article));
        // die(print_r($data));
        // die(var_dump($this->Article));

        // extract($data);
       

        $addArticle = $this->Article->AddOne($data);
        if ( $addArticle === "ok")
        {
            echo 'article added binjah';
        }
    }

    public function updateArticle($id)
    {
        // die(var_dump($id));
        $this->loadModel('Article');

        $data = json_decode(file_get_contents("php://input"));
// die(var_dump($data));
        $res = $this->Article->Update($data,$id);
        if ($res) {
            echo 'article update binjah';
        }
    }
    public function deleteArticle($id)
    {

        $this->loadModel('Article');

        $res = $this->Article->Delete($id);
        if ($res) {
            echo 'article delet binjah';
        }
    }
}
