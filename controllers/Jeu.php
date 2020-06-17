<?php

class Jeu extends Controller{
    private $RepMgr;
    private $nbreQ;
    private $actuQ;
    private $tabQuestion;
    private $tabReponse;
    private $partie;
    public static $i = 0;
    public function __construct(){
        parent::__construct();
        $this->folder_view="jeu";
        $this->layout="layoutJeu";
        $this->view="partie";
        extract($this->data_view);

        $this->manager = new MQuestionManager();
        $this->repMgr = new ReponseManager();
        $this->partieMgr = new PartieManager();

        $this->tabQuestion = $this->manager->findAll();
        $this->tabReponse = $this->repMgr->findAll();
        $this->partie = $this->partieMgr->findAll();

        $this->nbreQ = $this->partie[0]->nbreQuestions;
        $this->data_view['nbreQ'] = $this->nbreQ;
    }

      


    

    public function jouer()
    {
        $this->data_view['actuPoints'] = 0;
        $this->data_view['i'] = Jeu::$i+1;
        $this->data_view['actuQ'] = $this->tabQuestion[Jeu::$i];
        $this->data_view['tabReponse']= $this->repMgr->findObject($this->tabQuestion[Jeu::$i]->id);
        $this->render();
    }
    public function suivant()
    {
        if (isset($_POST['btnSuivant'])) 
        {
            $i = rand(1,count($this->tabQuestion)-1);
            $this->data_view['actuPoints'] = $_POST['nP'];
            $this->data_view['i'] =$_POST['nQ']+1;
            $this->data_view['actuQ'] = $this->tabQuestion[$i];
            $this->data_view['tabReponse']= $this->repMgr->findObject($this->tabQuestion[$i]->id);
            $this->render();
        }
        else
        {
            $sC = 0;
            for ($i=0; $i < strlen($_POST['nP']); $i++) { 
                # code...
                $sC += (int)substr($_POST['nP'],$i,1);
            }
            //récap
            if ($sC > $_SESSION['userConnected']->score) {
                $userMgr = new UserManager();
                $userMgr->updateScore($_SESSION['userConnected']->id,$sC);

            }
            $this->data_view['sC'] = $sC;
            $this->view="recap";
            $this->render();
        }
    }
    

}