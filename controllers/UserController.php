<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../models/UserModel.php");

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new UserModel($this->db);
    }

    public function index()
    {
        $result = $this->user->getAll();
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/user/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->user->name = $_POST['name'];
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];
            $this->user->role = $_POST['role'];
            $this->user->email = $_POST['email'];

            if ($this->user->create()) {
                header("Location: ../user/user.php");
                exit();
            }
        }
        include(dirname(__FILE__) . '/../views/user/create.php');
    }

    public function edit($id)
    {
        $this->user->user_id = $id;
        $this->user->getById();

        if ($_POST) {
            $this->user->name = $_POST['name'];
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];
            $this->user->role = $_POST['role'];
            $this->user->email = $_POST['email'];

            if ($this->user->update()) {
                header("Location: ../user/user.php");
                exit();
            }
        }
        $users = $this->user;
        include(dirname(__FILE__) . '/../views/user/update.php');
    }

    public function delete($id)
    {
        $this->user->user_id = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->user->delete()) {
                    header("Location: ../user/user.php");
                    exit();
                }
            } else {
                header("Location: ../user/user.php");
                exit();
            }
        }

        $this->user->getById();
        $user = $this->user;

        include(dirname(__FILE__) . '/../views/user/delete.php');
    }
}
?>
