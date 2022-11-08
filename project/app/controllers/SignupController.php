<?php

use Phalcon\Mvc\Controller;


class SignupController extends Controller
{
    public function indexAction()
    {

    }

    public function registerAction()
    {
        $user = new User();

        $user->name = $this->request->getPost('name') ;
        $user->email = $this->request->getPost('email') ;
        // Store and check for errors
        $success = $user->save();

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }


    // route => /signup/register
    public function UserAction()
    {
        $users = User::find();
        // all users in the database table User will be returned as an array of User objects
        // (or an empty array if no users are found)

        foreach ($users as $user) {
            echo 'id: ', $user->id, ' ';
            echo "name: ", $user->name, " ";
            echo "email: ", $user->email, "<br/>";
        }

        // $user = User::findById(1); // the user with id 1 will be returned as a User object
        // $user = User::findFirstByName('Peter'); // the first user with name Peter will be returned as a User object
        // $user = User::findFirstByName('Peter', 'id > 10'); // the first user with name Peter and id > 10 will be returned as a User object
        // $user = User::findFirstByName('Peter', 'id > 10', 'id DESC'); // the first user with name Peter and id > 10 will be returned as a User object, ordered by id DESC
        // tu peux custom facilement tes requetes avec des conditions et des tris
        // en utilisant les methodes de la classe Phalcon\Mvc\Model\Query\Builder
    }
}