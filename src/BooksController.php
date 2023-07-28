<?php

class BooksController
{
    private $gateway;
    public function __construct($gateway)
    {
        $this->gateway = $gateway;
    }
    public function processRequest($method, $id)
    {
        if ($id) {
            $this->processResouceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResouceRequest($method, $id)
    {
        switch ($method) {
            case 'GET':
                echo json_encode($this->gateway->get($id));
                break;
            case 'PATCH':
            case 'PUT':
                $data = (array) json_decode(file_get_contents("php://input"));
                echo json_encode($this->gateway->ubdate($data));
                break;

            default:
                echo "INVALID METHOD";
                break;
        }
    }
    private function processCollectionRequest($method)
    {
        switch ($method) {
            case 'GET':
                echo json_encode($this->gateway->getAll());
                break;
            case 'POST':
                $payload = file_get_contents("php://input");
                $data = (array) json_decode($payload);
                $this->gateway->create($data);
                http_response_code(201);
                echo $payload;
                break;
            default:
                echo "INVALID METHOD";
                break;
        }
    }
}