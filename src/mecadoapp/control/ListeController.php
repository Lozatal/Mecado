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

        $user = new \mecadoapp\auth\MecadoAuthentification();
        $requete = \mecadoapp\model\User::where('mail', '=', $user->user_login);
        $userreq = $requete->first();

        $ctrl=[];
        $requete = \mecadoapp\model\Liste::select()->where('id_user', '=', $userreq->id);
        $lignes = $requete  ->orderByDESC('created_at', 'DESC')
                            ->get();

        foreach ($lignes as $v)
        {

            $ctrl[] = $v;
        }

        $v = new \mecadoapp\view\MecadoView($ctrl);
        $v ->render('listes');

    }

    public function addListe() {

        $v = new \mecadoapp\view\MecadoView(null);
        $v ->render('addListe');    
    }

    public function checkListe(){

        $user = new \mecadoapp\auth\MecadoAuthentification();
        $requete = \mecadoapp\model\User::where('mail', '=', $user->user_login);
        $userreq = $requete->first();

        $nom = $this->request->post['nom'];
        $description = $this->request->post['description'];
        if(isset($this->request->post['destinataire']))
            $destinataire = 1;
        else
            $destinataire = 0;
        $nom_dest = $this->request->post['nom_dest'];
        $prenom_dest = $this->request->post['prenom_dest'];
        $date_limit = date_create($this->request->post['date_limit']);
        
        $v = new \mecadoapp\auth\MecadoAuthentification();
        try {
            if(isset($this->request->post['id']))
            {
                $requete = \mecadoapp\model\Liste::where('id', '=', $this->request->post['id']);
                $liste = $requete->first();
            }
            else
                $liste = new \mecadoapp\model\Liste();
            $liste->nom = $nom;
            $liste->description = $description;
            $liste->token = '';
            $liste->destinataire = $destinataire;
            $liste->nom_dest  = $nom_dest;
            $liste->prenom_dest = $prenom_dest;
            $liste->date_limite = $date_limit;
            $liste->id_user = $userreq->id;
            $liste->save();
            $this->listes();
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            $v = new \mecadoapp\view\MecadoView(null);
            $this->addListe();
        }

    }


}
