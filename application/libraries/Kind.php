<?php

namespace Kind;

class Kind
{
    private string $enName;
    private string $jpName;
    private string $img;

    public function __construct($enName, $jpName, $img)
    {
        $this->enName = $enName;
        $this->jpName = $jpName;
        $this->img    = $img;
    }

    /**
     * @return string
     */
    public function getEnName(): string
    {
        return $this->enName;
    }

    /**
     * @return string
     */
    public function getJpName(): string
    {
        return $this->jpName;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

}