<?php

namespace mecadoapp\control;


class ListeController extends \mf\control\AbstractController {


    /* Constructeur :
     * 
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     * 
     */
    
    public function __construct(){
        parent::__construct();
    }

    public function listes(){

        $ctrl=[];
        $requete = \mecadoapp\model\Liste::select();
        $lignes = $requete  ->orderByDESC('created_at', 'DESC')
                            ->get();

        foreach ($lignes as $v)
        {
            $user = $v->user()->first();

            $tab = [$v->id, $v->text, $v->created_at, $v->author, $user['fullname']];
            $ctrl[] = $tab;
        }

        $v = new \mecadoapp\view\MecadoView($ctrl);
        $v ->render('login');

    }

    public function checkListe(){

        $nom = $this->request->post['nom'];
        $description = $this->request->post['description'];
        $date_limit = $this->request->post['date_limit'];
        $destinataire = $this->request->post['destinataire'];
        $nom_dest = $this->request->post['nom_dest'];
        $prenom_dest = $this->request->post['prenom_dest'];
        
        $v = new \mecadoapp\auth\MecadoAuthentification();
        try {
            $liste = new \mecadoapp\model\Liste();
            $liste->nom = $nom;
            $liste->description = $description;
            $liste->token = '';
            $liste->date_limit = $date_limit;
            $liste->destinataire = $destinataire;
            $liste->nom_dest  = $nom_dest;
            $liste->prenom_dest = $prenom_dest;
            $liste->save();
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            $this->signUp();
        }

    }


}
