<?php

class addressBook
{
    protected $con;
    protected $config;
    public $ID;
    public $firstName;
    public $lastName;
    public $eMail;
    public $joined;
    public $optOut;

    function __construct()
    {
        $this->config = parse_ini_file('config.ini');
        $this->con = new PDO($this->config['host'].$this->config['db'],
                            $this->config['un'],
                            $this->config['pw']);
    }

    public function error()
    {
        if (!$sth)
        {
            echo "\nPDO::errorinfo():\n";
            print_r($this->con->errorInfo());
            die();
        }
    }

    function columnNames()
    {

        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_SCHEMA = 'mailman' AND TABLE_NAME = 'addressBook'";
        $sth = $this->con->prepare($sql);
        $sth->execute(array());
        $columnName = $sth->fetchAll(PDO::FETCH_COLUMN);
        return ($columnName);
    }

    public function setValue($key, $value){
        $this->$key = $value;
    }

    public function fetch()
    {
        $sql = "SELECT * FROM addressBook";
        $sth = $this->con->prepare($sql);
        $sth->execute(array());
        $all = $sth->fetchAll(PDO::FETCH_ASSOC);
        print_r($all);
    }

    public function fetchByID()
    {
        $sql = "SELECT * FROM addressBook WHERE ID =36";
        $sth = $this->con->prepare($sql);
        $sth->execute(array());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            print_r($row);
          //  $this->setID($row);
        }
    }

    public function add()
    {
        $sql = "INSERT INTO addressBook 
                (
                    firstName, 
                    lastName, 
                    eMail, 
                    optOut
                    ) 
                VALUES 
                (
                    ?,
                    ?,
                    ?,
                    ?
                )";
        $sth = $this->con->prepare($sql);
        $sth->bindParam(1, $this->firstName, PDO::PARAM_STR);
        $sth->bindParam(2, $this->lastName, PDO::PARAM_STR);
        $sth->bindParam(3, $this->eMail, PDO::PARAM_STR);
        $sth->bindParam(4, $this->optOut, PDO::PARAM_INT);
        $sth->execute();
        $error = new error();
    }

    /**
     * @return PDO
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * @param PDO $con
     */
    public function setCon($con)
    {
        $this->con = $con;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * @param mixed $eMail
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;
    }

    /**
     * @return mixed
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * @param mixed $joined
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;
    }

    /**
     * @return mixed
     */
    public function getOptOut()
    {
        return $this->optOut;
    }

    /**
     * @param mixed $optOut
     */
    public function setOptOut($optOut)
    {
        $this->optOut = $optOut;
    }


}
