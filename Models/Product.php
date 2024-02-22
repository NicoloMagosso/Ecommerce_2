<?php
require_once '../Connection/DbManager.php';

class Product
{
    private $id;

    private $nome;

    private $prezzo;

    private $marca;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public static function Find($id)
    {
        $pdo = self::Connect();
        $stmt = $pdo->prepare("select * from nicolo_magosso_ecommerce.products where id = :id");
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return $stmt->fetchObject("Product");
        } else {
            return false;
        }
    }

    public static function Create($params)
    {
        $pdo = self::Connect();
        $stmt = $pdo->prepare("insert into nicolo_magosso_ecommerce.products (nome, prezzo, marca) values (:nome, :prezzo, :marca)");
        $stmt->bindParam(":nome", $params["nome"]);
        $stmt->bindParam(":prezzo", $params["prezzo"]);
        $stmt->bindParam(":marca", $params["marca"]);
        if ($stmt->execute()) {
            $stmt = $pdo->prepare("select * from nicolo_magosso_ecommerce.products order by id desc limit 1");
            $stmt->execute();
            return $stmt->fetchObject("Product");
        } else {
            throw new PDOException("Errore nella creazione!");
        }
    }

    public function Delete()
    {
        if (!$this->id) {
            return false;
        }
        $pdo = self::Connect();

        //Elimina il prodotto dalla tabella products
        $stmt = $pdo->prepare("delete from nicolo_magosso_ecommerce.products where id=:id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return true;
    }

    public function Update($params)
    {
        $pdo = self::Connect();
        $stmt = $pdo->prepare("update nicolo_magosso_ecommerce.products set nome = :nome, prezzo = :prezzo, marca = :marca WHERE id = :id");
        $stmt->bindParam(":nome", $params['nome']);
        $stmt->bindParam(":prezzo", $params['prezzo']);
        $stmt->bindParam(":marca", $params['marca']);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            $stmt = $pdo->prepare("select * from nicolo_magosso_ecommerce.products where id=:id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return $stmt->fetchObject("Product");
        } else {
            throw new PDOException("Errore nella modifica!");
        }
    }


    public static function FetchAll()
    {
        $pdo = self::Connect();
        $stmt = $pdo->query("select * from nicolo_magosso_ecommerce.products");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function Connect()
    {
        return DbManager::Connect("nicolo_magosso_ecommerce");
    }
}

?>