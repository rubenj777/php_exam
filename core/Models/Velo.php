<?php

namespace Models;

class Velo extends AbstractModel
{
    protected string $tableName = "velos";
    private int $id;
    private string $name;
    private string $description;
    private string $image;
    private int $price;

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    //SETTERS
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * sauvegarde un velo dans la bdd
     * @param Velo $velo
     * @return void
     */
    public function save(Velo $velo)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, description, image, price) VALUES (:name, :description, :image, :price)");
        $sql->execute([
            'name' => $velo->name,
            'description' => $velo->description,
            'image' => $velo->image,
            'price' => $velo->price
        ]);
    }


    /**
     * update un vélo dans la bdd
     * @param string $name
     * @param string $image
     * @param string $description
     * @param int $price
     * @param int $id
     * @return void
     */
    public function update(string $name, string $image, string $description, int $price, int $id)
    {
        $sql = $this->pdo->prepare("UPDATE {$this->tableName} SET name = :name, image = :image, description = :description, price = :price WHERE id = :id");
        $sql->execute([
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'price' => $price,
            'id' => $id,
        ]);
    }
}
