<?php

namespace ECommerceBundle\Controller;

use ECommerceBundle\Entity\Claim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Claim controller.
 *
 */
class ClaimController extends Controller
{
    /**
     * Lists all claim entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $claims = $em->getRepository('ECommerceBundle:Claim')->findAll();

        return $this->render('ECommerceBundle:claim:index.html.twig', array(
            'claims' => $claims,
        ));
    }

    /**
     * Creates a new claim entity.
     *
     */
    public function newAction(Request $request)
    {
        $claim = new Claim();
        $form = $this->createForm('ECommerceBundle\Form\ClaimType', $claim);
        $form->handleRequest($request);
        $content = $request->getContent();
        $claim->setClient($this->getUser());
        $data = json_decode($content, true);


        if ($data["ajax"] == "true") {
            $claim->setDescription($data["message"]);
            $claim->setType($data["type"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($claim);
            $em->flush($claim);
            $twilio = $this->get('twilio.api');

            $message = $twilio->account->messages->sendMessage(
                '+19283230909 ', // From a Twilio number in your account
                '+21626879552', // Text any number
                "New claim From " . $this->getUser()
        );


        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($claim);
            $em->flush($claim);

            return $this->redirectToRoute('claim_show', array('id' => $claim->getId()));
        }

        return $this->render('ECommerceBundle:claim:new.html.twig', array(
            'claim' => $claim,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a claim entity.
     *
     */
    public function showAction(Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);

        return $this->render('ECommerceBundle:claim:show.html.twig', array(
            'claim' => $claim,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing claim entity.
     *
     */
    public function editAction(Request $request, Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);
        $editForm = $this->createForm('ECommerceBundle\Form\ClaimType', $claim);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('claim_edit', array('id' => $claim->getId()));
        }

        return $this->render('ECommerceBundle:claim:edit.html.twig', array(
            'claim' => $claim,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a claim entity.
     *
     */
    public function deleteAction(Request $request, Claim $claim)
    {
        $form = $this->createDeleteForm($claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($claim);
            $em->flush($claim);
        }

        return $this->redirectToRoute('claim_index');
    }

    /**
     * Creates a form to delete a claim entity.
     *
     * @param Claim $claim The claim entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Claim $claim)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('claim_delete', array('id' => $claim->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
