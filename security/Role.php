<?php

class Role
{
    protected array $permissions;

    protected function __construct() {
        $this->permissions = array();
    }

    // return a role object with associated permissions
    public function getRolePerms($role_id): Role
    {
        $role = new Role();
        $conn = $GLOBALS["DB"];
        $sql = "SELECT perm_desc FROM role_perm as t1
                JOIN permissions as t2 ON t1.perm_id = t2.perm_id
                WHERE t1.role_id = $role_id;";
        //$query = "SELECT permissions.perm_desc, role_perm.perm_id, role_perm.role_id FROM role_perm JOIN permissions p on p.perm_id = role_perm.perm_id;WHERE role_id.role_perm = $role_id;";
        $result = mysqli_query($conn, $sql);

        echo 'Perms <br>';
        $num = 1;
        while($row = mysqli_fetch_array($result)) {
            $perm = $row["perm_desc"];
            echo "Permission $num: ".$perm."<br>";
            array_push($this->permissions, $perm);
            //$role->permissions[$row["perm_desc"]] = true;
            $num++;
        }
        return $role;
    }

    // check if a permission is set
    public function hasPerm($permission): bool
    {
        echo "hasPerm: ".$permission;
        return isset($this->permissions, $permission);
    }

    // insert a new role
    public static function insertRole($role_name) {
        $sql = "INSERT INTO roles (role_name) VALUES ($role_name)";
        //$sth = $GLOBALS["DB"]->prepare($sql);
        $conn = $GLOBALS["DB"];

        return mysqli_query($conn, $sql);
        //return $sth->execute(array(":role_name" => $role_name));
    }

    // insert array of roles for specified user id
    public static function insertUserRoles($user_id, $roles): bool
    {
        foreach ($roles as $role_id) {
            $sql = "INSERT INTO user_role (user_id, role_id) VALUES ($user_id, $role_id)";
            //$sth = $GLOBALS["DB"]->prepare($sql);
            //$sth->bindParam(":user_id", $user_id, PDO::PARAM_STR);
            //$sth->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            //$sth->execute();
            $conn = $GLOBALS["DB"];

            mysqli_query($conn, $sql);
            
        }
        return true;
    }

    // delete array of roles, and all associations
    public static function deleteRoles($roles): bool
    {
        
        foreach ($roles as $role_id) {
            $sql = "DELETE t1, t2, t3 FROM roles as t1
                JOIN user_role as t2 on t1.role_id = t2.role_id
                JOIN role_perm as t3 on t1.role_id = t3.role_id
                WHERE t1.role_id = $role_id";
            //$sth = $GLOBALS["DB"]->prepare($sql);
            //$sth->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            //$sth->execute();
            $conn = $GLOBALS["DB"];

            mysqli_query($conn, $sql);
        }
        return true;
    }

    // delete ALL roles for specified user id
    public static function deleteUserRoles($user_id) {
        $sql = "DELETE FROM user_role WHERE user_id = $user_id";
        //$sth = $GLOBALS["DB"]->prepare($sql);
        //return $sth->execute(array(":user_id" => $user_id));
        $conn = $GLOBALS["DB"];

        return mysqli_query($conn, $sql);
    }
}