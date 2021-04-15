<?php

include './application/connection/DatabaseConnection.php';

class Controller_Main extends Controller
{
	private $db;

	function __construct()
	{
		parent::__construct();
		$this->db = new DatabaseConnection("127.0.0.1", "card_game", "kmospan", "password");
	}

	function action_index()
	{
		if (!isset($_SESSION['user'])) {
			header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/main/login');
			return;
		}

		$this->view->render('main_view.php', 'template_view.php', ['username' => $_SESSION['user']]);
	}

	function action_login()
	{
		if (isset($_SESSION['user'])) {
			header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/');
			return;
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
			$dbContext = $this->db->getContext();

			$dbUser = $dbContext->users->getUserByEmail($_POST['email']);

			if ($dbUser == null) {

				array_push($this->view->viewBag["errors"], 'User is not found');
				$this->view->render('login_view.php', 'template_view.php');

				return;
			}

			if ($dbUser->password != $_POST['password']) {

				array_push($this->view->viewBag["errors"], 'Invalid Password');
				$this->view->render('login_view.php', 'template_view.php');

				return;
			}

			$_SESSION['user'] = $dbUser->toArray();

			header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/');
			$this->view->render('main_view.php', 'template_view.php');
			return;
		}

		$this->view->viewBag['title'] = "Login";
		$this->view->render('login_view.php', 'template_view.php');
	}

	function action_register()
	{
		if (isset($_SESSION['user'])) {
			header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/');
			return;
		}

		if (
			$_SERVER["REQUEST_METHOD"] == "POST"
			&& isset($_POST['username'])
			&& isset($_POST['email'])
			&& isset($_POST['password'])
		) {

			$dbContext = $this->db->getContext();

			if (
				$dbContext->users->contains('username', $_POST['username'])
				||  $dbContext->users->contains('email', $_POST['email'])
			) {
				array_push($this->view->viewBag["errors"], 'User with this username or email is already exists');
				$this->view->render('register_view.php', 'template_view.php');

				return;
			}


			$newUser = new UserModel(null, $_POST['username'], $_POST['email'], $_POST['password']);

			$dbContext->users->insert($newUser);

			$_SESSION['user'] = $newUser->toArray();

			header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/');
			$this->view->render('main_view.php', 'template_view.php');

			return;
		}

		$this->view->viewBag['title'] = "Register";
		$this->view->render('register_view.php', 'template_view.php');
	}

	function action_logout()
	{
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);

			header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/main/login');
		}
	}
}
