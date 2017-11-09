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
        $lignes = $requete  ->orderByDESC('date_limite', 'DESC')
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
        $destinataire = $this->request->post['destinataire'];
        $nom_dest = $this->request->post['nom_dest'];
        $prenom_dest = $this->request->post['prenom_dest'];
        $date_limit = $this->request->post['date_limit'];

        $v = new \mecadoapp\auth\MecadoAuthentification();
        try {

            if (!isset($nom) || $nom == null){
                throw new \mf\auth\exception\AuthentificationException("Le nom doit être renseigné");
            }

            if (!isset($description) || $description == null){
                throw new \mf\auth\exception\AuthentificationException("La description doit être renseigné");
            }

            if (!isset($date_limit) || $date_limit == null){
                throw new \mf\auth\exception\AuthentificationException("Une date limite doit être renseigné");
            }

            $match='^[0-3][0-9]\/[0-1][0-9]\/[0-9]{4}$^';
            if(!preg_match($match,$date_limit)){
                throw new \mf\auth\exception\AuthentificationException("Le format de date n'est pas bon");
            }

            $date_limit = \DateTime::createFromFormat('d/m/Y', $date_limit);

            if(isset($this->request->post['id']))
            {
                $requete = \mecadoapp\model\Liste::where('id', '=', $this->request->post['id']);
                $liste = $requete->first();
            }
            else
                $liste = new \mecadoapp\model\Liste();

            $liste->nom = $nom;
            $liste->description = $description;

            if(!isset($liste->token))
                $liste->token = password_hash($nom.uniqid(), PASSWORD_DEFAULT);

            $liste->destinataire = $destinataire;

            if($destinataire == 1)
            {
                $liste->nom_dest = $userreq->nom;
                $liste->prenom_dest = $userreq->prenom;
            }
            else
            {
                $liste->nom_dest  = $nom_dest;
                $liste->prenom_dest = $prenom_dest;           
            }
            $liste->date_limite = $date_limit;
            $liste->id_user = $userreq->id;
            $liste->save();
            $this->listes();
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            $v = new \mecadoapp\view\MecadoView($e->getMessage());
            $v ->render('addListe');   
        }

    }

    public function suprListe() {

        $requete = \mecadoapp\model\Liste::where('id', '=', $this->request->get['id']);
        $liste = $requete->first();

        $liste->delete();

        $this->listes();
    }

    public function consulte() {

        $ctrl=[];
        $requete = \mecadoapp\model\Item::select()->where('id_liste', '=', $this->request->get['id']);
        $lignes = $requete  ->orderByDESC('created_at', 'DESC')
                            ->get();

        foreach ($lignes as $v)
        {

            $ctrl[] = $v;
        }

        $v = new \mecadoapp\view\MecadoView($ctrl);
        $v ->render('consulte');
    }    


}
