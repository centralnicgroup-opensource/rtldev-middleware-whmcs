<?php

#declare(strict_types=1);

/**
 * HEXONET
 * Copyright © HEXONET
 */

namespace HEXONET;

/**
 * HEXONET SocketConfig
 *
 * @package HEXONET
 */

class SocketConfig
{
    /**
     * API system entity. "54cd" for LIVE system; "1234" for OT&E system
     * @var string
     */
    private $entity;
    /**
     * account name
     * @var string
     */
    private $login;
    /**
     * one time password (2FA)
     * @var string
     */
    private $otp;
    /**
     * account password
     * @var string
     */
    private $pw;
    /**
     * remote ip address (ip filter)
     * @var string
     */
    private $remoteaddr;
    /**
     * API session id
     * @var string
     */
    private $session;
    /**
     * subuser account name (subuser specific data view)
     * @var string
     */
    private $user;

    public function __construct()
    {
        $this->entity = "";
        $this->login = "";
        $this->otp = "";
        $this->pw = "";
        $this->remoteaddr = "";
        $this->session = "";
        $this->user = "";
    }

    /**
     * Create POST data string out of connection data
     * @return string POST data string
     */
    public function getPOSTData()
    {
        $data = "";
        if (strlen($this->entity)) {
            $data .= rawurlencode("s_entity") . "=" . rawurlencode($this->entity) . "&";
        }
        if (strlen($this->login)) {
            $data .= rawurlencode("s_login") . "=" . rawurlencode($this->login) . "&";
        }
        if (strlen($this->otp)) {
            $data .= rawurlencode("s_otp") . "=" . rawurlencode($this->otp) . "&";
        }
        if (strlen($this->pw)) {
            $data .= rawurlencode("s_pw") . "=" . rawurlencode($this->pw) . "&";
        }
        if (strlen($this->remoteaddr)) {
            $data .= rawurlencode("s_remoteaddr") . "=" . rawurlencode($this->remoteaddr) . "&";
        }
        if (strlen($this->session)) {
            $data .= rawurlencode("s_session") . "=" . rawurlencode($this->session) . "&";
        }
        if (strlen($this->user)) {
            $data .= rawurlencode("s_user") . "=" . rawurlencode($this->user) . "&";
        }
        return $data;
    }

    /**
     * Get API Session ID in use
     * @return string API Session ID
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Get API System Entity in use
     * @return string API System Entity
     */
    public function getSystemEntity()
    {
        return $this->entity;
    }

    /**
     * Set account name to use
     * @param string $value account name
     * @return $this
     */
    public function setLogin($value)
    {
        $this->session = "";
        $this->login = $value;
        return $this;
    }

    /**
     * Set one time password to use
     * @param string $value one time password
     * @return $this
     */
    public function setOTP($value)
    {
        $this->session = "";
        $this->otp = $value;
        return $this;
    }

    /**
     * Set account password to use
     * @param string $value account password
     * @return $this
     */
    public function setPassword($value)
    {
        $this->session = "";
        $this->pw = $value;
        return $this;
    }

    /**
     * Set Remote IP Address to use
     * @param string $value remote ip address
     * @return $this
     */
    public function setRemoteAddress($value)
    {
        $this->remoteaddr = $value;
        return $this;
    }

    /**
     * Set API Session ID to use
     * @param string $value API Session ID
     * @return $this
     */
    public function setSession($value)
    {
        $this->session = $value;
        $this->login = "";
        $this->pw = "";
        $this->otp = "";
        return $this;
    }

    /**
     * Set API System Entity to use
     * This is set to 54cd / LIVE System by default
     * @param string $value API System Entity
     * @return $this
     */
    public function setSystemEntity($value)
    {
        $this->entity = $value;
        return $this;
    }

    /**
     * Set subuser account name (for subuser data view)
     * @param string $value subuser account name
     * @return $this
     */
    public function setUser($value)
    {
        $this->user = $value;
        return $this;
    }
}
