<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function esim_activate($table, $Activation_code)
    {
        $Activation_code= $this->prepareData($Activation_code);
        $this->sql = "select * from " . $table . " where Activation_code = '" . $Activation_code . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbActivation_code = $row['Activation_code'];
            if ($dbActivation_code == $Activation_code) {
                $status = true;
            } else $status = false;
        } else $status = false;

        return $status;
    }


    function activate_sim($table)
    {
        $this->sql = "UPDATE " . $table . " SET status = '1' WHERE status = '0'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    function get_profile($table,$profile_name,$iccid,$imsi,$mno)
    {
        $profile_name = $this->prepareData($profile_name);
        $iccid = $this->prepareData($iccid);
        $imsi = $this->prepareData($imsi);
        $mno = $this->prepareData($mno);
        $this->sql = "select * from " . $table . " where profile_name = '" . $profile_name . "' and iccid = '" . $iccid . "' and imsi = '" . $imsi . "' and mno = '" . $mno . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbprofile_name = $row['profile_name'];
            $dbiccid = $row['iccid'];
            $dbimsi = $row['imsi'];
            $dbmno = $row['mno'];
            if ($dbprofile_name == $profile_name && $dbiccid == $iccid && $dbimsi == $imsi && $dbmno == $mno) {
                $status = true;
            } else $status = false;
        } else $status = false;

        return $status;
    } 

}

?>
