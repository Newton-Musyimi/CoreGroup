<?php
class PrivilegedUser extends Role
{
    private $roles;
    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed
     */
    private $username;
    /**
     * @var mixed
     */
    private $password;

    public function __construct() {
        parent::__construct();
    }

    // override User method
    public static function getByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $conn = $GLOBALS["DB"];
        //$query = "SELECT `user_id`, `username`, `user_type`, `password` FROM `users` WHERE `username` = $username;";
        $result = mysqli_query($conn, $sql) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);

        if ($row = mysqli_fetch_array($result)) {
            $privUser = new PrivilegedUser();
            $privUser->user_id = $row["user_id"];
            $privUser->username = $row["username"];
            $privUser->password = $row["password"];
            $privUser->initRoles();
            return $privUser;
        } else {
            return false;
        }
    }

    // populate roles with their associated permissions
    protected function initRoles() {
        $this->roles = array();
        $user_id = $this->user_id;
        $sql = "SELECT t1.role_id, t2.role_name FROM user_role as t1
                JOIN roles as t2 ON t1.role_id = t2.role_id
                WHERE t1.user_id = $user_id";
        $conn = $GLOBALS["DB"];
        $result = mysqli_query($conn, $sql);
        //$sth->execute(array(":user_id" => $this->user_id));

        $row = mysqli_fetch_array($result);
        $role_name = $row["role_name"];
        $role_id = $row["role_id"];
        array_push($this->roles, $role_name);
        $this->getRolePerms($role_id);

        //$this->roles = $this->roles[$role_name] = Role::getRolePerms($row["role_id"]);
    }

    // check if user has a specific privilege
    public function hasPrivilege($perm): bool
    {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($perm)) {
                return true;
            }
        }
        return false;
    }
    // check if a user has a specific role
    public function hasRole($role_name): bool
    {
        return isset($this->roles[$role_name]);
    }

    // insert a new role permission association
    public static function insertPerm($role_id, $perm_id) {
        $sql = "INSERT INTO role_perm (role_id, perm_id) VALUES ($role_id, $perm_id)";
        //$sth = $GLOBALS["DB"]->prepare($sql);
        $conn = $GLOBALS["DB"];

        return mysqli_query($conn, $sql);
    }

    // delete ALL role permissions
    public static function deletePerms() {
        $sql = "TRUNCATE role_perm";
        //$sth = $GLOBALS["DB"]->prepare($sql);
        $conn = $GLOBALS["DB"];

        return mysqli_query($conn, $sql);
    }

    public function getRoleId(){
        $username = $this->username;
        $conn = $GLOBALS["DB"];
        $sql = "SELECT role_id FROM users as t1
                JOIN user_role as t2 ON t1.user_id = t2.user_id
                WHERE t1.username = '$username';";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_array($result);
        return $row['role_id'];
    }

    public function checkPermission($check){
        $perms = $this->permissions;
        echo "hasPerm: ".$check."<br>";
        return isset($perms, $check);
    }
}