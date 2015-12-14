<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Dog;
use AppBundle\Form\DogType;

/**
 * Dog controller.
 *
 * @Route("/dog")
 */
class DogController extends Controller
{
    /**
     * Lists all Dog entities.
     *
     * @Route("/", name="dog_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dogs = $em->getRepository('AppBundle:Dog')->findAll();

        return $this->render('dog/index.html.twig', array(
            'dogs' => $dogs,
        ));
    }

    /**
     * Creates a new Dog entity.
     *
     * @Route("/new", name="dog_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dog = new Dog();
        $form = $this->createForm(new DogType(), $dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dog);
            $em->flush();

            return $this->redirectToRoute('dog_show', array('id' => $dog->getId()));
        }

        return $this->render('dog/new.html.twig', array(
            'dog' => $dog,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Dog entity.
     *
     * @Route("/{id}", name="dog_show")
     * @Method("GET")
     */
    public function showAction(Dog $dog)
    {
        $deleteForm = $this->createDeleteForm($dog);

        return $this->render('dog/show.html.twig', array(
            'dog' => $dog,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dog entity.
     *
     * @Route("/{id}/edit", name="dog_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dog $dog)
    {
        $deleteForm = $this->createDeleteForm($dog);
        $editForm = $this->createForm(new DogType(), $dog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dog);
            $em->flush();

            return $this->redirectToRoute('dog_edit', array('id' => $dog->getId()));
        }

        return $this->render('dog/edit.html.twig', array(
            'dog' => $dog,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dog entity.
     *
     * @Route("/{id}", name="dog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dog $dog)
    {
        $form = $this->createDeleteForm($dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dog);
            $em->flush();
        }

        return $this->redirectToRoute('dog_index');
    }

    /**
     * Creates a form to delete a Dog entity.
     *
     * @param Dog $dog The Dog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dog $dog)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dog_delete', array('id' => $dog->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
