<?php

namespace WebPay\Api;

use WebPay\Model\Charge;
use WebPay\Model\EntityList;

class Charges {

    /** @var WebPay */
    private $client;

    /**
     * @param WebPay $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Create a charge
     *
     * @param array $params
     * @return Charge
     */
    public function create(array $params)
    {
        return new Charge($this->client, $this->client->request('charges.create', $params));
    }

    /**
     * Retrieve an existing charge
     *
     * @param string $id
     * @return Charge
     */
    public function retrieve($id)
    {
        return new Charge($this->client, $this->client->request('charges.retrieve', array('id' => $id)));
    }

    /**
     * Get a list of existing charges
     *
     * @param array $params
     * @return EntityList
     */
    public function all(array $params)
    {
        return new EntityList($this->client, $this->client->request('charges.all', $params));
    }

    /**
     * Refund the charge specified by id
     *
     * @param string  $id     The charge to refund
     * @param integer $amount Amount to refund. Default is all.
     * @return Charge
     */
    public function refund($id, $amount = null)
    {
        if (is_null($amount)) {
            $param = array('id' => $id);
        } else {
            $param = array('id' => $id, 'amount' => $amount);
        }
        return new Charge($this->client, $this->client->request('charges.refund', $param));
    }
}
