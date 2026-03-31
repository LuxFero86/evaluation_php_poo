<?php

namespace App\Entity;

use App\Entity\Console;

class Game {
    //Attributs
    private int $id;
    private string $title;
    private string $type;
    private string $publishAt;
    private Console $console;

    //Constructeur
    public function __construct(
        string $title,
        string $type,
        string $publishAt,
        Console $console
    ) {
        $this->title = $title;
        $this->type = $type;
        $this->publishAt = $publishAt;
        $this->console = $console;
    }

    //Getters et Setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }
    
    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }
    
    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): self {
        $this->type = $type;
        return $this;
    }
    
    public function getPublishAt(): string {
        return $this->publishAt;
    }

    public function setPublishAt(string $publishAt): self {
        $this->publishAt = $publishAt;
        return $this;
    }
    
    public function getConsole(): Console {
        return $this->console;
    }

    public function setConsole(Console $console): self {
        $this->console = $console;
        return $this;
    }

}
