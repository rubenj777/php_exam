<?php

namespace Controllers;

class Avis extends AbstractController
{
    protected $defaultModelName = \Models\Avis::class;

    /**
     * vérifie que tous les champs du formulaire sont bien remplis
     * cherche un vélo par son id et vérifie que l'id existe bien
     * si tout est ok, fait appel à la méthode save() pour insérer l'avis dans la bdd
     * @return Response
     */
    public function new()
    {
        $id = null;
        $author = null;
        $content = null;

        if (!empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $author = htmlspecialchars($_POST['author']);
            $content = htmlspecialchars($_POST['content']);
            $id = $_POST['id'];
        }

        if (!$id || !$content || !$author) {
            return $this->redirect(['type' => 'velo', 'action' => 'index', 'info' => 'noId']);
        }

        $this->typeVelo = new \Models\Velo();
        $velo = $this->typeVelo->findById($id);

        if (!$velo) {
            return $this->redirect(['type' => 'velo', 'action' => 'index', 'info' => 'noId']);
        }

        $avis = new \Models\Avis();
        $avis->setAuthor($author);
        $avis->setContent($content);
        $avis->setVeloId($id);

        $this->defaultModel->save($avis);

        return $this->redirect(['type' => 'velo', 'action' => 'show', 'id' => $velo->getId()]);
    }

    /**
     * cherche l'id de l'avis
     * si un id a été trouvé, fait appel à la méthode remove($id) pour supprimer l'avis de la bdd
     * @return Response
     */
    public function delete()
    {
        $id = null;

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }

        if (!$id) {
            die("Erreur");
        }

        $avis = $this->defaultModel->findById($id);

        if (!$avis) {
            return $this->redirect(['type' => 'velo', 'action' => 'index', 'info' => 'noId']);
        }

        $this->defaultModel->remove($id);

        return $this->redirect(['type' => 'velo', 'action' => 'show', 'id' => $avis->getVeloId()]);
    }

    /**
     * récupère l'id de l'avis pour retrouver le bon avis
     * récupère les données du formulaire puis fait appel à la fonction update() qui enregistre l'avis modifié dans la bdd
     * je ne parviens pas à récupérer l'id du vélo dans le redirect
     */
    public function edit()
    {
        $pageTitle = "Modifier l'avis";
        $id = null;
        $avis = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        if ($id) {
            $avis = $this->defaultModel->findById($id);
        }

        $author = null;
        $content = null;
        $idToEdit = null;

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $idToEdit = $_POST['id'];
        }


        if (!empty($_POST['author']) && !empty($_POST['content'])) {
            $author = htmlspecialchars($_POST['author']);
            $content = htmlspecialchars($_POST['content']);
        }



        if ($author && $content && $idToEdit) {

            $this->defaultModel->update($author, $content, $idToEdit);

            return $this->redirect([
                'type' => 'velo',
                'action' => 'show',
                'id' => $avis->getVeloId()
            ]);
        }
        return $this->render('avis/edit', ['pageTitle' => $pageTitle, 'avis' => $avis]);
    }
}
