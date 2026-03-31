<?php

namespace App\Entity;

class Console {
    //Attributs
    private int $id;
    private string $name;
    private string $manufacturer;

    //Constructeur
    public function __construct(
        string $name,
        string $manufacturer
    ) {
        $this->name = $name;
        $this->manufacturer = $manufacturer;
    }

    //Getters et Setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }
    
    public function getManufacturer(): string {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self {
        $this->manufacturer = $manufacturer;
        return $this;
    }

}
