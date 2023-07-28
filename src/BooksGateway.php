<?php

class BooksGateway
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT *
                FROM books";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $data[] = $row;
        }

        return $data;
    }
    public function get($isbn)
    {
        $sql = "SELECT *
                FROM books WHERE isbn = $isbn";

        $stmt = $this->conn->query($sql);

        $data = (object) [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $data = $row;
        }

        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO books(title, subtitle, isbn, abstract, numPages, author, publisher, price, cover) 
        VALUES (:title, :subtitle, :isbn, :abstract, :numPages, :author, :publisher, :price, :cover)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
        $stmt->bindValue(":subtitle", $data["subtitle"], PDO::PARAM_STR);
        $stmt->bindValue(":isbn", $data["isbn"], PDO::PARAM_STR);
        $stmt->bindValue(":abstract", $data["abstract"], PDO::PARAM_STR);
        $stmt->bindValue(":numPages", $data["numPages"], PDO::PARAM_INT);
        $stmt->bindValue(":author", $data["author"], PDO::PARAM_STR);
        $stmt->bindValue(":publisher", $data["publisher"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data["price"], PDO::PARAM_STR);
        $stmt->bindValue(":cover", $data["cover"], PDO::PARAM_STR);

        $stmt->execute();

        return $this->get($data['isbn']);
    }
    public function ubdate($data)
    {
        $sql = "SELECT *
                FROM books WHERE isbn = " . $data["isbn"];

        $stmt_ = $this->conn->query($sql);

        $datadb = (object) [];

        while ($row = $stmt_->fetch(PDO::FETCH_ASSOC)) {


            $datadb = $row;
        }

        $mergedData = array_merge((array) $datadb, (array) $data);
        var_dump($mergedData);
        $sql = "UPDATE books SET 
        title = :title, 
        subtitle = :subtitle, 
        abstract = :abstract, 
        numPages = :numPages, 
        author = :author, 
        publisher = :publisher, 
        price = :price, 
        cover = :cover
        WHERE isbn = :isbn";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $mergedData["title"], PDO::PARAM_STR);
        $stmt->bindValue(":subtitle", $mergedData["subtitle"], PDO::PARAM_STR);
        $stmt->bindValue(":isbn", $mergedData["isbn"], PDO::PARAM_STR);
        $stmt->bindValue(":abstract", $mergedData["abstract"], PDO::PARAM_STR);
        $stmt->bindValue(":numPages", $mergedData["numPages"], PDO::PARAM_INT);
        $stmt->bindValue(":author", $mergedData["author"], PDO::PARAM_STR);
        $stmt->bindValue(":publisher", $mergedData["publisher"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $mergedData["price"], PDO::PARAM_STR);
        $stmt->bindValue(":cover", $mergedData["cover"], PDO::PARAM_STR);

        $stmt->execute();


        return $mergedData;
    }

}